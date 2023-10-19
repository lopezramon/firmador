<?php

namespace App\Repositories;

use App\Models\LogSignatur;
use App\Repositories\BaseRepository;

/**
 * Class LogSignaturRepository
 * @package App\Repositories
 * @version October 18, 2023, 7:51 pm -03
*/

class LogSignaturRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'firm_id',
        'id_xml',
        'document_type',
        'date_time'
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
        return LogSignatur::class;
    }
}
