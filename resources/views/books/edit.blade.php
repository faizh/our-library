<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Book's Detail") }}

                    <form method="post" action="{{ route('books.update', $book->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')
                
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="current-password" value="{{ $book->BookName }}"  />
                            <x-input-error :messages="$errors->updatePassword->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="type" :value="__('Type')" />
                            <select id="countries" name="category" class="mt-1 bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-60 dark:focus:ring-indigo-600 shadow-sm">
                                <option value="" disabled selected>Choose Book's Category</option>
                                @foreach ($bookTypes as $bookType)
                                    <option value="{{ $bookType->id }}" {{ ($bookType->id == $book->BookTypeId) ? 'selected' : ''}}>{{ $bookType->BookType }}</option>
                                @endforeach>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" autocomplete="current-password" value="{{ $book->Description }}"  />
                            <x-input-error :messages="$errors->updatePassword->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="publisher" :value="__('Publisher')" />
                            <x-text-input id="publisher" name="publisher" type="text" class="mt-1 block w-full" autocomplete="current-password" value="{{ $book->Publisher }}"  />
                            <x-input-error :messages="$errors->updatePassword->get('publisher')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="year" :value="__('Year')" />
                            <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" autocomplete="current-password" value="{{ $book->Year }}"  />
                            <x-input-error :messages="$errors->updatePassword->get('year')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" autocomplete="current-password" value="{{ $book->Stock }}"  />
                            <x-input-error :messages="$errors->updatePassword->get('stock')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                
                            @if (session('status') === 'password-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
