<?php

namespace App\Repositories;

use App\Models\Firm;
use App\Models\Organization;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class FirmRepository
 * @package App\Repositories
 * @version October 18, 2023, 7:51 pm -03
*/

class FirmRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'organization_id',
        'id_xml',
        'document_type',
        'signature',
        'signature_email'
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
        return Firm::class;
    }

    public function getIncludes()
    {
        return ['organization'];
    }

     /**
     * Create model record
     *
     * @param array $input
     *
     * @return Models
     */
    public function create($input)
    {
        try {
            DB::beginTransaction();
            $organization = Organization::where('rut', '=', $input['rut'])->first();
            $input['organization_id'] = $organization->id;
            $input['sistem_app'] = $organization->sistem;
            $model = $this->model->newInstance($input);
            $model->save();
            DB::commit();
            return $model;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->handleException($th);
        }
    }
}
