<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Schema;
use App\Exceptions\MySQLException;
use App\Exceptions\ApiModelException;
use App\Models\Documento;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model();

    /**
     * Make Model instance
     *
     * @throws \Exception
     *
     * @return Model
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Get the table columns from db schema
     * @return array
     */
    private function getTableColumns()
    {
        return Schema::getColumnListing($this->model->getTable());
    }

    /**
     * Get the includes relations from model
     * @return array
     */
    public function getIncludes()
    {
        return [];
    }

    /**
     * Get the scopes name
     * @return array
     */
    public function getScopes()
    {
        return ['query'];
    }

    /**
     * Get the exact filters
     * @return array
     */
    public function getExactFilters()
    {
        return [];
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, $columns = ['*'])
    {
        $query = $this->allQuery();

        return $query->paginate($perPage, $columns);
    }

    /**
     * 
     * @param Builder $newQuery
     */
    private function getQueryBuilder(Builder $newQuery)
    {
        $filters = [];
        foreach ($this->getFieldsSearchable() as $field) {
            $filters[] = $field;
        }

        foreach ($this->getScopes() as $scope) {
            $filters[] = AllowedFilter::scope($scope);
        }

        foreach ($this->getExactFilters() as $filter) {
            $filters[] = AllowedFilter::exact($filter);
        }

        return QueryBuilder::for($newQuery)
            ->allowedFilters($filters)
            ->allowedFields($this->getTableColumns())
            ->allowedIncludes($this->getIncludes())
            ->allowedSorts($this->getFieldsSearchable());
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null)
    {
        return $this->getQueryBuilder($this->model->newQuery());
    }

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);
        return $query->paginate($limit);
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Model
     */
    public function create($input)
    {
        try {
            DB::beginTransaction();
            $model = $this->model->newInstance($input);
            $model->save();
            DB::commit();
            return $model;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->handleException($th);
        }
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*'])
    {
        try {
            $query = $this->getQueryBuilder($this->model->newQuery());

            return $query->find($id, $columns);
        } catch (\Throwable $th) {
            $this->handleException($th);
        }
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        try {
            DB::beginTransaction();
            $query = $this->model->newQuery();
            $model = $query->findOrFail($id);
            $model->fill($input);
            $model->save();
            DB::commit();
            return $model;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->handleException($th);
        }
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        try {
            $query = $this->model->newQuery();
            $model = $query->findOrFail($id);
            return $model->delete();
        } catch (\Throwable $th) {
            $this->handleException($th);
        }
    }

    protected function handleException(\Exception $e)
    {
        dd($e);
        if ($e instanceof QueryException) {
            throw new MySQLException($e->getMessage(), $e->getCode());
        } else {
            throw new ApiModelException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Method to store gallery in storage
     * @param  [type] $model        [description]
     * @param  [type] $request      [description]
     * @return [type] $folderName   [description]
     */
    protected function saveFile($model, array $documentos, string $folderName)
    {
        // para determinar las imagenes eliminadas
        $requestGallery = array_column($documentos, 'archivo');
        $currentGallery = array_column($model->documentos->toArray(), 'archivo');
        $deletedDocumentos = array_values(array_diff($currentGallery, $requestGallery));

        // eliminar imagenes
        foreach ($deletedDocumentos as $deletedDocumento) {
            $delete = Documento::where('archivo', $deletedDocumento)->first();
            Storage::disk('public')->delete($folderName.'/'.$delete->archivo);
            $delete->delete();
        }

        // new images
        foreach ($documentos as $key => $documento) {
            if (array_key_exists('file', $documento)) {
                $fileName   = time() . '.' . $documento['nombre_archivo'];
                $this->saveFileFromBase64($documento['file'], $fileName, $folderName);
                $input['url']      = '/storage/' . $folderName . '/' . $fileName;
                $input['archivo'] = $fileName;
                $input['ext'] = $documento['ext'];
                $model->documentos()->create($input);
            } else {
                // Actualizacion de possicion de la imagen
                $documento = Documento::findOrFail($documento['id']);
                $documento->orden = isset($documento['orden'])? $documento['orden'] : 0;
                $documento->save();
            }
        }
    }

    /**
     * Method to save files in storage from base 64
     * @param  string $base64Url [description]
     * @param  string $fileName [description]
     * @param  string $folderName   [description]
     * @return void
     */
    public function saveFileFromBase64(string $base64Url, string $fileName, string $folderName)
    {
        try {
            //get the base-64 from data
            $base64String = substr($base64Url, strpos($base64Url, ',') + 1);

            //decode base64 string
            $image = base64_decode($base64String);

            // folder path
            $filePath = $folderName . '/' . $fileName;

            // store file
            $storagePath = Storage::disk('public')->put($filePath, $image);
            $realPath = $storagePath . $filePath;

            // return relative path from public path
            return str_replace(public_path(), '', $realPath);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
