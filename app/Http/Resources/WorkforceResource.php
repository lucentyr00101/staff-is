<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class WorkforceResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => (string)$this->id,
            'work_type' => $this->work_type,
            'work_location' => $this->work_location,
            'extra_requirements' => $this->extra_requirements,
        ];
    }
}
