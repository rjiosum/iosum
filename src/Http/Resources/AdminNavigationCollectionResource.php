<?php

namespace Iosum\AdminNav\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminNavigationCollectionResource extends ResourceCollection
{
    public $collects = 'Iosum\AdminNav\Http\Resources\AdminNavigationResource';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => route('admin.nav'),
            ]
        ];
    }
}
