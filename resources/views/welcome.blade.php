@extends('layouts.master')

@section('content')
    <div class="alert alert-primary alert-dismissible fade show" id="success-message" style="display: none;" role="alert">
        product added to cart
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="test">

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        function AddToCart(id) {
            $.ajax({
                type: 'GET',
                url: "/product/" + id,
                success: function(response) {
                    cardCount();
                    $('#success-message').show();
                    setTimeout(() => {
                        $('#success-message').hide();
                    }, 3000);

                },
                error: function() {
                    console.log('An error occurred .');
                }
            })
        }

        function test() {
            $.ajax({
                type: 'GET',
                url: "/GetProducts",
                success: function(response) {
                    var products = "";
                    response.forEach(function(product) {
                        products +=
                            `
                                <div class="col mb-5">
                                    <div class="card h-100">
                                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                                        </div>
                                        <img class="card-img-top" src="` + product.image + `" alt="..." />
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <h5 class="fw-bolder">` + product.title + `</h5>
                                                <div class="d-flex justify-content-center small text-warning mb-2">
                                                    <div class="bi-star-fill"></div>
                                                    <div class="bi-star-fill"></div>
                                                    <div class="bi-star-fill"></div>
                                                    <div class="bi-star-fill"></div>
                                                    <div class="bi-star-fill"></div>
                                                </div>
                                                <span class="text-muted text-decoration-line-through">$` + product
                            .old_price + `</span>$` + product.new_price + `
                                            </div>
                                        </div>
                                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                            <div class="text-center"><button class="btn btn-outline-dark mt-auto"
                                                onclick="AddToCart(` + product.id + `)">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `
                        document.getElementById('test').innerHTML = products;
                    });
                },
                error: function() {
                    console.log('An error occurred .');
                }
            })
        }

        document.querySelector('body').onload = test();
        document.querySelector('body').onload = cardCount();

        function cardCount() {
            var cartCount = {{ count((array) session('cart')) }};
            // if (cartCount == 0) {
            //     var a = 0;
            // } else {
            //     var a = cardCount;
            // }

            document.getElementById('cardCount').innerHTML = cardCount;
            console.log(cardCount)
        }
    </script>
@endsection
