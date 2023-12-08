<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class CreateTask extends Component
{
    #[Validate('required')]
    public $name;

    #[Validate('required|integer')]
    public $project;

    public function create()
    {
        $this->validate();

        Task::create([
            'name' => $this->name,
            'project_id' => $this->project,
            'priority' => Task::max('priority') + 1,
        ]);

        $this->reset('name');

        $this->dispatch('task-created' );

        session()->flash('suc   cess', 'Task successfully created.');

    }

    #[On('project-created')]
    public function render()
    {
        $projects = Project::select('id','name')->get();
        return view('livewire.create-task',compact('projects'));
    }

    public function updatedProject()
    {
        $this->dispatch('updated-project',project:$this->project);
    }
}
