<?php

use Livewire\Component;

new class extends Component
{
    public $notifications;
    protected $listeners = ['likedToggled' => 'refreshNotifications'];

    public function refreshNotifications()
    {
        if (Auth::check()) {
            $this->notifications = auth()->user()->unreadNotifications()->take(5)->get();
        }
    }

    public function markAsReadAndRedirect($notificationId, $url)
    {
        if (Auth::check()) {
            auth()->user()->unreadNotifications()->where('id', $notificationId)->update(['read_at' => now()]);
            $this->refreshNotifications();
            return redirect()->to($url);
        }
    }
};
?>

@php
    $this->refreshNotifications();
@endphp

<div wire:poll.2s class="relative">
    <div class="absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">
        <div class="px-4 py-3 border-b border-gray-100">
            <h3 class="text-sm font-medium text-gray-900">{{ __('Notifications') }}</h3>
        </div>
        <div class="max-h-80 overflow-auto">
            <ul class="divide-y divide-gray-100">
                @forelse ($this->notifications as $notify)
                    <li class="p-3 hover:bg-gray-50" wire:key="notification-{{ $notify->id }}">
                        <a wire:click="markAsReadAndRedirect('{{ $notify->id }}', '{{ $notify->data['post_link'] }}')" class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center">
                                <img src="{{ $notify->data['user_image'] }}" class="h-10 w-10 rounded-full object-cover" alt="">
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm text-gray-800">
                                    <span class="font-medium">{{ $notify->data['username'] }}</span>
                                    <span class="text-gray-600">{{ $notify->data['message'] }}</span>
                                </p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notify->created_at->diffForHumans() }}</p>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="px-4 py-6 text-center">
                        <p class="text-sm text-gray-500">
                            {{ __('No new notifications') }}
                        </p>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>