<?php

use Livewire\Component;

new class extends Component
{
    public $unreadCount;
};
?>

@php
    if (Auth::check()) {
        $unreadCount = auth()->user()->unreadNotifications()->whereNull('read_at')->count();
        $this->unreadCount = $unreadCount;
    } else {
        $this->unreadCount = 0;
    }
@endphp

<div wire:poll.2s>
    @if ($unreadCount > 0)
        <span class="absolute w-5 h-5 bottom-3 left-4 bg-red-500 text-white text-xs rounded-full p-0.5 text-center">
            {{ $unreadCount }}
        </span>
    @endif
</div>