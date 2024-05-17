<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;

class TaskListComponent extends Component
{

    public $task_list = [];
    #[Validate('required', message: 'タスクのタイトルは必須です')]
    public $task_title;
    #[Validate('required', message: 'タスクの担当者は必須です')]
    public $task_member;
    #[Validate('required', message: 'タスクの期限は必須です')]
    public $deadline;
    public $description;

    public function mount()
    {
        array_push($this->task_list, [
            'id' => uniqid(),
            'title' => 'Sample',
            'description' => 'Description',
            'member' => '勅使河原夏彦',
            'deadline' => '2024/1/1',
        ]);
        $this->deadline = Date('Y-m-d');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.task-list-component');
    }

    public function add()
    {
        $this->validate();
        array_push($this->task_list, [
            'id' => uniqid(),
            'title' => $this->task_title,
            'description' => $this->description,
            'member' => $this->task_member,
            'deadline' => $this->deadline,
        ]);

        $this->dispatch('add-task');
    }

    public function trash($id)
    {
        unset($this->task_list[array_search($id, array_column($this->task_list, 'id'))]);
    }
}
