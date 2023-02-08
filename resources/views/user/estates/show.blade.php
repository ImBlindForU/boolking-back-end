@extends('layouts.user')

@section('title', $estate->title)

@section('content')
    <div class="container">
        <h1 class="text-center">{{$estate->title}}</h1>

        <h2 class="text-start">Tipo{{$estate->type}}</h2>
        @forelse ($estate->services as $service)
            <h3 class="text-end">service{{$service->name}}</h3>
        @empty
            <h3 class="text-center">
                Nessun servizio specificato
            </h3>
        @endforelse
        <h4 class="text-start">Tipo = {{$estate->type}}</h4>
        <p class="text-center">description = {{$estate->description}}</p>
        <p class="text-start">stanze = {{$estate->room_number}}</p>
        <p class="text-center">letti = {{$estate->bed_number}}</p>
        <p class="text-end">bagni = {{$estate->bathroom_number}}</p>
        <p class="text-start">dettagli = {{$estate->detail}}</p>
        <p class="text-end">prezzo = {{$estate->price}}</p>
        <p class="text-center">metri quadri = {{$estate->mq}}</p>
        <p class="text-center">visibile = {{$estate->is_visible}}</p>
        

        <a  class="btn btn-warning" href="{{route('user.estates.index')}}">torna indietro</a>


    </div>
@endsection