<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Product"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Create Product</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="" action="/product" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Name Product</label>
                                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Enter Name.." value="{{ old('nama') }}">
                                                @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description.." value="{{ old('description') }}">
                                                @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Price</label>
                                                <div class="input-group">
                                                    <input type="text" name="price" id="formattedPrice" class="form-control @error('price') is-invalid @enderror" placeholder="Enter Price" value="{{ old('price') }}">
                                                </div>
                                                @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Stock</label>
                                                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="Enter stock" value="{{ old('stock') }}">
                                                @error('stock')
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
        $(document).ready(function () {
            // Function to format price as Indonesian Rupiah
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

            // Function to update formatted price
            function updateFormattedPrice() {
                var priceString = $('#formattedPrice').val().replace(/\D/g, ''); // Remove non-numeric characters
                $('#formattedPrice').val(formatRupiah(priceString));
            }

            // Call the function when the page loads
            updateFormattedPrice();

            // Call the function whenever the price input changes
            $('#formattedPrice').on('input', function () {
                updateFormattedPrice();
            });
        });
    </script>
</x-layout>
