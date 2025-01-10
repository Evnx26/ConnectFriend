@extends('layouts.home')

@section('content')
    <!-- Tambahkan style agar halaman penuh menjadi biru -->
    <div class="container p-0 pt-5" style="background-color: #a0c5ff; min-height: 100vh;">
        @if (session('success'))
            <div class="alert alert-success dismissable">
                {{ session('success') }}
            </div>
        @endif

        <div class="row" style="background-color: #a0c5ff;">
            <div class="col-md-10 col-xl-8 mx-auto">
                <h1 class="text-center">Coin Topup</h1>
                <p class="lead text-center mb-4">You can use this coin to buy things in our shop</p>

                <div class="row py-4">
                    <div class="col-sm-4 mb-3 mb-md-0">
                        <div class="card text-center h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="mb-4">
                                    <h5>Standard</h5>
                                    <span class="display-4">100 Coins</span>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('topup.add', 100) }}" class="btn btn-lg btn-primary">Buy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3 mb-md-0">
                        <div class="card text-center h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="mb-4">
                                    <h5>Pro</h5>
                                    <span class="display-4">500 Coins</span>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('topup.add', 500) }}" class="btn btn-lg btn-primary">Buy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3 mb-md-0">
                        <div class="card text-center h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="mb-4">
                                    <h5>Plus</h5>
                                    <span class="display-4">1000 Coins</span>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('topup.add', 1000) }}" class="btn btn-lg btn-primary">Buy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
