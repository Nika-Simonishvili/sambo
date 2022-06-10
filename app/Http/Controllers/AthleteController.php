<?php

namespace App\Http\Controllers;
use App\Http\Requests\AthleteStoreRequest;
use App\Http\Resources\athlete\AthleteResource;
use App\Models\Athlete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AthleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show']]);
        $this->middleware('can:manage athlete', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return AthleteResource::collection(Athlete::all());     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AthleteStoreRequest $request)
    {
        $athlete = Athlete::create($request->all());

        $athlete->coaches()->sync(Auth::user()->coach->id);

        return response([
            'message' => 'new athlete added',
            'athlete' => new AthleteResource($athlete)
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
        return response(['athlete' => new AthleteResource(Athlete::findOrFail($id))]);
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
        Athlete::destroy($id);

        return  response([
            'message' => 'Athlete deleted.'
        ]);
    }
}
