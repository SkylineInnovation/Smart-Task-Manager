<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'user_name' => $this->user_name,
            'email' => $this->email,
            'is_email_verified' => $this->is_email_verified,
            'email_verified_at' => $this->email_verified_at,
            'phone' => $this->phone,
            'is_phone_verified' => $this->is_phone_verified,
            'gender' => $this->gender,
            'birth_day' => $this->birth_day,
            'language' => $this->language,
            'image' => $this->image,
            'status' => $this->status,
            'last_time_use' => $this->last_time_use,
            'active_until' => $this->active_until,

            'roles' => RoleResource::collection($this->roles),
            'permissions' => PermissionResource::collection($this->permissions),
        ];
    }
}
