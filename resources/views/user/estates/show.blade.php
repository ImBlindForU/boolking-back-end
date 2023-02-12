@extends('layouts.user')

@section('title', $estate->title)

@section('content')
    <div class="container">

        {{-- “Hell is empty and all monsters are here.” --}}


        <div class="row justify-content-center mt-5">
            {{-- SINGLE ESTATE --}}
            <div class="col-12 col-lg-10">
                <h2 class="text-center mb-4">{{ $estate->title }}</h2>
                
                <div class="mt-5 text-center"> 
                {{--  IMAGE --}}
                @if (str_contains($estate->cover_img, "cover")) 
                <img class="rounded-3" src="{{ asset('storage/' . $estate->cover_img) }}" style="max-width: 500px">
                @else 
                    <img src="{{$estate->cover_img}}" style="max-width: 500px">
        
                @endif
                {{-- / IMAGE --}}
                </div>

                <div id="img-show-div"  class="d-flex flex-wrap mt-5 align-center mx-auto justify-content-center">
                    @forelse ($estate->images as $image)


                        <img class="optional-img-show" src="{{ asset('storage/' . $image->path) }}" style="max-width: 500px">
                        
                
                        
                    @empty
                        
                    @endforelse

                </div>



                <ul style="list-style:none">
                    {{-- header --}}
                    <li>
                    </li>
                    {{-- / header --}}
                    {{-- Address --}}
                    <li><strong>Indirizzo:</strong> {{ $estate->address?->street }}</li>
                    <li><strong>Numero Civico:</strong> {{ $estate->address?->street_code }}</li>
                    <li><strong>Città:</strong> {{ $estate->address?->city }}</li>
                    <li><strong>Paese:</strong> {{ $estate->address?->country }}</li>
                    {{-- /Address --}}

                    {{-- features --}}
                    <li><strong>Tipologia:</strong> {{ $estate->type }}</li>
                    <li><strong>Stanze:</strong> {{ $estate->room_number }}</li>
                    <li><strong>Letti:</strong> {{ $estate->bed_number }}</li>
                    <li><strong>Bagni:</strong> {{ $estate->bathroom_number }}</li>
                    <li><strong>Dettagli:</strong> {{ $estate->detail }}</li>
                    <li><strong>Prezzo:</strong> {{ $estate->price }}</li>
                    <li><strong>Metri quadri:</strong> {{ $estate->mq }}</li>
                    <li><strong>Visibile:</strong> {{ $estate->is_visible ? 'si' : 'no' }}</li>
                    {{-- / features --}}

                    {{-- description text --}}
                    <li class="mb-4 mt-4">
                        <strong>descrizione:</strong><br>
                        {{ $estate->description }}
                    </li>
                    {{-- / description text --}}

                    {{-- services --}}
                    <li><strong>Servizi aggiuntivi:</strong></li>
                    @forelse ($estate->services as $service)
                        <li>{{ $service->name }}</li>
                    @empty
                        <li>
                            Nessun servizio specificato
                        </li>
                    @endforelse
                    {{-- / services --}}

                  
                
                    {{-- index btn --}}
                    <li class="mt-5 mb-5">
                        <a class="btn our-btn px-3" href="{{ route('user.estates.index') }}">Proprietà</a>
                    </li>
                    {{-- / index btn --}}
                </ul>
            </div>
            {{-- / SINGLE ESTATE --}}

        </div>
    </div>
@endsection
