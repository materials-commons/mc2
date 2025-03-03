<?php

namespace App\Jobs\Projects;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use function basename;
use function config;
use function file_get_contents;

class UploadFileJob implements ShouldQueue
{
    use Queueable;

    private $project;
    private $directory;
    private $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct($project, $directory, $filePath)
    {
        $this->project = $project;
        $this->directory = $directory;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mcUrl = config('mc.url');
        $url = "{$mcUrl}/projects/{$this->project->id}/files/{$this->directory->id}/upload";
        $resp = Http::withToken(config('user.token'))
                    ->attach('files[]', file_get_contents($this->filePath), basename($this->filePath))
                    ->post($url);
        if ($resp->failed()) {
            throw new \Exception($resp->body());
        }
    }
}
