<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OtpSendCodeResource extends JsonResource
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
            "otpsendcode_id" => $this->id,
            "slug" => $this->slug,


            // 'user' => new UserResource($this->whenLoaded('user')),
            'otp_code' => $this->otp_code,
            'phone_number' => $this->phone_number,
            'applecation' => $this->applecation,
            'code_status' => $this->code_status,
            'back_response' => $this->back_response,

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
