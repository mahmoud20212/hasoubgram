<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class EditPostModal extends ModalComponent
{
    use WithFileUploads;

    public $postId;
    protected $post;
    public $description;
    public $newImage;

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->post = Post::find($postId);
        $this->description = $this->post->description;
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function update()
    {
        $post = Post::find($this->postId);

        if (!$post) {
            session()->flash('error', 'Post not found');
            return;
        }

        $this->validate([
            'description' => 'required|string|max:255',
            'newImage' => 'nullable|image|max:10240', // Max 10MB
        ]);

        $updateData = [
            'description' => $this->description
        ];

        if (empty($this->description)) {
            $errorMessage = __('Description cannot be empty');
            session()->flash('error', $errorMessage);
            return redirect()->route('posts.show', ['post' => $post->slug]);
        }

        if ($this->newImage) {
            Storage::delete('public/' . $post->image);
            $imagePath = $this->newImage->store('posts', 'public');
            $updateData['image'] = $imagePath;
        }

        $post->update($updateData);

        $this->closeModal();
        return redirect()->route('posts.show', ['post' => $post->slug]);
    }

    public function render()
    {
        return view('components.⚡edit-post-modal');
    }
};

