<?php

namespace App\Http\Controllers;

use App\Http\Requests\TournamentStoreRequest;
use App\Http\Resources\tournament\TournamentResource;
use App\Models\Tournament;

class TournamentController extends Controller
{

    public function index()
    {
        return TournamentResource::collection(Tournament::with('referees')->get());
    }

    public function store(TournamentStoreRequest $request)
    {
        $tournament = Tournament::create($request->only(['title', 'location', 'start_date', 'end_date']));

        $tournament->referees()->attach($request->referees);

        return response([
            'message' => 'new tournament created',
            'tournament' => new TournamentResource($tournament)
        ]);
    }
}
