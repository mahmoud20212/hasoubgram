<x-app-layout>
    <div class="card p-10">
        <h1 class="text-3xl mb-10">{{ __('Edit Post') }}</h1>
        <div class="flex flex-col justify center items-center w-full">
            @if ($errors->any())
                <div class="w-full bg-red-50 text-red-700 p-5 mb-5">
                    <ul class="list-disc pl-4">
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form action="{{ route('posts.update', $post->id) }}" method="post" class="w-full" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-create-edit :post="$post" />
            <x-primary-button class="mt-4">{{ __('Update Post') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>