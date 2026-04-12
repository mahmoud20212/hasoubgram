<?php

use Livewire\Component;

new class extends Component
{
    protected $listeners = [
        'requestConfirmed' => '$refresh',
        'requestDeleted' => '$refresh',
        'toggleFollow' => '$refresh',
    ];

    public function getCountProperty()
    {
        return auth()->user()->pendingFollowers()->count();
    }
};
?>

<div wire:poll.2s>
    @if ($this->count > 0)
        <span class="bg-red-500 text-white rounded-full text-sm absolute w-5 h-5 p-0 text-center bottom-3 left-4">
            {{ $this->count }}
        </span>
    @endif
</div>