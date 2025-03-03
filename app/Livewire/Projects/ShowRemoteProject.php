<?php

namespace App\Livewire\Projects;

use App\Jobs\Projects\DownloadFileJob;
use App\Jobs\Projects\UploadFileJob;
use App\Models\LocalProject;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Native\Laravel\Dialog;
use Native\Laravel\Facades\Shell;
use function config;

class ShowRemoteProject extends Component
{
    public $localProject;
    public $project;
    public $directory;
    public $filesToDownload;
    public $markdown = <<<'END'
# Hello there
- item 1
- item 2
END;

    public function mount($id)
    {
        $apiUrl = config('mc.url');
        $resp = Http::withToken(config('user.token'))
                    ->get("{$apiUrl}/projects/{$id}");

        if ($resp->ok()) {
            $this->project = $resp->object()->data;
        }

        $this->localProject = LocalProject::where('remote_id', $id)->first();
    }

    public function openProjectOnMC()
    {
        Shell::openExternal("https://materialscommons.org/app/projects/{$this->project->id}");
    }

    public function uploadFiles()
    {
        $files = Dialog::new()
                       ->title("Select Files To Upload")
                       ->multiple()
                       ->open();
        $url = config('mc.url');
        $resp = Http::withToken(config('user.token'))
                    ->post("{$url}/files/by_path", [
                        'project_id' => $this->project->id,
                        'path'       => $this->directory,
                    ]);
        if ($resp->ok()) {
            $dir = $resp->object()->data;
            foreach ($files as $file) {
                UploadFileJob::dispatch($this->project, $dir, $file);
            }
        }
    }

    public function downloadFiles()
    {
        $files = explode(';', $this->filesToDownload);
        $dir = Dialog::new()
                     ->title("Select Directory To Put Files")
                     ->folders()
                     ->open();

        foreach ($files as $file) {
            $trimmed = trim($file);
            DownloadFileJob::dispatch($this->project, $dir, $trimmed);
        }

        $this->filesToDownload = '';
    }

    public function uploadDirectories()
    {
        $dir = Dialog::new()
                     ->title("Select Directories To Upload")
                     ->folders()
                     ->open();
        ray("directories = ", $dir);
    }

    public function setLocalDir()
    {
        $dir = Dialog::new()
                     ->title("Select Directories To Upload")
                     ->folders()
                     ->open();
        if (is_null($dir)) {
            return;
        }

        $this->localProject = LocalProject::create([
            'name'       => $this->project->name,
            'remote_id'  => $this->project->id,
            'local_path' => $dir,
        ]);
    }

    public function openLocalProjectDir()
    {
        Shell::showInFolder($this->localProject->local_path);
    }

    public function render()
    {
        return view('livewire.projects.show-remote-project');
    }
}
