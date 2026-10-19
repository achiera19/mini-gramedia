@extends('layout.app')

@section('content')
    <div class="container py-4">
        <h2>Hasil Pencarian : {{ $query }}</h2>

        @if ($books->isEmpty())
            <p>Tidak ada hasil yang ditemukan.</p>
        @else
            <div class="row mt-3">
                @foreach ($books as $book)
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
                            <h5><span style="font-size: 0.8rem" class="text-secondary">{{ $book->writer }}</span>
                            <br><span style="font-size: 1rem">{{ $book->title }}</span>
                            </h5>
                            <h4 style="font-size: 1.2rem; font-weight: bold;">Rp {{ number_format($book->price, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach

            </div>

        @endif
    </div>
@endsection
