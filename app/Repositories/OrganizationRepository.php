<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Repositories\BaseRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class OrganizationRepository
 * @package App\Repositories
 * @version October 18, 2023, 7:52 pm -03
*/

class OrganizationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'rut',
        'email',
        'status',
        'user_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Organization::class;
    }

    public function getIncludes()
    {
        return ['user'];
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function findByRut($rut)
    {
        try {
            $query = $this->model->newQuery();
            $organization = $query->existsAndStatusIsTrue($rut)->get();
            if (!$organization || !count($organization)) {
                $organization = false;
            }
            return $organization;
        } catch (\Throwable $th) {
            $this->handleException($th);
        }
    }
}
