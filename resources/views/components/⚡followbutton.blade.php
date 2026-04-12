<?php

use Livewire\Component;

new class extends Component {
    public $userFriend;
    public $isFollowing;
    public $isPending;
    public $classes;
    public $showBackground;

    public function mount($userFriend, $showBackground = false)
    {
        $this->userFriend = $userFriend;
        $this->updateFollowStatus();
        $this->showBackground = $showBackground;
    }

    public function toggleFollow()
    {
        $user = auth()->user();
        if ($this->isFollowing) {
            $user->unfollow($this->userFriend);
        } elseif (!$this->isPending) {
            $user->follow($this->userFriend);
            $this->dispatch('toggleFollow');
        }
        $this->updateFollowStatus();
    }

    public function updateFollowStatus()
    {
        $this->isFollowing = auth()->user()->isFollowing($this->userFriend);
        $this->isPending = auth()->user()->isPending($this->userFriend);
    }
};
?>

<div>
    @if ($isFollowing)
        <a wire:click="toggleFollow"
            class="w-30 cursor-pointer text-sm font-bold py-1 px-3 text-center rounded text-red-500 {{ $showBackground ? 'bg-red-400' : '' }} {{ $classes }}">
            {{ __('Unfollow') }}
        </a>
    @elseif ($isPending)
        <span class="w-30 cursor-pointer text-sm font-bold py-1 px-3 text-center rounded bg-gray-400 text-white">
            {{ __('Pending') }}
        </span>
    @else
        <a wire:click="toggleFollow"
            class="w-30 cursor-pointer text-sm font-bold py-1 px-3 text-center rounded text-blue-500 {{ $showBackground ? 'bg-blue-400' : '' }} {{ $classes }}">
            {{ __('Follow') }}
        </a>
    @endif
</div>