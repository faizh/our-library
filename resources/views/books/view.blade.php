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

                    <form method="post" class="mt-6 space-y-6">
                        @csrf
                        @method('post')
                
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="current-password" value="{{ $book->BookName }}"  disabled />
                            <x-input-error :messages="$errors->updatePassword->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="current-password" value="{{ $book->bookType->BookType }}" disabled />
                            <x-input-error :messages="$errors->updatePassword->get('name')" class="mt-2" />
                        </div>

                        <div>
                            
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" autocomplete="current-password" value="{{ $book->Description }}"  disabled />
                            <x-input-error :messages="$errors->updatePassword->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="publisher" :value="__('Publisher')" />
                            <x-text-input id="publisher" name="publisher" type="text" class="mt-1 block w-full" autocomplete="current-password" value="{{ $book->Publisher }}"  disabled />
                            <x-input-error :messages="$errors->updatePassword->get('publisher')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="year" :value="__('Year')" />
                            <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" autocomplete="current-password" value="{{ $book->Year }}"  disabled />
                            <x-input-error :messages="$errors->updatePassword->get('year')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" autocomplete="current-password" value="{{ $book->Stock }}"  disabled />
                            <x-input-error :messages="$errors->updatePassword->get('stock')" class="mt-2" />
                        </div>
                
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
