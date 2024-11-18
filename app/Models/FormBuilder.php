<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormBuilder extends Model
{
    protected $guarded = [];

    protected $casts = [
        'form' => 'array'
    ];
}
