<?php

namespace App\Http\Resources\tournament;

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
            'title' => $this->title,
            'location' => $this->location,
            'start date' => $this->start_date,
            'end date' => $this->end_date,
            'referees' => RefereeResource::collection($this->referees)
        ];
    }
}
