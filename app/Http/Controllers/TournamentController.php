<?php

namespace App\Http\Controllers;

use App\Http\Requests\TournamentStoreRequest;
use App\Models\Tournament;

class TournamentController extends Controller
{
    public function index()
    {
        $tournament = Tournament::with('referees')->get();
        return response([
            'tournament' => $tournament,
//            'referees' => $tournament->referees
        ]);
    }

    public function store(TournamentStoreRequest $request)
    {
        $tournament = Tournament::create($request->only(['title', 'location', 'start_date', 'end_date']));

        $tournament->referees()->attach($request->referees);

        return response([
            'message' => 'new tournament created',
            'tournament' => $tournament
        ]);
    }
}
