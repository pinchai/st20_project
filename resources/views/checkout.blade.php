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

                        {{-- Contact --}}
                        <h6 class="text-uppercase text-muted">Contact</h6>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    placeholder="you@example.com"
                                    required
                                    autocomplete="email"
                                    v-model="payment_form.email"
                                >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    class="form-control"
                                    placeholder="+855 12 345 678"
                                    required
                                    autocomplete="tel"
                                    v-model="payment_form.phone"
                                >
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
                                    class="form-control"
                                    required
                                    autocomplete="given-name"
                                    v-model="payment_form.first_name"
                                >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="last_name">Last name <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="last_name"
                                    id="last_name"
                                    class="form-control"
                                    required
                                    autocomplete="family-name"
                                    v-model="payment_form.last_name"
                                >
                                @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address1">Address <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="address"
                                id="address"
                                class="form-control"
                                placeholder="Street, house/building, etc."
                                required
                                autocomplete="address"
                                v-model="payment_form.address"
                            >
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="city">City / District</label>
                                <input
                                    type="text"
                                    name="city"
                                    id="city"
                                    class="form-control"
                                    autocomplete="address-level2"
                                    v-model="payment_form.city"
                                >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="state">Province</label>
                                <input
                                    type="text"
                                    name="province"
                                    id="province"
                                    class="form-control"
                                    autocomplete="address-level1"
                                    v-model="payment_form.province"
                                >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="zip">Postal code</label>
                                <input
                                    type="text"
                                    name="zip"
                                    id="zip"
                                    class="form-control"
                                    autocomplete="postal-code"
                                    v-model="payment_form.postal_code"
                                >
                            </div>
                        </div>
                        <hr>
                        {{-- Payment --}}
                        <h6 class="text-uppercase text-muted">Payment</h6>
                        <div class="list-group mb-3">
                            <label class="list-group-item d-flex align-items-center">
                                <select
                                    class="form-control"
                                    v-model="payment_form.payment_method"
                                >
                                    <option value="cod">Cash on Delivery (COD)</option>
                                    <option value="khqr">KHQR</option>
                                </select>
                            </label>
                        </div>
                        {{-- Notes --}}
                        <div class="form-group">
                            <label for="order_notes">Order notes</label>
                            <textarea
                                name="order_notes"
                                id="order_notes"
                                rows="3"
                                class="form-control"
                                placeholder="Notes about your order, e.g. delivery instructions"
                                v-model="payment_form.note"
                            ></textarea>
                        </div>
                        {{-- Place Order --}}
                        <button
                            type="submit"
                            class="btn btn-primary btn-lg btn-block"
                            @click="placeOrder()"
                        >
                            Place Order
                        </button>
                    </div>
                </div>
            </div>

            {{-- Right: Order Summary --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm" style="position: sticky; top: 1rem;">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase text-muted mb-3">Order summary</h6>
                        <ul class="list-unstyled">
                            @foreach($cart as $item)
                                <li class="d-flex justify-content-between mb-2">
                                    <span>{{ $item->name }} <small class="text-muted">× {{ $item->qty }}</small></span>
                                    <strong>${{ number_format($item->qty * $item->price, 2) }}</strong>
                                </li>
                            @endforeach
                        </ul>

                        <hr>

                        <div class="d-flex justify-content-between mb-1">
                            <span>Subtotal</span>
                            <span>${{ number_format($total_price, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Shipping</span>
                            <span>${{ number_format($shipping_fee, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mt-2">
                            <strong>Total</strong>
                            <strong>${{ number_format($total_price + $shipping_fee, 2) }}</strong>
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

@section('script')
    <script>
        const {createApp} = Vue;
        createApp({
            delimiters: ['[[', ']]'],
            data() {
                return {
                    payment_form: {
                        email: 'test@mail.com',
                        phone: '85512345678',
                        first_name: 'choeurn',
                        last_name: 'pinchai',
                        address: '123 Street',
                        city: 'Phnom Penh',
                        province: 'Phnom Penh',
                        postal_code: '120000',
                        payment_method: 'khqr',
                        note: null,
                    }
                }
            },
            methods: {
                placeOrder() {
                    if (this.payment_form.payment_method === 'khqr') {
                        alert('KHQR payment method is not supported yet.')
                    } else {
                        alert('Caseh on Delivery payment method is not supported yet.')
                    }
                }
            }
        }).mount('#app');
    </script>
@endsection
