<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use App\Task;

class DeleteTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteTask'
    ];

    public function type()
    {
        return GraphQL::type('Task');
    }

    public function args()
    {
        return [
          'id' => [
            'name' => 'id',
            'type' => Type::nonNull(Type::int()),
            'rules' => ['required'],
          ]
        ];
    }

    public function resolve($root, $args)
    {
        $task = Task::find($args['id']);
        if($task){
            $task->delete();
            return 'Task Deleted successfully...!';
        }else {
            return 'Taks not Found..!';
        }
    }
}
