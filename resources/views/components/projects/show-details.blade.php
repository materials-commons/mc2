@props([
    'remoteProject',
    'localProject',
])
<div>
    @if(is_null($localProject))
        {{-- Remote only project --}}
        <div class="row">
            <div>
                <span class="me-2">Project Only on Materials Commons</span>
                <a href="#" wire:click.prevent="setLocalDir">Set Local Directory For Project</a>
            </div>
        </div>
    @elseif(is_null($remoteProject))
        {{-- Local only project --}}
        <div class="row">
            <h4>Project Only on Local Machine</h4>
            <div class="col mb-2">
                <span class="me-2">Project Directory: {{$localProject->local_path}}</span>
                <a href="#" class="me-2">Connect To Existing Materials Commons Project</a>
                <a href="#">Create New Materials Commons Project From Local Project</a>
            </div>
        </div>
    @else
        {{-- Remote project with local association --}}
        <div class="row">
            <div class="col mb-2">
                <span class="me-2">Project Directory: {{$localProject->local_path}} </span>
                <a href="#" wire:click.prevent="openLocalProjectDir">Open</a>
            </div>
        </div>
    @endif
</div>