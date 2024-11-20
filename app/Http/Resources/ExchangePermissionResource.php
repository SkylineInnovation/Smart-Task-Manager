<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExchangePermissionResource extends JsonResource
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
            "exchangepermission_id" => $this->id,
            "slug" => $this->slug,


            'user' => new UserResource($this->whenLoaded('user')),
            'content' => $this->content,
            'amount' => $this->amount,
            'attachment' => $this->attachment != null ? asset($this->attachment) : null,
            'request_date' => $this->request_date,
            'financial_director' => new UserResource($this->whenLoaded('financial_director')),
            'financial_director_response' => $this->financial_director_response,
            'financial_director_time' => $this->financial_director_time,
            'technical_director' => new UserResource($this->whenLoaded('technical_director')),
            'technical_director_response' => $this->technical_director_response,
            'technical_director_time' => $this->technical_director_time,
            'status' => $this->status,

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
