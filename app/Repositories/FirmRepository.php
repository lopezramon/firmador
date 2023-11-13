<?php

namespace App\Repositories;

use App\Models\Firm;
use App\Repositories\BaseRepository;

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
        'sistem',
        'count'
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
}
