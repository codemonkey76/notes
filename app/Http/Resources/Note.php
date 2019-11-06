<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Note extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data'  => [
                'note_id' => $this->id,
                'company' => $this->company,
                'contact' => $this->contact,
                'issue'   => $this->issue,
                'details' => $this->details,
                'time'    => $this->time . ' minutes',
                'created' => $this->created_at->diffForHumans()
            ],
            'links' => [
                'self' => $this->path()
            ]
        ];
    }
}
