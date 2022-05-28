<?php

namespace App\Http\Controllers;
use App\Http\Requests\AthleteStoreRequest;
use App\Models\Athlete;
use Spatie\Permission\Traits\HasRoles;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AthleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AthleteStoreRequest $request)
    {
        $userData = $request->only(['name', 'surname', 'email']) + ['password' => Hash::make($request->password)];
        $user = User::create($userData);

        $athlete = $user->athlete()->create([
            'birth_year' => $request->birth_year,
            'weight' => $request->weight,
            'height' => $request->height,
            'club' => $request->club
        ]);

        $coach = $athlete->coaches()->sync(Auth::user());

        return response([
            'message' => 'new athlete added',
            'athlete' => $athlete,
            'coach' => $coach
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
