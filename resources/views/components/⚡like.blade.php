<?php

use Livewire\Component;

new class extends Component {
    public $post;

    public function toggleLike()
    {
        auth()->user()->likes()->toggle($this->post);
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