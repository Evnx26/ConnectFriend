@extends('layouts.home')

@section('content')
    <!-- Search Section Start -->
    <div id="search" class="search-section py-4" style="background-color: #a0c5ff">
        <div class="container">
            <form class="row g-3 align-items-center">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Enter a name to search" />
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn w-100" style="background-color: #3584ff">Search</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Search Section End -->

    <!-- About Section Start -->
    <div class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-images d-flex flex-wrap gap-3">
                        <img src="{{ asset('img/friend-1.jpg') }}" class="img-fluid rounded shadow" alt="About 1">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-4">Why Choose Us?</h2>
                    <p>Kami menawarkan teman yang memiliki work interest sesuai dengan kebutuhan Anda.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Rekomendasi yang disesuaikan untuk kebutuhan Anda</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Opsi pencarian dan filter yang mudah digunakan</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Koneksi yang aman</li>
                    </ul>
                    <a href="#" class="btn mt-3" style="background-color: #3584ff">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About Section End -->

    <!-- Suggestions Section Start -->
    <div class="suggestions-section py-5" style="background-color: #a0c5ff">
        <div class="container">
            <h2 class="text-center mb-5">Recommended Matches</h2>
            <div class="row">
                @foreach ($friendSuggestions as $friend)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('img/default-admin.jpeg') }}" alt="Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                    <h5 class="mb-0">{{ $friend->name }}</h5>
                                </div>
                                <div class="work-tags mb-3">
                                    @foreach ($friend->works->take(3) as $work)
                                        <span class="badge bg-primary">{{ $work->name }}</span>
                                    @endforeach
                                    @if ($friend->works->count() > 3)
                                        <span class="badge bg-secondary">+{{ $friend->works->count() - 3 }} more</span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-outline-primary btn-sm" onclick="sendRequest({{ $friend->id }}, {{ Auth::user()->id }})">
                                        <i class="bi bi-heart"></i> Like
                                    </button>
                                    <a href="{{ route('home.detail', $friend->id) }}" class="btn btn-sm" style="background-color: #3584ff">View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn" style="background-color: #3584ff">Browse All Suggestions</a>
            </div>
        </div>
    </div>
    <!-- Suggestions Section End -->
@endsection

@push('scripts')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-right",
            showConfirmButton: false,
            timer: 3000,
        });

        async function sendRequest(friendId, userId) {
            const likeButton = document.querySelector(`#like-btn-${friendId}`);
            try {
                likeButton.disabled = true;
                const response = await fetch(`/friend/request/${friendId}/${userId}`);
                const data = await response.json();

                Toast.fire({
                    icon: response.ok ? "success" : "error",
                    title: data.message,
                });
            } catch (error) {
                Toast.fire({
                    icon: "error",
                    title: "An unexpected error occurred. Try again later.",
                });
            } finally {
                likeButton.disabled = false;
            }
        }
    </script>
@endpush
