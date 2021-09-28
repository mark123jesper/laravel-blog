<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Returning all fields
        // return parent::toArray($request);

        //Returning specific fields for security
        return [
            'id' => $this->id,
            'body' => $this->body,
            'user' => $this->user->name,
            'user_id' => $this->user_id,
            'question_slug' => $this->question->slug,
            'like_count' => $this->like->count(),
            'liked' =>!!$this->like->where("user_id", auth()->id())->count(),
            'created_at' => $this->created_at->diffForHumans(),

        ];
    }
}
