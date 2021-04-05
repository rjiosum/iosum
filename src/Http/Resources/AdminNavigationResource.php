<?php declare(strict_types=1);

namespace Iosum\AdminNav\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminNavigationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'type' => 'admin-nav',
        'id' => $this->id,
        'attributes' => [
            'uuid' => $this->uuid,
            'parent_id' => $this->parent_id,
            'parent' => $this->parent,
            'position' => $this->position,
            'title' => $this->title,
            'children_count' => $this->children_count,
            'icon' => $this->icon,
            'route_name' => $this->route_name,
            'route_path' => $this->route_path,
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),
            'created_h' => $this->created_at->diffForHumans(),
            'updated_h' => $this->updated_at->diffForHumans(),
        ]
    ];
    }
}
