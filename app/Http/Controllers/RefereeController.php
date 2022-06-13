<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefereeStoreRequest;
use App\Http\Resources\referee\RefereeResource;
use App\Models\Referee;
use Illuminate\Http\Request;

class RefereeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return RefereeResource::collection(Referee::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RefereeStoreRequest $request)
    {
        $referee = Referee::create($request->only(['name', 'surname', 'description']));

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture')->store('images/referees');
            $referee->update(['profile_picture' => $image]);
        }

        return response([
            'message' => 'new referee added',
            'referee' => new RefereeResource($referee)
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
        return response(['referee' => new RefereeResource(Referee::findOrFail($id))]);
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
        Referee::findOrFail($id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'description' => $request->description,
        ]);

        return response([
            'message' => 'Referee Updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Referee::destroy($id);

        return  response([
            'message' => 'Referee deleted.'
        ]);
    }
}
