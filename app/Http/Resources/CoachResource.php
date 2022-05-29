<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\RolePermission\Resources\PermissionResource;

class CoachResource extends JsonResource
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
            'name' => $this->user->name,
            'surname' => $this->user->surname,
            'username' => $this->user->username,
            'email' => $this->user->email,
            'club' => $this->club,
            'tel' => $this->tel,
            'roles' => $this->user->getRoleNames()
        ];
    }
}
