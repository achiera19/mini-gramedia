@extends('layout.app')

@push('styles')
    <style>
        .slick-prev:before,
        .slick-next:before {
            color: #333;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        {{-- Menampilkan pesan error dari middleware (misal: akses ditolak) --}}
        @if (session('error'))
            <div class="alert alert-important alert-danger alert-dismissible mb-4" role="alert">
                <div class="d-flex">
                    <div>
                        <!-- Icon Error / Peringatan -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 9v4m0 4v.01"></path>
                            <path
                                d="M5.07 19h13.86a2 2 0 0 0 1.75 -2.93l-6.93 -12c-.9 -1.53 -3.1 -1.53 -4 0l-6.93 12a2 2 0 0 0 1.75 2.93z">
                            </path>
                        </svg>
                    </div>
                    <div>{{ session('error') }}</div>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif


        <div class="container-xl py-4">
            @if (Session::get('success'))
                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>Wow! Everything worked!</div>
                    </div>
                    <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            <div id="carousel-sample" class="carousel slide rounded-3 overflow-hidden" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="3"></button>
                    <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" alt=""
                            src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" alt=""
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQCG13QYeTEF9zM6kOh7vt8LR45eMqwkE9_fT1RUxkjg&s=10" />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" alt=""
                            src="https://www.shutterstock.com/image-vector/book-festival-web-banner-design-260nw-2467607305.jpg" />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" alt=""
                            src="https://www.shutterstock.com/image-vector/book-fair-festival-horizontal-banner-260nw-2483737645.jpg" />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" alt=""
                            src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                    </div>
                </div>
                <a class="carousel-control-prev" data-bs-target="#carousel-sample" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" data-bs-target="#carousel-sample" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>

            {{-- paket langganan --}}
            <div class="mt-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-yellow text-yellow-fg p-2"><i class="fa-solid fa-crown fs-3"></i></span>
                    <h2 class="mt-3 text-dark">Paket Langganan</h2>
                </div>

                <div class="row g-4">
                    @foreach ($subscriptionPackages as $package)
                        <div class="col-md-4">
                            <div class="card h-100"
                                style="background: linear-gradient(135deg, #ffffff 0%, {{ $package->color }} 100%);">
                                <div class="card-body row">
                                    <div class="col-4"></div>
                                    <div class="col-6 text-center text-dark">
                                        <h2 style="font-weight: bold;">{{ $package->name }}</h2>
                                        <p class="text-secondary" style="font-weight: bold; margin: 0 !important;">
                                            {{ $package->description }}
                                        </p>
                                        <div>
                                            Rp <span style="font-size: 2rem; font-weight: bold;"
                                                class="text-warning">{{ $package->price }}</span>
                                            <br>
                                            <span style="font-weight: bold; margin: 0 !important;"
                                                class="text-secondary">/30 Days</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        {{-- buku baru dirilis --}}

        <div class="d-flex align-items-center gap-2 mb-4 mt-5">
            <h2 class="m-0 text-dark fw-bold">Buku Baru Dirilis</h2>
        </div>
        <div id="wrapper-slider" class="row">
            @forelse ($latestBooks as $book)
                <div class="px-2">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset($book->cover) }}" class="d-block mx-auto w-75 h-50">
                            <div class="d-flex gap-2 mt-2">
                                <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                                <p class="badge">3+</p>
                            </div>
                        </div>
                        <div>
                            <h5><span style="font-size: 0.8rem" class="text-secondary">{{ $book->author }}</span>
                            <br><span style="font-size: 1rem">{{ $book->title }}</span>
                            </h5>
                            <h4 style="font-size: 1.2rem; font-weight: bold;">Rp {{ number_format($book->price, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Tidak ada buku terbaru yang tersedia</p>
            @endforelse
        </div>
    </div>

    {{-- buku gratis --}}

    <div class="mt-4">
        <div class="d-flex align-items-center gap-2 mb-4">
            <h2 class="mt-3 text dark" style="font-weight: bold">Buku gratis</h2>
        </div>
        <div class="row">
            @forelse ($freeBooks as $book)

            @empty


            <div class="col-4">
                <div class="card d-flex flex-column">
                    <div class="row row-0 flex-fill">
                        <div class="col-md-3">
                            <a href="#">
                                <img src="{{ asset($book->cover)}}"
                                    class="w-100 h-100 object-cover" alt="Card side image" />
                            </a>
                        </div>
                        <div class="col">
                            <div class="card-body h-full d-flex flex-column">
                                <h3 class="card-title">
                                    <div class="badge"><i class="fa-sold fa-mobile"></i>PDF</div>
                                </h3>
                                <div class="text-secondary">
                                   Penulis
                                    <br><span class="text-dark">{{ $book->author }}</span>
                                </div>
                                <div class="d-flex align-items-center pt-4 mt-auto">
                                    <h3><span class="text-decoration-line-through text-secondary">Rp.50.000</span><span
                                            class="tetx-dark">Rp.0</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               @endforelse

@endsection

@push('scripts')
    <script>
        $('#wrapper-slider').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>
@endpush
