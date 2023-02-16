@extends('layouts.user')

@section('title', 'Tutte le proprietà')

@section('content')
    <div class="container">

        {{-- “Hell is empty and all monsters are here. Notwithstanding here we all are” --}}



        <div class="row justify-content-center mt-5">

            <div class="col-12 col-md-10 col-lg-8 d-flex mb-3 justify-content-between align-items-center">
                <h1 class="text-center">Ecco le tue proprietà</h1>
                <a href="{{ route('user.estates.create') }}" class="btn our-btn">
                    Inserisci proprietà
                </a>
            </div>

            @if (session('message'))
                <div class="alert alert-success col-10" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('wrong_address'))
                <div class="alert alert-danger col-10" role="alert">
                    {{ session('wrong_address') }}
                </div>
            @endif

            <div class="col-12 col-md-12 col-lg-10 my-5" style="overflow-x: auto">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Titolo</th>
                            <th scope="col">Cover</th>
                            <th scope="col">Tipologia</th>
                            <th scope="col">&#x33A1;</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col">Visibile</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse ($estates as $estate)
                        <tr class="table-row">
                            <th scope="row">{{ $estate->title }}</th>
                            <td class="w-25">
                                <img  src="{{ asset('storage/' . $estate->cover_img) }}" alt=""
                                    srcset="">
                            </td>
                            <td>{{ $estate->type }}</td>
                            <td>{{ $estate->mq }}</td>
                            <td>{{ $estate->price }}</td>
                            <td>{{ $estate->is_visible === 0 ? 'No' : 'Si' }}</td>
                            <td class="">
                                <a class="btn our-btn d-block mb-1 " href="{{ route('user.estates.show', $estate->slug) }}">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                                <a class="btn our-btn d-block  mb-1 "
                                    href="{{ route('user.estates.edit', $estate->slug) }}">
                                    <i class="fa-solid fa-wrench"></i>
                                </a>
                                <form class="text-center mb-1" action="{{ route('user.estates.destroy', $estate->slug) }}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn our-btn delete-btn d-block w-100" type="submit"
                                        button-name="{{ $estate->title }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>

                                <a href="{{ route('user.transaction.index', $estate->id) }}" class="btn our-btn d-block">
                                    <i class="fa-solid fa-hand-holding-dollar"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th>Non sono ancora state caricate proprietà</th>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @include('partials.modal')

        </div>
    </div>
@endsection
