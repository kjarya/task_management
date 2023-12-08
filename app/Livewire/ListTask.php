<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Livewire\Attributes\On;

class ListTask extends Component
{
    public $editTask = false;
    public $name="";
    public $id="";
    public $project;

    #[On('task-created')]
    public function render()
    {
        $tasks = Task::when($this->project, function ($query) {
            $query->where('project_id', $this->project);
        })->orderBy('priority')->get();
        return view('livewire.list-task',compact('tasks'));
    }

    public function delete(Task $task)
    {
        $task->delete();
        session()->flash('success', 'Task deleted');
    }

    #[On('show-task-modal')]
    public function edit(Task $task)
    {
        $this->editTask = true;
        $this->id = $task->id;
        $this->name= $task->name;
    }

    public function update(Task $task)
    {
        $task->update(['name'=>$this->name]);
        session()->flash('success', 'Task updated');
        $this->editTask = false;
        $this->reset('name');
    }

    public function updateTaskOrder($tasks)
    {
        foreach($tasks as $task)
        {
            Task::find($task['value'])->update(['priority' => $task['order']]);
        }
    }

    #[On('updated-project')]
    public function showProjectTask($project)
    {

        $this->project = $project;
    }
}
