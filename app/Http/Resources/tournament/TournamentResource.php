<?php

namespace App\Http\Resources\tournament;

use App\Http\Resources\athlete\AthleteResource;
use App\Http\Resources\referee\RefereeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TournamentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'location' => $this->location,
            'start date' => $this->start_date->format('m/d/Y'),
            'end date' => $this->end_date->format('m/d/Y'),
            'referees' => RefereeResource::collection($this->referees),
            'athletes' => AthleteResource::collection($this->athletes)
        ];
    }
}
