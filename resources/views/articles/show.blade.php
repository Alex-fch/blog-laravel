<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="mt-16">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="flex items-center">
                            <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>

                            <h2 class="ml-4 text-xl font-semibold text-gray-900 dark:text-white">{{ $article->title }}</h2>
                        </div>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            {{ $article->content }}
                        </p>
                        <div class="flex justify-between items-center">
                            <div class=mt-6>
                                <span class="text-gray-800">{{ $article->user->name }} |</span>
                                <small class="ml-1 text-sm text-gray-600">{{ $article->created_at->translatedFormat('j M Y, h:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach($article->comment as $comment)
        <div class="mt-4">
            <div class=" grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div class="w-full">
                        <div>
                            <div class="flex justify-between items-center">
                                <div class="flex justify-between items-center">
                                    <h2 class="ml-4 text-xl font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</h2>
                                </div>
                                @if ($comment->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('comments.edit', $comment)">
                                            Edit
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                                @endif
                            </div>
                        </div>
                        <p class="mt-4 ml-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            {{ $comment->content }}
                        </p>
                        <div class="flex justify-between items-center">
                            <div class=mt-4>
                                <small class="ml-4 text-sm text-gray-600">{{ $comment->created_at->translatedFormat('j M Y, h:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @if(Auth::user())
        <div class="mt-4">
            <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" placeholder="{{ __('Partage ton avis !') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message') }}</textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('Publier') }}</x-primary-button>
            </form>
        </div>
        @endif

</x-app-layout>