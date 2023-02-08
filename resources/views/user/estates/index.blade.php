@extends('layouts.user')

@section('title', 'Tutti i tuoi proprietà')

@section('content')
    <div class="container">
        <h1 class="text-center">Ecco le tue proprietà</h1>

    
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-10 col-lg-8">
                <table class="table">
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
                                <th scope="row">{{$estate->title}}</th>
                                <td>{{$estate->type}}</td>
                                <td>{{$estate->mq}}</td>
                                <td>{{$estate->price}}</td>
                                <td>{{$estate->is_visible === 0 ? 'no':'si'}}</td>
                                <td>
                                    <button>button</button>
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