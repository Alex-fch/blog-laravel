<x-app-layout>
    <div class="mt-4">
        <form method="POST" action="{{ route('comments.update', $comment) }}">
            @csrf
            @method('patch')
            <div class=" grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div class="w-full">
                        <div>
                            <div class="flex justify-between items-center">
                                <div class="flex justify-between items-center">
                                    <h2 class="ml-2 text-xl font-semibold text-gray-900 dark:text-white">Commentaire :</h2>
                                </div>
                            </div>
                        </div>
                        <textarea name="content" placeholder="{{ __('Commentaire...') }}" class="mt-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $comment->content }}</textarea>
                        <input type="hidden" name="article" value="{{ $article }}" />
                        <x-primary-button class="mt-4" name="draft" value="0">
                            {{ __('Publier') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>