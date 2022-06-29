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

        if ($request->hasFile('profile_picture')) {
            $userData['profile_picture'] = $request->file('profile_picture')->store('images/coaches');
        }

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
        $user = User::findOrFail($id);

        return response(['coach' => new CoachResource($user->coach)]);
    }

    public function getAthletes($id)
    {
        $coach = User::find($id)->coach;

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

        return response([
            'message' => 'coach deleted.'
        ]);
    }
}
