<?php

namespace App\Models;

use App\Models\Coach;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Athlete extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function coaches() 
    {
        return $this->belongsToMany(Coach::class);
    }
}
