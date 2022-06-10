<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoachStoreRequest;
use App\Http\Resources\coach\CoachResource;
use App\Http\Resources\coach\CoachsAthletesResource;
use App\Models\Coach;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CoachController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show', 'getAthletes']]);
        $this->middleware('can:manage coach', ['except' => ['index', 'show', 'getAthletes']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CoachResource::collection(Coach::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CoachStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoachStoreRequest $request)
    {
        $userData = $request->only(['name', 'surname', 'email', 'username']) + ['password' => Hash::make($request->password)];
        $user = User::create($userData);

       $coach = $user->coach()
            ->create($request->only('club', 'tel'));

        $user->assignRole('coach');

        return response([
            'message' => 'New coach added',
            'coach' => new CoachResource($coach)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(['coach' => new CoachResource(Coach::findOrFail($id))]);
    }

    public function getAthletes($id)
    {
        $coach = Coach::find($id);

        return CoachsAthletesResource::collection($coach->athletes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coach = Coach::FindOrFail($id);
        $coach->user()->delete();

        return  response([
            'message' => 'coach deleted.'
        ]);
    }
}
