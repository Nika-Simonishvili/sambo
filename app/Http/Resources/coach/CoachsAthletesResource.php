<?php

namespace App\Http\Resources\coach;

use Illuminate\Http\Resources\Json\JsonResource;

class CoachsAthletesResource extends JsonResource
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
            'name' => $this->name,
            'surname' => $this->surname,
            'date_of_birth' => $this->date_of_birth->format('m/d/Y'),
            'weight' => $this->weight,
            'height' => $this->height,
            'club' => $this->club,
        ];
    }
}
