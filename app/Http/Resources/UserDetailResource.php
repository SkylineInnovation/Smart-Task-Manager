<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "userdetail_id" => $this->id,
            "slug" => $this->slug,


            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->title,
            'nationality' => $this->nationality,
            'id_number' => $this->id_number,
            'address' => $this->address,
            'qualification' => $this->qualification,
            'salary' => $this->salary,
            'home' => $this->home,
            'transport' => $this->transport,
            'branch' => new BranchResource($this->whenLoaded('branch')),

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
