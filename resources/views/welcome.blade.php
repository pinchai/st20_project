<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header-image {
            width: 100%;
            height: auto;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 10px;
            text-align: center;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
        }

        .discount {
            position: absolute;
            top: 10px;
            left: 10px;
            background: red;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            margin-top: 20px;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Fake Store</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Product</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Search</a></li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cart(0)</button>
        </form>
    </div>
</nav>

<!-- Product Grid -->
<div class="container mt-2">
    <div id="carouselExampleIndicators" class="carousel slide mb-2" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img style="height: 400px; object-fit: cover" src="https://clashofclans.inbox.supercell.com/lqe2co20rkhw/7JUMkM6tnjrkddHYlkIb8k/a7e53be576339958e1e22c7c8ce2ee96/Summer_Jam_Elixir_Bootcamp_Blog.png?w=800&h=433&fit=fill&f=center&fm=webp" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img style="height: 400px; object-fit: cover" src="https://clashofclans.inbox.supercell.com/lqe2co20rkhw/4lczE0nHvJTi3TpAxwnViM/8d922345ea9beb38e4bbe74701891627/thumbz.jpg?w=800&h=433&fit=fill&f=center&fm=webp" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="product-card">
                <div class="discount">-40%</div>
                <img src="https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg" alt="Product 1">
                <p>John Hardy Women's...</p>
                <p>$69.00</p>
                <p>jewelry</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product-card">
                <div class="discount">-40%</div>
                <img src="https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg" alt="Product 2">
                <p>Mens Casual Premium...</p>
                <p>$22.30</p>
                <p>men's clothing</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product-card">
                <div class="discount">-40%</div>
                <img src="https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg" alt="Product 3">
                <p>Mens Cotton Jacket...</p>
                <p>$55.99</p>
                <p>men's clothing</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product-card">
                <div class="discount">-40%</div>
                <img src="https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg" alt="Product 4">
                <p>Mens Casual Slim Fit...</p>
                <p>$15.99</p>
                <p>men's clothing</p>
            </div>
        </div>
        <!-- Add more product cards as needed -->
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>About Us</h5>
                <p>We are a company providing the best products for your business. Our mission is to deliver quality and
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
</body>
</html>
