<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Repositories\BaseRepository;

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
}
