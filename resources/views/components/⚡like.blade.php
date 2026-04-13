<?php

use Livewire\Component;
use App\Notifications\PostLiked;

new class extends Component {
    public $post;

    public function toggleLike()
    {
        $result = auth()->user()->likes()->toggle($this->post);
        // if the post is liked and the post owner is not the current user, send a notification
        if(!empty($result['attached']) && $this->post->owner->id !== auth()->id()) {
            $this->post->owner->notify(new PostLiked($this->post, auth()->user()));
        }
        $this->dispatch('likeToggled');
    }
};
?>

<div>
    <a wire:click="toggleLike" class="cursor-pointer">
        @if ($post->liked(Auth::user()))
            <i class="bx bxs-heart text-3xl text-red-600 hover:text-gray-400 cursor-pointer mr-3"></i>
        @else
            <i class="bx bx-heart text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
        @endif
    </a>
</div>