<?php

namespace App\Livewire;

// use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowerModal extends ModalComponent
{
    public $userId;
    protected $user;

    public function getFollowerListProperty()
    {
        $this->user = User::find($this->userId);
        return $this->user->follower()->wherePivot('confirmed', true)->get();
    }

    public function removeFollower($userId)
    {
        $follower = User::find($userId); 
        $this->user = User::find($this->userId);
        $follower->unfollow($this->user);
        $this->dispatch('unfollowuser');
    }

    public function render()
    {
        return view('components.⚡follower-modal');
    }
};
