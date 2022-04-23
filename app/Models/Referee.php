<?php

namespace App\Models;

use App\Models\Tournament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Referee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fullname()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class);
    }
}
