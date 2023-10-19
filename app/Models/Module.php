<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Module
 * @package App\Models
 * @version June 16, 2022, 12:21 am UTC
 *
 * @property string $nombre
 * @property string $slug
 * @property boolean $activo
 */
class Module extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'modules';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'slug',
        'activo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'slug' => 'string',
        'activo' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'activo' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * Scope to search by any column
     * @param  Builder $query
     * @param  string $filter
     * @return Builder
     */
    public function scopeQuery(Builder $query, $filter)
    {
        $value = "%$filter%";

        return $query->where('nombre', 'LIKE', $value);
    }
}
