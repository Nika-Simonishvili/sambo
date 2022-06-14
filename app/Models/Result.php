<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function athletes()
    {
        return $this->hasMany(Athlete::class);
    }

    public function tournaments()
    {
        return $this->hasMany(Tournament::class);
    }
}
