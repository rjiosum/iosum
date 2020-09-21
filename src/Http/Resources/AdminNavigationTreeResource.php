<?php declare(strict_types=1);

namespace Iosum\AdminNav\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminNavigationTreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'parent_id' => $this->parent_id,
            'position' => $this->position,
            'title' => $this->title,
            'icon' => $this->icon,
            'route' => $this->route,
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),
            'created' => $this->created_at->diffForHumans(),
            'updated' => $this->updated_at->diffForHumans(),
            'children' => AdminNavigationTreeResource::collection($this->whenLoaded('children')),
        ];
    }
}
