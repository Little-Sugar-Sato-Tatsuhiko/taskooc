<?php

namespace App\Livewire;

use Livewire\Component;

class DiagramPageComponent extends Component
{
    public $diagram;

    public function mount()
    {
        // dd($this->diagram);
    }
    public function render()
    {
        return view('livewire.diagram-page-component', ['diagram' => $this->diagram]);
    }
}
