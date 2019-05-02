<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    protected $keyType = 'string';

    public $incrementing = 'false';
}
