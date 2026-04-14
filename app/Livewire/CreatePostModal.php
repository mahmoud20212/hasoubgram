<?php

namespace App\Livewire;

// use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;

class CreatePostModal extends ModalComponent
{
    use WithFileUploads;

    public $image;

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function saveTemp()
    {
        $this->validate([
            'image' => 'required|image|max:2048', // max 2MB
        ]);

        $tempPath = $this->image->store('temp', 'public');

        // session()->put('temp_image_path', $tempPath);

        $this->dispatch('openModal', 'filter-modal', ['image' => $tempPath]);
    }

    public function render()
    {
        return view('components.⚡create-post-modal');
    }
};
