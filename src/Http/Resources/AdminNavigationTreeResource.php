<?php declare(strict_types=1);

namespace Iosum\AdminNav\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class AdminNavigationTreeResource extends JsonResource
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
            'types' => 'admin-nav-tree',
            'id' => $this->uuid,
            'attributes' => [
                'title' => $this->title,
                'icon' => $this->icon,
                'route' => $this->route,
                'children' => new AdminNavigationTreeCollectionResource($this->whenLoaded('children')),
            ]
        ];
    }
}
