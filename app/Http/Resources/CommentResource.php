<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            "comment_id" => $this->id,
            "slug" => $this->slug,


            'task' => new TaskResource($this->whenLoaded('task')),
            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->title,
            'desc' => $this->desc,
            'replay_time' => $this->replay_time,
            'main_comment' => new CommentResource($this->whenLoaded('main_comment')),

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
