<x-app-layout>
    <div class="h-screen sm:flex sm:flex-row">
        <div class="flex items-center overflow-hidden bg-black md:w-7/12">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->description }}"
                class="object-cover w-full">
        </div>
        <div class="flex flex-col w-full bg-white md:w-5/12">
            <div class="border-b-2">
                <div class="flex items-center p-5 gap-3">
                    <img src="{{ $post->owner->image }}" alt="{{ $post->owner->username }}"
                        class="rounded-full w-10 h-10">
                    <div class="grow">
                        <a href="{{ route('user.profile', $post->owner->username) }}"
                            class="font-bold">{{ $post->owner->username }}</a>
                    </div>
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post->slug) }}">
                            <i class='bx bx-message-square-edit'></i>
                        </a>
                        <form action="{{ route('posts.destroy', $post->id) }}" id="delete-post-form-{{ $post->id }}"
                            method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="confirmDelete({{ $post->id }});">
                                <i class="bx bx-message-square-x inline ml-2"></i>
                            </button>
                        </form>
                    @endcan
                    @cannot('update', $post)
                    @livewire('followbutton', ['userFriend'=> $post->owner])
                    @endcannot
                </div>
            </div>

            <div class="grow">
                <div class="flex items-start px-5 py-2 gap-3">
                    <img src="{{ $post->owner->image }}" alt="{{ $post->owner->username }}"
                        class="ltr:mr-5 rtl:ml-5 rounded-full w-10 h-10">
                    <div class="flex flex-col">
                        <div>
                            <a href="{{ route('user.profile', $post->owner->username) }}"
                                class="font-bold">{{ $post->owner->username }}</a>
                            <span class="inline">{{ $post->description }}</span>
                        </div>
                        <div class="mt-1 text-sm text-gray-400">
                            {{ $post->created_at->diffForHumans(null, true, true) }}
                        </div>
                    </div>
                </div>

                @foreach ($post->comments as $comment)
                    <div class="flex items-start px-5 py-2 gap-2">
                        <img src="{{ $comment->owner->image }}" alt="{{ $comment->owner->username }}"
                            class="h-10 w-10 rounded-full ltr:mr-5 rtl:ml-5">
                        <div class="flex flex-col">
                            <a href="{{ route('user.profile', $comment->owner->username) }}"
                                class="font-bold mr-2 inline-block">{{ $comment->owner->username }}</a>
                            <span class="inline">{{ $comment->body }}</span>
                        </div>
                        <div class="mt-1 text-sm text-gray-400">
                            {{ $comment->created_at->diffForHumans(null, true, true) }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="border-t p-3 flex flex-row">
                @livewire('like', ['post' => $post])
                <a onclick="document.getElementById('comment_body').focus();">
                    <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
                </a>
            </div>
            @livewire('likedby', ['post' => $post])
            <div class="border-t p-5">
                <form action="/posts/{{ $post->slug }}/comment" method="POST">
                    @csrf
                    @if ($errors->has('body'))
                        <div class="text-red-500 text-sm mb-2">
                            {{ $errors->first('body') }}
                        </div>
                    @endif
                    <div class="flex flex-row">
                        <textarea name="body" id="comment_body" placeholder="{{ __('Add a comment...') }}"
                            class="h-10 grow resize-none overflow-hidden border-none bg-white text-blue-500 outline-0 focus:ring-0"
                            required></textarea>
                        <button type="submit" class="ltr:mr-5 rtl:ml-5 border-none bg-white text-blue-500">
                            {{ __('Comment') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function confirmDelete(postId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-post-form-' + postId).submit();
            }
        });
    }
</script>