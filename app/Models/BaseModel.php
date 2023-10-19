<?php

namespace App\Models;

use Eloquent as Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Facades\CauserResolver;


class BaseModel extends Model
{
  use LogsActivity;

  protected static $ignoreChangedAttributes = ['created_at', 'updated_at', 'deleted_at'];

  protected static $logAttributes = ['*'];

  protected static $logOnlyDirty = true;

    // public function getDescriptionForEvent(string $eventName): string
    // {
    //   return __("Record {$eventName} in table", ['table' => $this->table]);
    // }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName("{$this->table}")
        ->logOnly(['*'])
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}in table {$this->table}");
        // Chain fluent methods for configuration options
    }
}
