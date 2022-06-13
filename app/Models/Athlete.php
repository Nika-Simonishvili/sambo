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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function fullname()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function age()
    {
        return Carbon::parse($this->attributes['date_of_birth'])->age;
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
