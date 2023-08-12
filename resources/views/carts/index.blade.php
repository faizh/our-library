<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Carts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Your Cart!") }}

                    @if (count($carts) > 0)
                        <div class="mt-2">
                            <div style="float: right">
                                <a href="{{ route('carts.checkout') }}">
                                    <x-primary-button>{{ __('Checkout') }}</x-primary-button>
                                </a>
                            </div>

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
                                            Qty</th>
                                        <th
                                            class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="dark:bg-slate-800">
                                    @foreach ($carts as $cart)
                                    <tr>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                            {{ $cart->BookId }}</td>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                                            {{ $cart->book->BookName }}</td>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                            <x-text-input type="number" name="qty" id="qty-cart-{{ $cart->id }}" value="{{ $cart->qty }}" onchange="toggleBtnUpdate( {{$cart->id}} )" />
                                            </td>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                            <a href="{{ route('carts.delete', $cart->id) }}"><x-primary-button style="background: red; color: white;">Delete</x-primary-button></a>
                                            <a href="#!" hidden="hidden" id="update-btn-{{ $cart->id }}"><x-primary-button style="background: orange;" onclick="updateStock({{ $cart->id }})">Update Stock</x-primary-button></a>
                                            </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="mt-2" style="text-align: center">
                            <span>Oops, your cart is empty!</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    function toggleBtnUpdate(cart_id, action='') {
        var btnUpdate = document.getElementById("update-btn-" + cart_id);
        let hidden = btnUpdate.getAttribute("hidden");

        if (hidden) {
          btnUpdate.removeAttribute("hidden");
        }

        if (action == 'hide') {
            btnUpdate.setAttribute("hidden", "hidden");
        }
    }

    function updateStock(cart_id) {
        var qty = document.getElementById("qty-cart-" + cart_id).value;
        
        $.ajax({
            type:'PATCH',
            url: "{{ route('carts.update') }}",
            data: {
                _token : "<?php echo csrf_token() ?>",
                cart_id: cart_id,
                qty: qty
            },
            success:function(data) {
                alert(data.msg);
                toggleBtnUpdate(cart_id, 'hide');

                if ( !data.status ) {
                    document.getElementById("qty-cart-" + cart_id).value = data.qty;
                }
            }
        });
    }
</script>