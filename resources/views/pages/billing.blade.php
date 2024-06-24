<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="billing"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Billing"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-xl-7 mb-xl-0 mb-4">
                            <div class="card bg-transparent shadow-xl">
                                <div class="overflow-hidden position-relative border-radius-xl">
                                    <img src="{{ asset('assets') }}/img/illustrations/pattern-tree.svg"
                                        class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100"
                                        alt="pattern-tree">
                                    <span class="mask bg-gradient-dark opacity-10"></span>
                                    <div class="card-body position-relative z-index-1 p-3">
                                        <i class="material-icons text-white p-2">wifi</i>
                                        <h5 class="text-white mt-4 mb-5 pb-2">
                                            4562&nbsp;&nbsp;&nbsp;1122&nbsp;&nbsp;&nbsp;4594&nbsp;&nbsp;&nbsp;7852
                                        </h5>
                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <div class="me-4">
                                                    <p class="text-white text-sm opacity-8 mb-0">Card Holder</p>
                                                    <h6 class="text-white mb-0">Hendri T Padang</h6>
                                                </div>
                                                <div>
                                                    <p class="text-white text-sm opacity-8 mb-0">Expires</p>
                                                    <h6 class="text-white mb-0">11/24</h6>
                                                </div>
                                            </div>
                                            <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                                <img class="w-60 mt-2"
                                                    src="{{ asset('assets') }}/img/logos/mastercard.png" alt="logo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">account_balance</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            <h6 class="text-center mb-0">Salary</h6>
                                            <span class="text-xs">Belong Interactive</span>
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">{{ $totalOrderPriceFormatted }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-lg-0 mb-4">
                            <div class="card mt-4">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <h6 class="mb-0">Payment Method</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-md-6 mb-md-0 mb-4">
                                            <div
                                                class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                                <img class="w-10 me-3 mb-0"
                                                    src="{{ asset('assets') }}/img/logos/mastercard.png" alt="logo">
                                                <h6 class="mb-0">
                                                    1234&nbsp;&nbsp;&nbsp;5678&nbsp;&nbsp;&nbsp;9122
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                                <img class="w-10 me-3 mb-0"
                                                    src="{{ asset('assets') }}/img/logos/visa.png" alt="logo">
                                                <h6 class="mb-0">
                                                    4321&nbsp;&nbsp;&nbsp;8765&nbsp;&nbsp;&nbsp;2192
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Invoices</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 pb-0">
                            <ul class="list-group">
                                @foreach($order as $orders)
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="text-dark mb-1 font-weight-bold text-sm">{{ $orders->date }}</h6>
                                        <span class="text-xs">#{{ $loop->iteration }}</span>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        {{ $orders->total_price }}
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
