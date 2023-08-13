@php
    use App\Models\Roles;
@endphp

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
                    {{ __("List of OurBooks!") }}

                    <div class="mt-5">
                        @if ( Auth::user()->role_id == Roles::getRoleAdministrator() )
                            <div style="float: right">
                                <a href="{{ route('books.add') }}">
                                    <x-primary-button>{{ __('Add new Book') }}</x-primary-button>
                                </a>
                            </div>
                        @endif

                        <table class="border-collapse table-auto w-full text-sm">
                            <thead>
                                <tr>
                                    <th
                                        class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Book ID</th>
                                    <th
                                        class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Book Name</th>
                                    <th
                                        class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Book Type</th>
                                    <th
                                        class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="dark:bg-slate-800">
                                @foreach ($books as $book)
                                <tr>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $book->id }}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                                        {{ $book->BookName }}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                        {{ $book->bookType->BookType }}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                        <a href="{{ route('books.view', $book->id) }}"><x-primary-button>Detail</x-primary-button></a>

                                        @if ( Auth::user()->role_id == Roles::getRoleAdministrator() )
                                            <a href="{{ route('books.edit', $book->id) }}"><x-primary-button>Edit</x-primary-button></a>
                                            <a href="{{ route('books.delete', $book->id) }}"><x-primary-button>Delete</x-primary-button>
                                        @endif
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
