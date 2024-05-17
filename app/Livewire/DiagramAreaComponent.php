<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskDiagram;

class DiagramAreaComponent extends Component
{
    public function render()
    {
        return view('livewire.diagram-area-component');
    }

    public function save($token, $data)
    {
        \Log::debug('token', ['token' => $token]);
        $diagram = TaskDiagram::firstOrNew(['token' => $token]);
        $diagram->token = $token ?? rand(1, 1000) . uniqid() . rand(1, 1000);
        $diagram->diagram = $data;
        $diagram->save();
        \Log::debug('save_id', ['token' => $diagram->token, 'diagram.token' => $diagram->token]);
        return redirect('/?token=' . $diagram->token);
    }
}
