<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DailyTaskResource extends JsonResource
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
            "dailytask_id" => $this->id,
            "slug" => $this->slug,

            
                    'manager' => new ManagerResource($this->whenLoaded('manager')),
                        'title' => $this->title,
                        'description' => $this->description,
                        'start_time' => $this->start_time,
                        'end_time' => $this->end_time,
                        'proearty' => $this->proearty,
                        'status' => $this->status,
                        'repeat_time' => $this->repeat_time,
                        'repeat_evrey' => $this->repeat_evrey,

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
