<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResource extends JsonResource
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
            "leave_id" => $this->id,
            "slug" => $this->slug,


            'task' => new TaskResource($this->whenLoaded('task')),
            'user' => new UserResource($this->whenLoaded('user')),
            'type' => $this->type,
            'time_out' => $this->time_out,
            'time_in' => $this->time_in,
            'effect_on_time' => $this->effect_on_time,
            'reason' => $this->reason,
            'result' => $this->result,
            'status' => $this->status,
            'accepted_by_user' => new UserResource($this->whenLoaded('accepted_by_user')),
            'accepted_time' => $this->accepted_time,

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
