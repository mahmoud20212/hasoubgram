<?php

use Livewire\Component;

new class extends Component
{
    public $post;

    protected $listeners = ['likeToggled' => 'getLikesProperty'];
    public function getFirstusernameProperty()
    {
        return $this->post->likes()->first()->username;
    }

    public function getLikesProperty()
    {
        return $this->post->likes()->count();
    }
};
?>

<div class="px-5 mb-5">
    @if ($this->likes > 0)
        <strong>
            <a href="{{ route('user.profile', $this->firstusername) }}">
                {{ $this->firstusername }}
            </a>
        </strong>
    @endif
    @if ($this->likes > 1)
        {{ __('and') }} <strong>{{ __('others') }}</strong>
    @endif
</div>