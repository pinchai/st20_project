<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/style.css') }}">
</head>
<body>
<div id="app">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Fake Store</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Product</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Search</a></li>
            </ul>
            <button class="btn btn-outline-success my-2 my-sm-0">Cart([[ cart_list.length ]])</button>
        </div>
    </nav>
    <!-- Product Grid -->
    <div class="container mt-2">
        <div
            id="carouselExampleIndicators"
            class="carousel slide mb-2"
            data-ride="carousel"
        >
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        style="height: 400px; object-fit: cover"
                        src="{{ asset('slider/1.jpg') }}"
                        class="d-block w-100"
                        alt="..."
                    >
                </div>
                <div class="carousel-item">
                    <img
                        style="height: 400px; object-fit: cover"
                        src="{{ asset('slider/2.jpg') }}"
                        class="d-block w-100"
                        alt="..."
                    >
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                    data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                    data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="discount">{{ $product->category }}</div>
                        <img src="{{ asset('image/')  }}/{{ $product->image }}" alt="{{ $product->name }}">
                        <p>{{ $product->name }}</p>
                        <p>$ {{ $product->price }}</p>
                        <p>description</p>
                        <hr>
                        <button
                            class="btn btn-sm btn-outline-primary"
                            @click="addToCart(
                            '{{ $product->id }}',
                             '{{ $product->name}}',
                             '{{ $product->price}}',
                             )"
                        >Add To Cart
                        </button>
                    </div>
                </div>
        @endforeach
        <!-- Add more product cards as needed -->
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>About Us</h5>
                    <p>We are a company providing the best products for your business. Our mission is to deliver quality
                        and
                        excellence in everything we do.</p>
                </div>
                <div class="col-md-3">
                    <h5>Links</h5>
                    <p><a href="#">Home</a></p>
                    <p><a href="#">About</a></p>
                    <p><a href="#">Services</a></p>
                    <p><a href="#">Contact</a></p>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <p>Phone: +855 123 456 789</p>
                    <p>Email: info@fake.com</p>
                </div>
                <div class="col-md-3">
                    <h5>Follow Us</h5>
                    <p><a href="#">Facebook</a></p>
                    <p><a href="#">Twitter</a></p>
                    <p><a href="#">Instagram</a></p>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>&copy; 2025 Your Company. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</body>
<script>
    const {createApp} = Vue
    createApp({
        delimiters: ['[[', ']]'],
        data() {
            return {
                message: 'Hello Vue!',
                cart_list: localStorage.getItem('cart_list') ? JSON.parse(localStorage.getItem('cart_list')) : [],
            }
        },
        methods: {
            addToCart(id, name, price) {
                let duplicate_index = this.cart_list.findIndex(item => item.id === id)
                if (duplicate_index !== -1) {
                    this.cart_list[duplicate_index].quantity += 1
                    localStorage.setItem('cart_list', JSON.stringify(this.cart_list))
                    return;
                }
                console.log(this.cart_list.length)
                this.cart_list.push(
                    {
                        id: id,
                        name: name,
                        price: price,
                        quantity: 1
                    }
                )
                localStorage.setItem('cart_list', JSON.stringify(this.cart_list))
            }
        }
    }).mount('#app')
</script>
</html>
