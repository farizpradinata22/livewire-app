<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskType extends Model
{
    protected $fillable = ['name', 'sort', 'active'];
    protected $casts = ['active' => 'boolean'];
}
