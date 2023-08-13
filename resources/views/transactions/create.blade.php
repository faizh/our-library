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
                    {{ __("Checkout!") }}

                    <div class="mt-5">
                        <table class="w-full">
                            <tr>
                                <td>Name</td>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <td>Date of Loan</td>
                                <td>{{ date('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>Date of Return</td>
                                <td>
                                    @php 
                                    $currentDate = date('l, d F Y', strtotime(date('d F Y') . "+1 days"));
                                    echo $currentDate;
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>List of Books</td>
                                <td>
                                    <table>
                                        @foreach ($carts as $cart)
                                            <tr>
                                                <td>{{ $loop->iteration .". " }}</td>
                                                <td>{{ $cart->book->BookName }}</td>
                                                <td>{{ "(" . $cart->qty . " pcs)" }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <form method="post" action="{{ route('transactions.store') }}" class="mt-5 space-y-5">
                            @csrf
                            @method('post')

                            <x-primary-button>Checkout</x-primary-button>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
