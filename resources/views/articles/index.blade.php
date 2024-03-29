<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="mt-16">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                @foreach ($articles as $article)
                <x-dropdown-link :href="route('articles.show', $article)" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div class="w-full">
                        <div class="flex items-center">
                            <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>

                            <h2 class="ml-4 text-xl font-semibold text-gray-900 dark:text-white">{{ $article->title }}</h2>
                            @if($article->draft)
                            <span class="ml-4">Brouillon</span>
                            @endif
                        </div>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            {{ strlen($article->content) > 250 ? substr($article->content, 0, 250) . '...' :  $article->content}}
                        </p>
                        <div class="flex">
                            <div class=mt-6>
                                <span class="text-gray-800">{{ $article->user->name }} | </span>
                                <small class="ml-2 text-sm text-gray-600">{{ $article->created_at->translatedFormat('j M Y, h:i') }}</small>
                            </div>
                            <div class="ml-4 mt-6 ml-auto">
                                <span>{{count($article->comment) > 1 ? "Commentaires :" : "Commentaire :"}} {{count($article->comment)}}</span>
                            </div>
                        </div>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </x-dropdown-link>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>