<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/">Start Bootstrap</a>
        @auth
            {{Auth::user()->name}}
        @endauth
        @guest
            Login/Register to see cart items and more...
        @endguest
        <a class="btn btn-outline-dark" href="{{route('cart')}}">
            <i class="bi-cart-fill me-1"></i>
            Cart
            <span class="badge bg-dark text-white ms-1 rounded-pill" id="cardCount"></span>
        </a>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Use setInterval to update the cart count every 1000ms (1 second)
        setInterval(() => {
            // Retrieve the cart items count from the session
            var cartCount = {{ count((array) session('cart')) }};
            // Update the HTML element with the cart count
            document.getElementById('cardCount').innerText = cartCount;
            console.log(cartCount);
        }, 1000);
    });
</script>
