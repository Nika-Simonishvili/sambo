<?php

namespace App\Models;

use App\Models\Athlete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coach extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function athletes()
    {
        return $this->belongsToMany(Athlete::class);
    }
}
