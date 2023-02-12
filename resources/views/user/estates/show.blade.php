@extends('layouts.user')

@section('title', $estate->title)

@section('content')
    <div class="container">

        {{-- “Hell is empty and all monsters are here.” --}}


        <div class="row justify-content-center mt-5">
            {{-- SINGLE ESTATE --}}
            <div class="col-12 col-lg-10">
                <h2 class="text-center mb-4">{{ $estate->title }}</h2>
                
                <div class="mt-2 text-center"> 
                {{--  IMAGE --}}
                @if (str_contains($estate->cover_img, "cover")) 
                <img class="rounded-3 w-100" src="{{ asset('storage/' . $estate->cover_img) }}" style="max-width: 500px">
                @else 
                    <img src="{{$estate->cover_img}}" style="max-width: 500px">
        
                @endif
                {{-- / IMAGE --}}
                </div>

                <div id="img-show-div"  class="d-flex flex-wrap  my-4 align-center mx-auto justify-content-center">
                    @forelse ($estate->images as $image)


                        <img class="optional-img-show" src="{{ asset('storage/' . $image->path) }}" style="max-width: 500px">
                        
                
                        
                    @empty
                        
                    @endforelse
                </div>

                <div id="info-wrapper" class="d-flex justify-content-between w-100">
                <div class="street w-50">

                    <p><span>Indirizzo:</span> {{ $estate->address?->street }}</p>
                    <p><span>Numero Civico:</span> {{ $estate->address?->street_code }}</p>
                    <p><span>Città:</span>{{ $estate->address?->city }} </p>
                    <p><span>Paese:</span> {{ $estate->address?->country }}</p>
                </div>

                <div class="estate-details w-50 text-end">
                    <p> <span>Tipologia:</span>{{ $estate->address?->type }} </p>
                    <p><span>Nr. Stanze:</span> {{ $estate->address?->room_number }}</p>
                    <p><span>Nr. Letti:</span>{{ $estate->address?->bed_number }} </p>
                    <p><span>Nr. Bagni:</span> {{ $estate->address?->bathroom_number }}</p>
                </div>
                </div>
                <div>
                    <p><span>Dettagli:</span> {{ $estate->detail }}</p>
                    <p><span>Prezzo:</span> {{ $estate->price }}</p>
                    <p><span>Metri Quadri:</span> {{ $estate->mq }}</p>
                    <p><span>Visibile:</span> {{ $estate->is_visible ? 'Si' : 'No' }}</p>
                    <p><span>Descrizione:</span> {{ $estate->description}}</p>

                </div>


                <dl style="">
                    <dt>Servizi aggiuntivi:</dt>

                    {{-- services --}}
                    @forelse ($estate->services as $service)
                        <dl>{{ $service->name }}</dl>
                    @empty
                        <dl>
                            Nessun servizio specificato
                        </dl>
                    @endforelse
                    {{-- / services --}}
                </dl>
                {{-- index btn --}}
                <div class="mt-5 mb-5">
                    <a class="btn our-btn px-3" href="{{ route('user.estates.index') }}">Proprietà</a>
                </div>
                {{-- / index btn --}}
            </div>
            {{-- / SINGLE ESTATE --}}

        </div>
    </div>
@endsection
