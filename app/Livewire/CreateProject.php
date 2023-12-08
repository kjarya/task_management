<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use Livewire\Attributes\Validate;

class CreateProject extends Component
{
    public $createProject= false;

    #[Validate('required')]
    public $name = "";

    public function render()
    {
        return view('livewire.create-project');
    }

    public function create()
    {
        $this->validate();

        Project::create(['name'=>$this->name]);

        $this->reset('name','createProject');
        $this->dispatch('project-created');

        session()->flash('success', 'Project successfully created.');
    }
}
