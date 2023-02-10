@extends('layouts.user')

@section('title', $estate->title)

@section('content')
    <div class="container">

        {{-- “Hell is empty and all monsters are here.” --}}


        <div class="row justify-content-center mt-5">
            {{-- SINGLE ESTATE --}}
            <div class="col-12 col-lg-10">
                <ul style="list-style:none">
                    {{-- header --}}
                    <li>
                        <h2 class="text-center mb-4">{{ $estate->title }}</h2>
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

                    {{-- IMAGE --}}
                    <li class="mt-5 text-center">
                       
                            @if (str_contains($estate->cover_img, "cover")) 
                                 <img src="{{ asset('storage/' . $estate->cover_img) }}" style="max-width: 500px">
                             @else 
                                 <img src="{{$estate->cover_img}}" style="max-width: 500px">
                        
                            @endif
                       

                    </li>
                    {{-- / IMAGE --}}
                    
                    @forelse ($estate->images as $image)

                    <li class="mt-5 text-center">

                        <img src="{{ asset('storage/' . $image->path) }}" style="max-width: 500px">
                        
                    </li>
                        
                    @empty
                        
                    @endforelse
                
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
