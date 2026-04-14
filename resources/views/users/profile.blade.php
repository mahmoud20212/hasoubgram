<x-app-layout>
    <div class="grid grid-cols-4">
        {{-- User Image --}}
        <div class="px-4 col-span-1 order-1">
            <img src="{{ $user->image }}" alt="{{ $user->username }}"
                class="rounded-full w-20 h-20 object-cover md:w-40 md:h-40 border-neutral-300">
        </div>
        <div class="px-4 col-span-2 md:ml-0 flex flex-col order-2 md:col-span-3">
            <div class="text-3xl mb-2">{{ $user->username }}</div>
            @auth
            @if ($user->id === Auth::id())
                <div class="flex space-x-3 items-center">
                    <a href="/profile"
                        class="w-50 h-8 flex items-center justify-center text-sm font-semibold px-4 rounded-md border border-neutral-300 hover:bg-neutral-50 transition-colors cursor-pointer">
                        {{ __('Edit Profile') }}
                    </a>
                </div>
            @else
                @livewire('followbutton', ['userFriend' => $user, 'showBackground' => true, 'classes' => 'text-white'])
            @endif
            @endauth
            @guest
                <div>
                    <a href="{{ route('login') }}" class="w-30 bg-blue-400 text-white font-blod px-3 py-1 rounded text-center self-start">
                        {{ __('Follow') }}
                    </a>
                </div>
            @endguest
        </div>
        <div class="text-md mt-8 px-4 col-span-3 col-start-1 order-3 md:col-start-2 md:order-4 md:mt-0">
            <p class="font-bold">{{ $user->name }}</p>
            {!! nl2br(e($user->bio)) !!}
        </div>
        <div
            class="col-span-4 my-5 py-2 border-y border-y-neutral-200 order-4 md:order-3 md:border-none md:px-4 md:col-start-2">
            <ul class="text-md flex flex-row justify-between md:justify-start md:gap-8 md:text-xl">
                <li class="flex flex-col md:flex-row text-center gap-3">
                    <div class="md:mr-2 font-bold md:font-normal">
                        {{ $user->posts->count() }}
                    </div>
                    <span class="text-neutral-500 md:text-black">
                        {{ $user->posts->count() > 1 ? __('Posts') : __('Post') }}
                    </span>
                </li>
                @livewire('follower', ['userId' => $user->id])
                @livewire('following', ['userId' => $user->id])
            </ul>
        </div>
    </div>
    @if ($user->posts->count() > 0 && (!$user->private_account || auth()->id() === $user->id || $user->follower()->where('users.id', auth()->id())->where('confirmed', true)->exists()))
        <div class="grid grid-cols-3 gap-4 my-5">
            @foreach ($user->posts as $post)
                <a href="/posts/{{ $post->slug }}" class="aspect-square block w-full">
                    <div class="group relative">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                            class="w-full aspect-square object-cover">
                        @if (auth()->id() === $post->user_id)
                            <div
                                class="absolute top-0 left-0 w-full h-full flex justify-center items-center group-hover:bg-black/40">
                                <ul class="invisible group-hover:visible flex flex-row">
                                    <li class="flex items-center text-2xl text-white font-bold mr-2">
                                        <i class="bx bxs-heart mr-1"></i>
                                        <span>{{ $post->likes->count() }}</span>
                                    </li>
                                    <li class="flex items-center text-2xl text-white font-bold mr-2">
                                        <i class="bx bxs-comment mr-1"></i>
                                        <span>{{ $post->comments->count() }}</span>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="w-full text-center mt-20">
            @if ($user->private_account && $user->id !== auth()->id())
                {{ __('This account is private follow to see thier photos') }}
            @else
                {{ __('No posts to show') }}
            @endif
        </div>
    @endif
</x-app-layout>