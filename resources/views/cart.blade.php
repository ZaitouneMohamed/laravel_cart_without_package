@extends('layouts.master')

@section('content')
    <br>
    <div class="alert alert-primary alert-dismissible fade show" id="success-message" style="display: none;" role="alert">
        qty updated successfly
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @if (session('cart'))
                @foreach (session('cart') as $id => $details)
                    <tr rowId="{{ $id }}">
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="nomargin">{{ $details['title'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $details['price'] }}</td>
                        <td data-th="Price">
                            <input min="1" type="number" id="{{ $details['id'] }}"
                                value="{{ $details['quantity'] }}"
                                onblur="edit({{ $details['id'] }},{{ $details['price'] }})">
                        </td>
                        <td data-th="Price" id="total{{ $details['id'] }}">${{ $details['quantity'] * $details['price'] }}
                        </td>
                        <td data-th="Subtotal" class="text-center"></td>
                        <td class="actions">
                            <a class="btn btn-outline-danger btn-sm delete-product"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">
                    <a href="/" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                    <button class="btn btn-danger">Checkout</button>
                </td>
            </tr>
        </tfoot>
    </table>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(".edit-cart-info").change(function(e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ route('update.sopping.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("rowId"),
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        function edit(id, price) {
            quantity = document.getElementById(id).value;
            $.ajax({
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    quantity: quantity,
                },
                url: "/update-shopping-cart",
                success: function(response) {
                    $('#success-message').show();
                    $('#total' + id).text(quantity * price);
                    setTimeout(() => {
                        $('#success-message').hide();
                    }, 3000);
                },
                error: function() {
                    console.log('An error occurred .');
                }
            })

        }
        $(".delete-product").click(function(e) {
            e.preventDefault();
            var ele = $(this);
            if (confirm("Do you really want to delete?")) {
                $.ajax({
                    url: '{{ route('delete.cart.product') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("rowId")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection
