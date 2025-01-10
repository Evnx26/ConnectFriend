@extends('layouts.auth')

@section('content')
    <main class="d-flex w-100 h-100" style="background-color: #a0c5ff">

        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome back to ConnectFriend</h1>
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>

                        <div class="card" style="background-color: #3584ff">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <form action="{{ route('auth.login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" type="email" name="email"
                                                placeholder="Enter your email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password"
                                                placeholder="Enter your password">
                                            <small>
                                                Don't have an account?<a href="{{ route('auth.register') }}"> Register
                                                    Now</a>
                                            </small>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success dismissible" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
