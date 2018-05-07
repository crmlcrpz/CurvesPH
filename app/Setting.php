<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
            'key',
            'value',
     ];

    const CREATED_AT = null;

    // Issue to be fixed
    public function scopeValue($query)
    {
        return $query->where('value', '=', 'xyz')->pluck('key');
    }
}
