<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            "company_id" => $this->id,
            "slug" => $this->slug,


            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'number' => $this->number,
            'fax' => $this->fax,
            'email' => $this->email,
            'website' => $this->website,
            'commercial_register' => $this->commercial_register,
            'technical_director' => new UserResource($this->whenLoaded('technical_director')),
            'financial_director' => new UserResource($this->whenLoaded('financial_director')),
            'logo' => $this->logo != null ? asset($this->logo) : null,

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
