<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultStoreRequest;
use App\Http\Requests\TournamentStoreRequest;
use App\Http\Resources\tournament\TournamentResource;
use App\Models\Result;
use App\Models\Tournament;
use Illuminate\Http\Request;

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

    public function show($id)
    {
        return response(['tournament' => new TournamentResource(Tournament::findOrFail($id))]);
    }

    public function addAthleteOnTournament(Request $request, $id)
    {
        $tournament = Tournament::findOrFail($id);

        $tournament->athletes()->attach($request->athletes);

        return response([
            'message' => 'New athletes added on tournament',
            'tournament' => new TournamentResource($tournament)
        ]);
    }

    public function addResult($id, ResultStoreRequest $request)
    {
//        $response = {
//            data : [
//                  {'place' : 2,
//                  'weight' : 2,
//                  'at_id' : 5
//                },
//                  {'place' : 2,
//                  'weight' : 2,
//                  'at_id' : 5
//                },
//                  {'place' : 2,
//                  'weight' : 2,
//                  'at_id' : 5
//                },
//        ]
//    }

//        foreach ($request->all() as $data) {
//            Result::create([
//               'place' => $data->place,
//               'weight' => $data->weight,
//               'athlete_id' => $data->athlete_id
//            ]);
//        }

    }
}
