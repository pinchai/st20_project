@extends('master')
@section('title','Checkout — Sample Store')

@section('content')
    <div class="container py-4">
        <div class="row">
            {{-- Left: Customer / Shipping / Payment --}}
            <div class="col-lg-8 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-0">Checkout</h4>
                            <span class="ml-2 badge badge-secondary">Secure</span>
                        </div>

                        {{-- Alerts --}}
                        @if(session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <strong>There were some problems with your input.</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('place-order') }}" method="post" novalidate>
                            @csrf

                            {{-- Contact --}}
                            <h6 class="text-uppercase text-muted">Contact</h6>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $prefill['email'] ?? '') }}"
                                        placeholder="you@example.com"
                                        required
                                        autocomplete="email">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Phone <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        name="phone"
                                        id="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $prefill['phone'] ?? '') }}"
                                        placeholder="+855 12 345 678"
                                        required
                                        autocomplete="tel">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <hr>

                            {{-- Shipping Address --}}
                            <h6 class="text-uppercase text-muted">Shipping address</h6>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First name <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        name="first_name"
                                        id="first_name"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        value="{{ old('first_name', $prefill['first_name'] ?? '') }}"
                                        required
                                        autocomplete="given-name">
                                    @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="last_name">Last name <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        name="last_name"
                                        id="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name', $prefill['last_name'] ?? '') }}"
                                        required
                                        autocomplete="family-name">
                                    @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address1">Address <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="address1"
                                    id="address1"
                                    class="form-control @error('address1') is-invalid @enderror"
                                    value="{{ old('address1', $prefill['address1'] ?? '') }}"
                                    placeholder="Street, house/building, etc."
                                    required
                                    autocomplete="address-line1">
                                @error('address1')
                                <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="city">City / District</label>
                                    <input type="text" name="city" id="city" class="form-control"
                                           value="{{ old('city', $prefill['city'] ?? '') }}"
                                           autocomplete="address-level2">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="state">Province</label>
                                    <input type="text" name="state" id="state" class="form-control"
                                           value="{{ old('state', $prefill['state'] ?? '') }}"
                                           autocomplete="address-level1">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="zip">Postal code</label>
                                    <input type="text" name="zip" id="zip" class="form-control"
                                           value="{{ old('zip', $prefill['zip'] ?? '') }}" autocomplete="postal-code">
                                </div>
                            </div>
                            <hr>
                            {{-- Payment --}}
                            <h6 class="text-uppercase text-muted">Payment</h6>
                            <div class="list-group mb-3">
                                <label class="list-group-item d-flex align-items-center">
                                    <input class="mr-2" type="radio" name="payment_method" value="cod"
                                        {{ old('payment_method','cod')==='cod' ? 'checked' : '' }}>
                                    <span>Cash on Delivery (COD)</span>
                                </label>
                                <label class="list-group-item d-flex align-items-center">
                                    <input class="mr-2" type="radio" name="payment_method" value="card"
                                        {{ old('payment_method')==='card' ? 'checked' : '' }}>
                                    <span>KHQR</span>
                                </label>
                            </div>

                            {{-- Notes / Coupon --}}
                            <div class="form-group">
                                <label for="order_notes">Order notes</label>
                                <textarea name="order_notes" id="order_notes" rows="3" class="form-control"
                                          placeholder="Notes about your order, e.g. delivery instructions">{{ old('order_notes') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Place Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Right: Order Summary --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm" style="position: sticky; top: 1rem;">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase text-muted mb-3">Order summary</h6>

                        {{-- Example static summary; replace with real cart data --}}
                        @php
                            $items = $items ?? [
                              ['name' => 'Sample Product A', 'qty' => 1, 'price' => 19.00],
                              ['name' => 'Sample Product B', 'qty' => 2, 'price' => 9.50],
                            ];
                            $subtotal = collect($items)->sum(fn($i) => $i['qty'] * $i['price']);
                            $shipping = old('shipping_method','standard') === 'express' ? 7 : 3;
                            $discount = 0;
                            $total = $subtotal + $shipping - $discount;
                        @endphp

                        <ul class="list-unstyled">
                            @foreach($items as $it)
                                <li class="d-flex justify-content-between mb-2">
                                    <span>{{ $it['name'] }} <small class="text-muted">× {{ $it['qty'] }}</small></span>
                                    <strong>${{ number_format($it['qty'] * $it['price'], 2) }}</strong>
                                </li>
                            @endforeach
                        </ul>

                        <hr>

                        <div class="d-flex justify-content-between mb-1">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Shipping</span>
                            <span>${{ number_format($shipping, 2) }}</span>
                        </div>
                        @if($discount > 0)
                            <div class="d-flex justify-content-between mb-1 text-success">
                                <span>Discount</span>
                                <span>−${{ number_format($discount, 2) }}</span>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mt-2">
                            <strong>Total</strong>
                            <strong>${{ number_format($total, 2) }}</strong>
                        </div>

                        <p class="text-muted small mt-3 mb-0">
                            Taxes and shipping calculated at checkout based on your address.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
