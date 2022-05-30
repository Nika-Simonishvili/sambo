<?php

namespace App\Models;

use App\Models\Coach;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Athlete extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

    public function getDateOfBirthAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['date_of_birth'])->format('m/d/Y');
    }

    public function fullname()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
