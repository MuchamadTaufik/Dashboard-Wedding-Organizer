<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Order"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Create Order</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="" action="/order" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Nama Pembeli</label>
                                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Enter Name.." value="{{ old('nama') }}">
                                                @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Tanggal Pembelian</label>
                                                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" placeholder="Enter Date.." value="{{ old('date') }}">
                                                @error('date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Nama Barang</label>
                                                <select class="form-control" name="products_id" id="products_id">
                                                    @foreach ($products as $product)
                                                        @php
                                                            // Parse formatted price and remove currency symbol
                                                            $priceValue = (float) str_replace(['Rp ', '.'], ['', ''], $product->price);
                                                            $selected = old('products_id') == $product->id ? 'selected' : '';
                                                        @endphp
                                                        <option value="{{ $product->id }}" data-price="{{ $priceValue }}" {{ $selected }}>
                                                            {{ $product->nama }} | {{ $product->price }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            

                                            <div class="form-group">
                                                <label for="">Jumlah Barang</label>
                                                <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="Enter Amount" value="{{ old('amount') }}">
                                                @error('amount')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Jumlah Harga</label>
                                                <input type="text" name="total_price" id="total_price" class="form-control @error('total_price') is-invalid @enderror" placeholder="Enter Total Price" value="{{ old('total_price') }}" readonly>
                                                @error('total_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <button type="submit" class="mb-4 btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Submit</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Use jQuery to handle the input changes
        $(document).ready(function () {
            // Function to update total price based on amount and product price
            function updateTotalPrice() {
                var amount = $('#amount').val();
                var productPrice = $('#products_id option:selected').data('price'); // assuming you have a data-price attribute on the option
    
                // Pastikan amount dan productPrice adalah numerik
                amount = parseFloat(amount);
                productPrice = parseFloat(productPrice);
    
                var totalPrice = amount * productPrice;
    
                // Format the total price using formatRupiah function
                $('#total_price').val(formatRupiah(totalPrice));
            }
    
            // Call the function when the page loads
            updateTotalPrice();
    
            // Call the function whenever the amount or product selection changes
            $('#amount, #products_id').on('input', function () {
                updateTotalPrice();
            });
    
            // Format Rupiah function
            function formatRupiah(angka) {
                var number_string = angka.toString();
                var sisa = number_string.length % 3;
                var rupiah = number_string.substr(0, sisa);
                var ribuan = number_string.substr(sisa).match(/\d{3}/g);
    
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
    
                return 'Rp ' + rupiah;
            }
        });
    </script>

    
</x-layout>
