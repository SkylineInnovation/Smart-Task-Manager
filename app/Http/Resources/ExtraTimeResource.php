<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExtraTimeResource extends JsonResource
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
            "extratime_id" => $this->id,
            "slug" => $this->slug,


            'task' => new TaskResource($this->whenLoaded('task')),
            'user' => new UserResource($this->whenLoaded('user')),
            'accepted_by_user' => new UserResource($this->whenLoaded('accepted_by_user')),
            'reason' => $this->reason,
            'result' => $this->result,
            'request_time' => $this->request_time,
            'response_time' => $this->response_time,
            'status' => $this->status,
            'duration' => $this->duration,

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
