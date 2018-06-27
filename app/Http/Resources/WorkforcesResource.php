<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WorkforcesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'data' => $this->collection->transform(function($task){
                return [
                    'id' => $task->id,
                    'work_type' => $task->work_type,
                    'work_location' => $task->work_location,
                    'extra_requirements' => $task->extra_requirements,
                    'created_at' => $task->created_at->diffForHumans(),
                    'company' => $task->company->fullname,
                    'task_link' => url('/api/tasks/' . $task->id),
                ];
            }),
        ];
    }
}
