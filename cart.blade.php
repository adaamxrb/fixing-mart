@extends('layouts.app')

@section('title')
    Asriloka Mart - Keranjang
@endsection

@section('content')
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Keranjang
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart" aria-describedby="Cart">
                            <thead>
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama &amp; Penjual</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalPrice = 0 @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td style="width: 25%">
                                            @if ($cart->product->galleries)
                                                <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                                                    alt="" class="cart-image" />
                                            @endif
                                        </td>
                                        <td style="width: 35%">
                                            <div class="product-title">{{ $cart->product->name }}</div>
                                            <div class="product-subtitle">{{ $cart->product->user->store_name }}</div>
                                        </td>
                                        <td style="width: 35%">
                                            <div class="product-title">Rp. {{ number_format($cart->product->price) }}</div>
                                            <div class="product-subtitle"></div>
                                        </td>
                                        <td style="width: 20%">

                                            <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-remove-cart">
                                                    Hapus
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @php $totalPrice += $cart->product->price @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Deta"{{ route('checkout') }}" Pengiriman</h2>
                    </div>
                </div>
                <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="addressOne">Alamat 1</label>
                                <input type="text" class="form-control" id="addressOne" aria-describedby="emailHelp"
                                    name="addressOne" value="Setra Duta Cemara" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="addressTwo">Alamat 2</label>
                                <input type="text" class="form-control" id="addressTwo" aria-describedby="emailHelp"
                                    name="addressTwo" value="Blok B2 No. 34" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinces_id">Province</label>
                                <select name="provinces_id" id="provinces_id" class="form-control" v-model="provinces_id"
                                    v-if="provinces">
                                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="regencies_id">City</label>
                                <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id"
                                    v-if="regencies">
                                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postalCode">Kode Pos</label>
                                <input type="text" class="form-control" id="postalCode" name="postalCode"
                                    value="40512" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    value="Indonesia" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">Nomor WA</label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    value="+628 2020 11111" />
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-12">
                            <hr />f
                        </div>
                        <div class="col-12">
                            <h2>Informasi Pembayaran</h2>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-4 col-md-2">
                            <div class="product-title">Rp. 1.750</div>
                            <div class="product-subtitle">PPN</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title">Rp. 8.000</div>
                            <div class="product-subtitle">Asuransi Produk</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title">Rp. 27.000</div>
                            <div class="product-subtitle">Pengiriman</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title text-success">Rp. {{ number_format($totalPrice ?? 0) }}</div>
                            <div class="product-subtitle">Total</div>
                        </div>
                        <div class="col-8 col-md-3">
                            <a href="/success.html" class="btn btn-success mt-4 px-4 btn-block">
                                Bayar Sekarang
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var locations = new Vue({
            el: "#locations",
            mounted() {
                this.getProvincesData();
            },
            data: {
                provinces: null,
                regencies: null,
                provinces_id: null,
                regencies_id: null,
            },
            methods: {
                getProvincesData() {
                    var self = this;
                    axios.get('{{ route('api-provinces') }}')
                        .then(function(response) {
                            self.provinces = response.data;
                        })
                },
                getRegenciesData() {
                    var self = this;
                    axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                        .then(function(response) {
                            self.regencies = response.data;
                        })
                },
            },
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                },
            }
        });
    </script>
@endpush
