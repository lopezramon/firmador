<?php

namespace App\Repositories;

use App\Models\Module;
use App\Repositories\BaseRepository;

/**
 * Class ModuleRepository
 * @package App\Repositories
 * @version June 16, 2022, 12:21 am UTC
*/

class ModuleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'slug',
        'activo'
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
        return Module::class;
    }

}
