<x-app-layout>
    <div class="explore-grid">
        @foreach ($posts as $post)
            <div>
                <a href="/posts/{{ $post->slug }}">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded">
                </a>
            </div>
        @endforeach
    </div>
    <div class="mt-5">
        {{ $posts->links() }}
    </div>
</x-app-layout>