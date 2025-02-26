<div class="mt-4">
    <x-modal :id="'not-implemented'" :title="'Not Implemented'">
        <x-slot:body>
            <h5>This feature is not implemented yet.</h5>
        </x-slot:body>
    </x-modal>
    <x-modal :id="'upload-files'" :title="'Upload Files'">
        <x-slot:body>
            <label for="dir">Directory To Upload Files To</label>
            <input wire:model="directory" type="text" id="dir">
        </x-slot:body>
        <x-slot:footer>
            <button wire:click="uploadFiles" class="btn btn-primary" data-bs-dismiss="modal">Select Files To Upload
            </button>
        </x-slot:footer>
    </x-modal>
    <x-modal :id="'download-files'" :title="'Download Files'">
        <x-slot:body>
            <label for="downloadFiles">Files To Download (Full path)</label>
            <input wire:model="filesToDownload" id="downloadFiles" type="text"
                   placeholder="Semi-colon separate list of files">
        </x-slot:body>
        <x-slot:footer>
            <button wire:click="downloadFiles" class="btn btn-primary" data-bs-dismiss="modal">
                Select Directory To Put Files
            </button>
        </x-slot:footer>
    </x-modal>
    <h4>Project: {{$project->name}}</h4>
    <div class="mt-4">
        <button wire:click="openProjectOnMC" class="btn btn-primary">Goto Project On Materials Commons</button>
        <button data-bs-toggle="modal" data-bs-target="#upload-files" class="btn btn-primary">Upload Files</button>
        <button wire:click="uploadDirectories" class="btn btn-primary">Upload Directory</button>
        <button data-bs-toggle="modal" data-bs-target="#download-files" class="btn btn-primary">Download Files</button>
        <button data-bs-toggle="modal" data-bs-target="#not-implemented" class="btn btn-primary">Sync</button>
    </div>
</div>
