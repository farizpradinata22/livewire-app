<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IsoCategory extends Model
{
    protected $fillable = ['name', 'sort', 'active'];
    protected $casts = ['active' => 'boolean'];
}
