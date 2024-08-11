<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
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
            "attachment_id" => $this->id,
            "slug" => $this->slug,


            'user' => new UserResource($this->whenLoaded('user')),
            'task' => new TaskResource($this->whenLoaded('task')),
            'title' => $this->title,
            'desc' => $this->desc,
            'file' => $this->file != null ? asset($this->file) : null,
            'main_attachment' => new AttachmentResource($this->whenLoaded('main_attachment')),

            "date" => date("d/m/Y", strtotime($this->created_at)),
            "time" => date("h:i A", strtotime($this->created_at)),
            "date_time" => date("Y-m-d h:i A", strtotime($this->created_at)),
            "created_ago" => $this->created_ago($this->created_at, $request->header("lang")),
        ];
    }
}
