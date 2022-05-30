<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AthleteResource extends JsonResource
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
            'name' => $this->name,              
            'surname' => $this->surname,              
            'date_of_birth' => $this->date_of_birth,
            'weight' => $this->weight,              
            'height' => $this->height,
            'club' => $this->club,    
            'coaches' => CoachResource::collection($this->coaches)                        
        ];
    }
}