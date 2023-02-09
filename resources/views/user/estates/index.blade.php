@extends('layouts.user')

@section('title', 'Tutte le proprietà')

@section('content')
    <div class="container">

        {{-- “Hell is empty and all monsters are here. Notwithstanding here we all are” --}}




        <div class="row justify-content-center mt-5">

            <div class="col-12 col-md-10 col-lg-8 d-flex justify-content-between align-items-center">
                <h1 class="text-center">Ecco le tue proprietà</h1>
                <a href="{{ route('user.estates.create') }}" class="btn our-btn">
                    Inserisci proprietà
                </a>
            </div>

            @if (session('message'))
                <div class="alert alert-success col-12 col-md-10 col-lg-8" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="col-12 col-md-10 col-lg-8 mt-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Titolo</th>
                            <th scope="col">Tipologia</th>
                            <th scope="col">Mq</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col">Visibile</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse ($estates as $estate)
                        <tr>
                            <th scope="row">{{ $estate->title }}</th>
                            <td>{{ $estate->type }}</td>
                            <td>{{ $estate->mq }}</td>
                            <td>{{ $estate->price }}</td>
                            <td>{{ $estate->is_visible === 0 ? 'no' : 'si' }}</td>
                            <td>
                                <a class="btn our-btn" href="{{ route('user.estates.show', $estate->slug) }}">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                                <a class="btn our-btn" href="{{ route('user.estates.edit', $estate->slug) }}">
                                    <i class="fa-solid fa-wrench"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th>Non sono ancora state caricate proprietà</th>
                        </tr>
                        @endforelse ($estates as $estate)
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
