<?php

namespace App\Http\Controllers;
use App\Http\Requests\AthleteStoreRequest;
use App\Models\Athlete;
use Spatie\Permission\Traits\HasRoles;


use App\Models\User;
use Illuminate\Http\Request;

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
        $fields = $request->validated();

        $athlete = Athlete::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'birth_year' => $request['birth_year'],
            'weight' => $request['weight'],
            'height' => $request['height'],
            'club' => $request['club'],
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
