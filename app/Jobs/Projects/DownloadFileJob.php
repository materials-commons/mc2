<?php

namespace App\Jobs\Projects;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use function config;

class DownloadFileJob implements ShouldQueue
{
    use Queueable;

    private $project;
    private $dirPath;
    private $file;

    /**
     * Create a new job instance.
     */
    public function __construct($project, $dirPath, $file)
    {
        $this->project = $project;
        $this->dirPath = $dirPath;
        $this->file = $file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mcUrl = config('mc.url');
        $resp = Http::withToken(config('user.token'))
                    ->post("{$mcUrl}/files/by_path", [
                        'project_id' => $this->project->id,
                        'path'       => $this->file,
                    ]);
        if ($resp->failed()) {
            throw new \Exception($resp->body());
        }
        $f = $resp->object()->data;

        $resp = Http::withToken(config('user.token'))
                    ->sink("{$this->dirPath}/{$f->name}")
                    ->get("{$mcUrl}/projects/{$this->project->id}/files/{$f->id}/download");
        if ($resp->failed()) {
            throw new \Exception($resp->body());
        }
    }
}
