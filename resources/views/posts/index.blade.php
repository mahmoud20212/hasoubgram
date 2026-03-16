<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
        <div class="w-[70rem] mx-auto lg:w-[95]rem">
            @forelse ($posts as $post)
                <x-post :post="$post" />
            @empty
                <div class="max-w-2xl mx-auto">
                    {{ __('Start following your friends and enjoy') }}
                </div>
            @endforelse
        </div>

        <div class="hidden w-[30rem] lg:flex lg:flex-col pt-4">
            <div class="flex flex-row text-sm gap-2">
                <div class="mr-5">
                    <a href="#">
                        <img src="{{ Auth::user()->image }}" alt="{{ Auth::user()->username }}" class="border border-gray-300 rounded-full w-12 h-12">
                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="#" class="font-bold">{{ Auth::user()->username }}</a>
                    <div class="text-gray-500 text-sm">
                        {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h3 class="text-gray-500 font-bold">
                    {{ __('Suggestions for you') }}
                </h3>
                <ul>
                    @foreach ($suggested_users as $user)
                        <li class="flex flex-row my-5 text-sm justify-center gap-2">
                            <div class="mr-5">
                                <a href="#">
                                    <img src="{{ $user->image }}" alt="{{ $user->username }}" class="border border-gray-300 rounded-full w-9 h-9">
                                </a>
                            </div>
                            <div class="flex flex-col grow">
                                <a href="#" class="font-bold text-black">
                                    {{ $user->username }}
                                </a>
                                <div class="text-gray-500 text-sm">
                                    {{ $user->name }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>