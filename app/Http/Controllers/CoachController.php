<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoachStoreRequest;
use App\Models\Coach;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coaches = User::has('coach')->get();

        return response([
           'coaches' => $coaches,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CoachStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoachStoreRequest $request)
    {
        $userData = $request->only(['name', 'surname', 'email']) + ['password' => Hash::make($request->password)];
        $user = User::create($userData);

       $coach = $user->coach()
            ->create($request->only('club'));

        $user->assignRole('coach');

        return response([
            'message' => 'New coach added',
            'coach' => $coach
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
        //
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
        //
    }
}
