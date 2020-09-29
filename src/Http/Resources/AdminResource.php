<?php declare(strict_types=1);

namespace Iosum\AdminAuth\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'data' => [
                'type' => 'admin',
                'admin_id' => $this->uuid,
                'attributes' => [
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'name' => $this->full_name,
                    'email' => $this->email,
                    'avatar' => $this->avatar_url,
                ]
            ],
            'links' => [
                'self' => route('admin.profile'),
            ]
        ];
    }
}
