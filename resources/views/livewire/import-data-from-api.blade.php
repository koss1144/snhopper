<div class="text-center">
    <button wire:click="handleDataFromApi"
            class="relative @if ($import_completed) bg-blue-500 @else bg-gray-800 @endif
                text-white p-4 rounded text-2xl font-bold overflow-visible mt-10">
        @if (!$import_completed) Import @else Update @endif data from API
    </button>
    <br/>
    <div wire:loading class="loading">@if (!$import_completed) Importing @else Updating @endif ...</div>
</div>


