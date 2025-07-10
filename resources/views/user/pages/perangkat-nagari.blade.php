@extends('user.layout.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="text-center fw-bold mb-5">Seluruh Perangkat Nagari</h1>
            {{-- Di sini Anda akan menampilkan daftar lengkap pengurus, mungkin dalam tabel atau card lebih banyak --}}
            <p class="text-center">Daftar detail pengurus nagari akan ditampilkan di sini.</p>
            {{-- Anda bisa loop data perangkat jika Anda meneruskannya dari controller --}}
            {{--
            <div class="row">
                @foreach($perangkat as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('images/' . $item->photo) }}" class="card-img-top" alt="{{ $item->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">{{ $item->position }}</p>
                                <p class="card-text small">{{ $item->task_description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            --}}
        </div>
    </section>
@endsection