<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
        <livewire:posts-list />

        <div class="hidden w-[30rem] lg:flex lg:flex-col pt-4">
            <div class="{{ session('status') ? '' : 'hidden' }} w-50 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg absolute right-10 shadow shadow-neutral-200">
                <span class="font-medium">{{ session('status') }}</span>
            </div>
            <div class="flex flex-row text-sm gap-2">
                <div class="mr-5">
                    <a href="{{ route('user.profile', Auth::user()->username) }}">
                        <img src="{{ Auth::user()->image }}" alt="{{ Auth::user()->username }}" class="border border-gray-300 rounded-full w-12 h-12">
                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="{{ route('user.profile', Auth::user()->username) }}" class="font-bold">{{ Auth::user()->username }}</a>
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
                        <li class="flex items-center justify-between my-5 text-sm gap-2">
                            <div class="mr-5">
                                <a href="{{ route('user.profile', $user->username) }}">
                                    <img src="{{ $user->image }}" alt="{{ $user->username }}" class="border border-gray-300 rounded-full w-9 h-9">
                                </a>
                            </div>
                            <div class="flex flex-col grow">
                                <a href="{{ route('user.profile', $user->username) }}" class="font-bold text-black">
                                    {{ $user->username }}
                                </a>
                                <div class="text-gray-500 text-sm">
                                    {{ $user->name }}
                                </div>
                            </div>
                            <livewire:followbutton :userFriend="$user" />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>