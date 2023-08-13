<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-3">
                        <table class="w-full">
                            <tr>
                                <td>Transaction Code</td>
                                <td>{{ $transaction->TransCode }}</td>
                            </tr>
                            <tr>
                                <td>Date of Loan</td>
                                <td>{{ date_format(date_create($transaction->TransDate), 'l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>Date of Return</td>
                                <td>
                                    {{ date_format(date_add(date_create($transaction->TransDate), date_interval_create_from_date_string("1 days")), 'l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>Fine Total</td>
                                <td>
                                    {{ ($transaction->FineTotal == NULL) ? "-" : "Rp " . number_format($transaction->FineTotal) }}
                            </tr>
                            <tr>
                                <td>By</td>
                                <td>{{ $transaction->user->name }}</td>
                            </tr>
                            <tr>
                                <td>List of Books</td>
                                <td>
                                    <table>
                                        @foreach ($transaction_details as $tx)
                                            <tr>
                                                <td>{{ $loop->iteration .". " }}</td>
                                                <td>{{ $tx->book->BookName }}</td>
                                                <td>{{ "(" . $tx->Qty . " pcs)" }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                        </table>                

                        @if ($transaction->FineTotal == NULL)
                        <div style="float: right; margin: 20px">
                            <form method="post" action="{{ route('transactions.return', $transaction->id)}}">
                                @csrf
                                @method('post')
                                <x-primary-button style="background: orange">Return</x-primary-button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
