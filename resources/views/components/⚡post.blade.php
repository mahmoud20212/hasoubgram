<?php

use Livewire\Component;

new class extends Component
{
    public $post;
};
?>

<div class="card">
    <div class="card-header gap-1">
        <img src="{{ $post->owner->image }}" alt="{{ $post->owner->username }}" class="rounded-full w-9 h-9">
        <a href="#" class="font-bold">
            {{ $post->owner->username }}
        </a>
    </div>
    <div class="card-body">
        <div class="max-h-[35rem] overflow-hidden">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->description }}"
                class="h-auto w-full object-cover">
        </div>
        <div class="p-3 flex flex-row">
            @livewire('like', ['post' => $post])
            <a href="{{ route('posts.show', $post->slug) }}">
                <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
            </a>
        </div>
        <div class="p-3">
            <a href="#" class="font-bold">{{ $post->owner->username }}</a>
            {{ $post->description }}
        </div>
        @if ($post->comments()->count() > 0)
            <a href="/posts/{{ $post->slug }}" class="p-3 font-bold text-sm text-gray-500">
                {{ __('View all ' . $post->comments()->count() . ' comments') }}
            </a>
        @endif
        <div class="p-3 text-gray-400 uppercase text-sm">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>
    <div class="card-footer">
        <form action="/posts/{{ $post->slug }}/comment" method="POST">
            @csrf
            <div class="flex flex-row">
                <textarea name="body" id="comment_body" placeholder="{{ __('Add a comment...') }}" class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-0 focus:ring-0"></textarea>
                <button type="submit" class="ltr:ml-5 rtl:mr-5 border-none bg-white text-blue-500">{{ __('Comment') }}</button>
            </div>
        </form>
    </div>
</div> 