@extends('layouts.auth')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @error('work')
        <style>
            .select2-selection--multiple {
                border-color: #dc3545 !important;
            }
        </style>
    @enderror
@endpush

@section('content')
    <main class="d-flex w-100 h-100" style="background-color: #a0c5ff">
        <div class="container d-flex flex-column">
            <div class="row vh-100 ">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2" style="color: white">Register to ConnectFriend</h1>
                            <p class="lead">
                                Find a friend based on your work interest
                            </p>
                        </div>

                        <div class="card" style="background-color: #3584ff">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <form action="{{ route('auth.register') }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">Name</label>
                                                <input
                                                    class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                                    type="text" name="name" placeholder="Enter your name">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Email</label>
                                                <input
                                                    class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                                    type="text" name="email" placeholder="Enter your email">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="work" class="form-label">Work (Min. 3)</label>
                                            <select class="form-select @error('work') is-invalid @enderror"
                                                id="multi-select" name="work[]" multiple="multiple">
                                                @foreach ($works as $work)
                                                    <option value="{{ $work->id }}"
                                                        {{ collect(old('work'))->contains($work->id) ? 'selected' : '' }}>
                                                        {{ $work->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('work')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <label class="form-label">Phone Number</label>
                                        <div class="mb-3 input-group">
                                            <span class="input-group-text">+62</span>
                                            <input class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                                type="text" name="phone" inputmode="numeric" id="phone"
                                                placeholder="Enter phone number">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender</label> <br>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input @error('gender') is-invalid @enderror"
                                                    type="radio" name="gender" value="male"
                                                    {{ old('gender') == 'male' ? 'checked' : '' }}>
                                                <span class="form-check-label">
                                                    Male
                                                </span>
                                            </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input @error('gender') is-invalid @enderror"
                                                    type="radio" name="gender" value="female"
                                                    {{ old('gender') == 'female' ? 'checked' : '' }}>
                                                <span class="form-check-label">
                                                    Female
                                                </span>
                                            </label>
                                            @error('gender')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <label for="linkedin" class="form-label">LinkedIn Username</label>
                                        <div class="mb-3 input-group">
                                            <span class="input-group-text">@</span>
                                            <input type="text"
                                                class="form-control form-control-lg @error('linkedin') is-invalid @enderror" value="{{ old('linkedin') }}"
                                                placeholder="Enter your LinkedIn username" name="linkedin" id="linkedin">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @error('linkedin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">Password</label>
                                                <input
                                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                    type="password" name="password" id="password"
                                                    placeholder="Enter your password">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Confirm Password</label>
                                                <input
                                                    class="form-control form-control-lg @error('confirm_password') is-invalid @enderror"
                                                    type="password" name="confirm_password" id="confirm_password"
                                                    placeholder="Repeat your password">
                                                <div class="invalid-feedback" id="invalid-feedback">
                                                    Password does not match
                                                </div>
                                                @error('confirm_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal"
                                                id="btn_register" data-bs-target="#exampleModal">
                                                Sign Up
                                            </button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Payment
                                                            Section</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>The price for signing up is <strong>Rp 100.000</strong>, enter
                                                            the amount you want to pay. Extra amount will convert into
                                                            coins. (1 coin = 1,000 IDR) </p>

                                                        <label class="form-label">Amount</label>
                                                        <div class="mb-3 input-group">
                                                            <span class="input-group-text">Rp</span>
                                                            <input
                                                                class="form-control form-control-lg @error('amount')
                                                                is-invalid
                                                            @enderror"
                                                                type="text" name="amount" inputmode="numeric"
                                                                id="amount" placeholder="Enter amount">
                                                            @error('amount')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Pay</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#multi-select').select2();
        });

        $('#phone').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/g, '')); // Hanya izinkan angka
        });

        $('#amount').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/g, '')); // Hanya izinkan angka
        });

        $('#confirm_password').on('input', function() {
            if ($(this).val() !== $('#password').val()) {
                $('#invalid-feedback').show();
                $('#confirm_password').addClass('is-invalid');
                $('#btn_register').prop('disabled', true);
            } else {
                $('#invalid-feedback').hide();
                $('#confirm_password').removeClass('is-invalid');
                $('#btn_register').prop('disabled', false);
            }
        });

        $('#password').on('input', function() {
            if ($(this).val() !== $('#confirm_password').val()) {
                $('#invalid-feedback').show();
                $('#confirm_password').addClass('is-invalid');
                $('#btn_register').prop('disabled', true);
            } else {
                $('#invalid-feedback').hide();
                $('#confirm_password').removeClass('is-invalid');
                $('#btn_register').prop('disabled', false);
            }
        });
    </script>
@endpush
