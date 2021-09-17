<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'id' => $this->id,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
