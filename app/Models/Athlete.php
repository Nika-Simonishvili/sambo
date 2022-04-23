<?php

namespace App\Models;

use App\Models\Coach;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Athlete extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fullname()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function coaches() 
    {
        return $this->belongsToMany(Coach::class);
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class);
    }
}
