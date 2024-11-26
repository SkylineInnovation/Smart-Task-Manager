<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            "task_id" => $this->id,
            "slug" => $this->slug,


            'manager' => new UserResource($this->whenLoaded('manager')),
            'title' => $this->title,
            'desc' => $this->desc,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'is_separate_task' => $this->is_separate_task,
            'comment_type' => $this->comment_type,
            'max_worning_count' => $this->max_worning_count,
            'priority_level' => $this->priority_level,
            'status' => $this->status,
            'main_task' => new TaskResource($this->whenLoaded('main_task')),

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
