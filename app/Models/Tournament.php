<?php

namespace App\Models;

use App\Models\Athlete;
use App\Models\Referee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tournament extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function athletes()
    {
        return $this->belongsToMany(Athlete::class);
    }    

    public function referees()
    {
        return $this->belongsToMany(Referee::class);
    }
}
