<?php

use Livewire\Component;
use App\Models\User;

new class extends Component
{
    protected $follower;

    // listen for events
    protected $listeners = [
        'requestConfirmed' => '$refresh',
        'requestDeleted' => '$refresh',
        'toggleFollow' => '$refresh',
    ];

    public function confirm($id)
    {
        $this->follower = User::find($id);
        Auth::user()->confirm($this->follower);
        $this->dispatch('requestConfirmed'); // Make event
    }

    public function delete($id)
    {
        $this->follower = User::find($id);
        Auth::user()->deleteFollowingRequest($this->follower);
        $this->dispatch('requestDeleted'); // Make event
    }
};
?>

<div wire:poll.2s class="max-h-64 overflow-y-auto w-full">
    <ul class="w-full devide-y devide-gray-200">
        @forelse (auth()->user()->pendingFollowers() as $pending)
            <li class="flex items-center justify-between gap-2 p-3 w-full" wire:key="user-{{ $pending->id }}">
                <div class="flex items-center gap-3">
                    <img src="{{ $pending->image }}" class="w-10 h-10 rounded-full border border-neutral-300" alt="">
                    <div class="flex flex-col">
                        <span class="font-semibold text-sm truncate w-36">
                            <a href="{{ route('user.profile', $pending->username) }}">{{ $pending->username }}</a>
                        </span>
                        <span class="text-xs text-gray-500 truncate w-36">
                            {{ $pending->name }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-1">
                    <button wire:click="confirm({{ $pending->id }})" class="px-2 py-1 text-sm bg-blue-500 text-white rounded">
                        {{ __('Confirm') }}
                    </button>
                    <button wire:click="delete({{ $pending->id }})" class="px-2 py-1 text-sm border border-gray-400 rounded">
                        {{ __('Delete') }}
                    </button>
                </div>
            </li>
        @empty
            <li class="p-3 text-center text-sm text-gray-500">{{ __('There are no pending requests') }}</li>
        @endforelse
    </ul>
</div>