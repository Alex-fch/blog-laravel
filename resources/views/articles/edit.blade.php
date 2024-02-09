<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <form method="POST" action="{{ route('article.update', $article) }}">
            @csrf
            @method('patch')
            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                    <div>
                        <div class="flex items-center">
                            <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <div class="ml-4 mb-2 flex">
                                <div class="w-64">
                                    <x-input-label for="title" :value="__('Titre :')" />
                                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $article->title }}" required autofocus autocomplete="title" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="ml-4 w-64">
                                    <label for="tag" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Tag :</label>
                                    <select id="tag_id" name="tag_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Choisir un tag</option>
                                        @foreach($tags as $tag)
                                        @if(isset($article) && $tag->name === $article->tag[0]->name)
                                        <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                                        @else
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ml-4 w-64">
                                    <label for="category" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Catégorie :</label>
                                    <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Choisir une catégorie</option>
                                        @foreach($categories as $category)
                                        @if(isset($article) && $category->name === $article->category[0]->name)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <textarea name="content" placeholder="{{ __('Article...') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">@if(isset($article)){{ $article->content }} @else {{ old('message') }} @endif</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <input type="hidden" name="is_approved" value="0">

                <x-primary-button class="ms-4" name="draft" value="0">
                    {{ __('Publier') }}
                </x-primary-button>
                <x-primary-button class="ms-4" name="draft" value="1">
                    {{ __('Brouillon') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>