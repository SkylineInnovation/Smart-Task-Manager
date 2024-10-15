<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogHistoryResource extends JsonResource
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
            "loghistory_id" => $this->id,
            "slug" => $this->slug,


            'user' => new UserResource($this->whenLoaded('user')),
            'action' => $this->action,
            'by_model_name' => $this->by_model_name,
            'by_model_id' => $this->by_model_id,
            'on_model_name' => $this->on_model_name,
            'on_model_id' => $this->on_model_id,
            'from_data' => $this->from_data,
            'to_data' => $this->to_data,
            'preaf' => $this->preaf,
            'desc' => $this->desc,
            'color' => $this->color,

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
