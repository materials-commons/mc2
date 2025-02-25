<?php

namespace App\Livewire\Projects;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use function config;

class ShowProject extends Component
{

    public $project;
    public function mount($id)
    {
        $apiUrl = config('mc.url');
        $resp = Http::withToken(config('user.token'))
                    ->get("{$apiUrl}/projects/{$id}");

        if ($resp->ok()) {
            $this->project = $resp->object()->data;
        }
    }

    public function render()
    {
        return view('livewire.projects.show-project');
    }
}
