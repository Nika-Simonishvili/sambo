<?php

namespace App\Models;

use App\Models\Athlete;
use App\Models\Referee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tournament extends Model
{
    use HasFactory;

    public function athletes()
    {
        return $this->belongsToMany(Athlete::class);
    }    

    public function referees()
    {
        return $this->belongsToMany(Referee::class);
    }
}
