<?php

namespace App\Http\Controllers;

use App\Http\Requests\athletes\AthleteStoreRequest;
use App\Http\Requests\athletes\AthleteUpdateRequest;
use App\Http\Resources\athlete\AthleteResource;
use App\Models\Athlete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AthleteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return AthleteResource::collection(Athlete::with('coaches')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AthleteStoreRequest $request)
    {
        $athlete = Athlete::create($request->except('profile_picture'));

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture')->store('images/athletes');
            $athlete->update(['profile_picture' => $image]);
        }

        $athlete->coaches()->sync(Auth::user()->coach->id);

        return response([
            'message' => 'new athlete added',
            'athlete' => new AthleteResource($athlete)
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
        return response(['athlete' => new AthleteResource(Athlete::findOrFail($id))]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AthleteUpdateRequest $request, $id)
    {
        $athlete = Athlete::findOrFail($id);
        if ($athlete->coaches()->where('coach_id', Auth::user()->coach->id)->exists()) {
            $athlete->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'date_of_birth' => $request->date_of_birth,
                'weight' => $request->weight,
                'height' => $request->height,
                'club' => $request->club,
                'profile_picture' => $request->profile_picture
            ]);
            return response(['message' => 'სპორტსმენის ინფორმაცია წარმატებით შეიცვალა.']);
        } else
            return response(['message' => 'არ შეგიძლია სხვისი სპორტსმენის ინფორმაციის შეცვლა.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Athlete::destroy($id);

        return response([
            'message' => 'Athlete deleted.'
        ]);
    }
}
