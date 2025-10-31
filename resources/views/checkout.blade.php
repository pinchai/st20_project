@extends('master')
@section('title','Checkout — Sample Store')

@section('content')
    <!-- Modal -->
    <div
        class="modal fade"
        id="qrcode_modal"
        data-backdrop="static"
        data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">KHQR</h5>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="ticket" role="region" aria-label="KHQR ticket">
                            <div class="head">
                                <div class="logo">KHQR</div>
                            </div>

                            <div class="content">
                                <div class="company">[[ merchantName ]]</div>
                                <div class="amount-row" aria-hidden="false">
                                    <div class="amount">[[ amount ]]</div>
                                    <div class="currency">[[ currency ]]</div>
                                </div>
                                <br>
                                <div class="timer" id="countdown">05:00</div>
                            </div>

                            <div class="divider" aria-hidden="true"></div>

                            <div class="qr-wrap">
                                <!-- Put your QR image filename here (qrcode.png) -->
                                <div id="qrcode" style="margin-top:16px"></div>
                            </div>
                        </div>
                    </center>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click="closeModal()"
                    >Close
                    </button>
                    <button
                        type="button"
                        class="btn btn-primary"
                    >Paid
                    </button>
                </div>
            </div>
        </div>
    </div>

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
            mounted() {
                // this.render()
            },
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
                        timer: null,
                        countdown: null
                    },
                    amount: null,
                    currency: null,
                    merchantName: null,
                }
            },
            methods: {
                renderQr(text) {
                    // remove previous
                    const container = document.getElementById('qrcode')
                    container.innerHTML = ''
                    // Create QRCode (qrcodejs) - size & colors are configurable
                    this.qrcodeObj = new QRCode(container, {
                        text: text,
                        width: 256,
                        height: 256,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // L, M, Q, H
                    })
                },
                placeOrder() {
                    if (this.payment_form.payment_method === 'khqr') {
                        let url = "{{ url('/checkout/generate-qr') }}"
                        let input = this.payment_form
                        let vm = this
                        $.LoadingOverlay("show");
                        axios.post(url, input)
                            .then(function (response) {
                                let res = response.data
                                let qr_string = res.qr.data;
                                vm.renderQr(qr_string.qr)
                                vm.openModal()

                                vm.amount = res.amount
                                vm.currency = res.currency
                                vm.merchantName = res.merchantName

                                //polling check
                                vm.timer = setInterval(() => {
                                    let check_url = "{{ url('/check_payment_status') }}"
                                    axios.post(check_url, {
                                        md5: qr_string.md5,
                                    })
                                        .then(function (res) {
                                            if (res.data.data == null) {
                                                console.log('waiting scanning...');
                                            } else {
                                                vm.closeModal();
                                                clearInterval(vm.timer);
                                                window.location.href = "{{ url('/customer-thank') }}";
                                            }
                                        })
                                        .catch(function (err) {
                                            console.log(err);
                                            clearInterval(vm.timer);
                                        });
                                }, 3000);

                                // countdown timer
                                let timeLeft = 5 * 60;
                                const countdownElement = document.getElementById('countdown');
                                vm.countdown = setInterval(() => {
                                    // Calculate minutes and seconds
                                    const minutes = Math.floor(timeLeft / 60);
                                    const seconds = timeLeft % 60;

                                    // Format with leading zeros (e.g., 04:09)
                                    const formattedMinutes = minutes.toString().padStart(2, '0');
                                    const formattedSeconds = seconds.toString().padStart(2, '0');

                                    // Display the time
                                    countdownElement.textContent = `${formattedMinutes}:${formattedSeconds}`;

                                    // When time runs out
                                    if (timeLeft <= 0) {
                                        clearInterval(vm.countdown);
                                        clearInterval(vm.timer);
                                        vm.closeModal();

                                        countdownElement.textContent = "Expired";
                                        countdownElement.classList.add("expired");
                                    }

                                    // Decrease time
                                    timeLeft--;
                                }, 1000);

                            })
                            .catch(function (error) {
                                console.log(error);
                            }).finally(function () {

                            $.LoadingOverlay("hide");
                        })
                    } else {
                        alert('Caseh on Delivery payment method is not supported yet.')
                    }
                },
                openModal() {
                    $('#qrcode_modal').modal('show');
                },
                closeModal() {
                    $('#qrcode_modal').modal('hide');
                    clearInterval(this.timer)
                    clearInterval(this.countdown)
                },
            }
        }).mount('#app');
    </script>
@endsection
