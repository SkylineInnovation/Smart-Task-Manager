<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            "branch_id" => $this->id,
            "slug" => $this->slug,


            'name' => $this->name,
            'location' => $this->location,
            'phone' => $this->phone,
            'number' => $this->number,
            'fax' => $this->fax,
            'email' => $this->email,
            'password' => $this->password,
            'website' => $this->website,
            'commercial_register' => $this->commercial_register,
            'area' => new AreaResource($this->whenLoaded('area')),
            'manager' => new UserResource($this->whenLoaded('manager')),
            'responsible' => new UserResource($this->whenLoaded('responsible')),

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
