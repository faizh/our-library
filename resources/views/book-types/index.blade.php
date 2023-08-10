<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("List of OurBook Categories!") }}

                    <div class="mt-2">
                        <div style="float: right">
                            <a href="{{ route('book-types.add') }}">
                                <x-primary-button>{{ __('Add new Category') }}</x-primary-button>
                            </a>
                        </div>

                        <table class="border-collapse table-auto w-full text-sm">
                            <thead>
                                <tr>
                                    <th
                                        class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Category ID</th>
                                    <th
                                        class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Category Name</th>
                                    <th
                                        class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="dark:bg-slate-800">
                                @foreach ($bookTypes as $bookType)
                                    <tr>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                            {{ $bookType->id }}</td>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                                            {{ $bookType->BookType }}</td>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                                <a href="{{ route('book-types.edit', $bookType->id) }}"><x-primary-button>Edit</x-primary-button></a>
                                                <a href="{{ route('book-types.delete', $bookType->id) }}"><x-primary-button>Delete</x-primary-button></a>
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
