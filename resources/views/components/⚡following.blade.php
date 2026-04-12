<?php

use Livewire\Component;
use App\Models\User;

new class extends Component
{
    public $userId;
    protected $user;

    protected $listeners = ['unfollowuser' => '$refresh'];
    
    public function getCountProperty()
    {
        $this->user = User::find($this->userId);
        return $this->user->following()->wherePivot('confirmed', true)->count();
    }
};
?>

<li class="flex flex-col md:flex-row text-center gap-2">
    <div class="ltr:md:mr-1 rtl:md:ml-1 font-bold md:font-normal">
        {{ $this->count }}
    </div>
    <button class="text-neutral-500 md:text-black" onclick="Livewire.dispatch('openModal', { component: 'following-modal', arguments: { userId: {{ $userId }} } })">
        {{ __('Following') }}
    </button>
</li>