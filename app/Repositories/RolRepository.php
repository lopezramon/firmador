<?php

namespace App\Repositories;

use App\Models\Rol;
use App\Repositories\BaseRepository;

/**
 * Class RolRepository
 * @package App\Repositories
 * @version June 25, 2022, 6:24 am UTC
*/

class RolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'guard_name'
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
        return Rol::class;
    }

    public function allPermissions()
    {
        $permisos = [
            'modulos' =>[
                ['name' => 'crear-modulos','type' =>'crear' ],
                ['name' => 'editar-modulos','type' =>'editar' ],
                ['name' => 'borrar-modulos','type' =>'borrar' ],
                ['name' => 'consultar-modulos','type' =>'consultar' ]
              ],
            'agentes' => [
                ['name' => 'crear-agentes','type' =>'crear'],
                ['name' => 'editar-agentes','type' =>'editar'],
                ['name' => 'borrar-agentes','type' =>'borrar'],
                ['name' => 'consultar-agentes','type' =>'consultar'],
            ],
            'carreras' => [
              ['name' => 'crear-carreras','type' =>'crear'],
              ['name' => 'editar-carreras','type' =>'editar'],
              ['name' => 'borrar-carreras','type' =>'borrar'],
              ['name' => 'consultar-carreras','type' =>'consultar'],
            ],
            'grupos' => [
              ['name' => 'crear-grupos','type' =>'crear'],
              ['name' => 'editar-grupos','type' =>'editar'],
              ['name' => 'borrar-grupos','type' =>'borrar'],
              ['name' => 'consultar-grupos','type' =>'consultar'],
            ],
            'titulos' => [
              ['name' => 'crear-titulos','type' =>'crear'],
              ['name' => 'editar-titulos','type' =>'editar'],
              ['name' => 'borrar-titulos','type' =>'borrar'],
              ['name' => 'consultar-titulos','type' =>'consultar'],

            ],
            'profesiones' => [
              ['name' => 'crear-profesiones','type' =>'crear'],
              ['name' => 'editar-profesiones','type' =>'editar'],
              ['name' => 'borrar-profesiones','type' =>'borrar'],
              ['name' => 'consultar-profesiones','type' =>'consultar'],

            ],
            'contratos' => [
              ['name' => 'crear-contratos','type' =>'crear'],
              ['name' => 'editar-contratos','type' =>'editar'],
              ['name' => 'borrar-contratos','type' =>'borrar'],
              ['name' => 'consultar-contratos','type' =>'consultar'],

            ],
            'planta-permanente' => [
              ['name' => 'crear-planta-permanentes','type' =>'crear'],
              ['name' => 'editar-planta-permanentes','type' =>'editar'],
              ['name' => 'borrar-planta-permanentes','type' =>'borrar'],
              ['name' => 'consultar-planta-permanentes','type' =>'consultar'],

            ],
            'asistencias' => [
              ['name' => 'crear-asistencias','type' =>'crear'],
              ['name' => 'editar-asistencias','type' =>'editar'],
              ['name' => 'borrar-asistencias','type' =>'borrar'],
              ['name' => 'consultar-asistencias','type' =>'consultar'],
            ],
            'legajos' => [
              ['name' => 'crear-legajos','type' =>'crear'],
              ['name' => 'editar-legajos','type' =>'editar'],
              ['name' => 'borrar-legajos','type' =>'borrar'],
              ['name' => 'consultar-legajos','type' =>'consultar'],
            ],
            'asistencia-medica' => [
              ['name' => 'crear-asistencia-medicas','type' =>'crear'],
              ['name' => 'editar-asistencia-medicas','type' =>'editar'],
              ['name' => 'borrar-asistencia-medicas','type' =>'borrar'],
              ['name' => 'consultar-asistencia-medicas','type' =>'consultar'],
            ],
            'liquidaciones' => [
              ['name' => 'crear-liquidaciones','type' =>'crear'],
              ['name' => 'editar-liquidaciones','type' =>'editar'],
              ['name' => 'borrar-liquidaciones','type' =>'borrar'],
              ['name' => 'consultar-liquidaciones','type' =>'consultar'],
            ],
            'tipo-contratos' => [
              ['name' => 'crear-tipo-contratos','type' =>'crear'],
              ['name' => 'editar-tipo-contratos','type' =>'editar'],
              ['name' => 'borrar-tipo-contratos','type' =>'borrar'],
              ['name' => 'consultar-tipo-contratos','type' =>'consultar'],
            ],
            'tipo-tramites' => [
              ['name' => 'crear-tipo-tramites','type' =>'crear'],
              ['name' => 'editar-tipo-tramites','type' =>'editar'],
              ['name' => 'borrar-tipo-tramites','type' =>'borrar'],
              ['name' => 'consultar-tipo-tramites','type' =>'consultar']
            ]
        ];

        return $permisos;

    }
}
