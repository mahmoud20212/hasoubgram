<?php

use Livewire\Component;
use App\Models\Post;

new class extends Component
{
    public $posts = [];
    protected $listeners = ['toggleFollow' => 'loadPosts'];

    public function mount()
    {
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $ids = auth()->user()->following()->wherePivot('confirmed', true)->get()->pluck('id');
        $this->posts = Post::whereIn('user_id', $ids)->latest()->get();
    }
};
?>

<div class="w-[70rem] mx-auto lg:w-[95]rem">
    @forelse ($this->posts as $post)
        <livewire:post :post="$post" wire:key="post-{{ $post->id }}" />
    @empty
        <div class="max-w-2xl mx-auto">
            {{ __('Start following your friends and enjoy') }}
        </div>
    @endforelse
</div>