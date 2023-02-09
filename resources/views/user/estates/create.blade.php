@extends('layouts.user')

@section('title', 'Tutti i tuoi proprietà')

@section('content')
    <div class="container py-4">

        {{-- “Hell is empty and all monsters are here.” --}}


        <h1 class="text-center">Inserisci i dati della tua proprietà</h1>
        @if ($errors->any())
            <div class="alert alert-danger my-3" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form enctype="multipart/form-data" action="{{ route('user.estates.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">

                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="room_number" class="form-label">Numero di stanze</label>
                <input type="text" class="form-control @error('room_number') is-invalid @enderror" id="room_number" name="room_number" value="{{ old('room_number') }}">

                @error('room_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bed_number" class="form-label">Numero di letti</label>
                <input type="text" class="form-control @error('bed_number') is-invalid @enderror" id="bed_number" name="bed_number" value="{{ old('bed_number') }}">

                @error('bed_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bathroom_number" class="form-label">Numero di bagni</label>
                <input type="text" class="form-control @error('bathroom_number') is-invalid @enderror" id="bathroom_number" name="bathroom_number" value="{{ old('bathroom_number') }}">

                @error('bathroom_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="detail" class="form-label">Altri dettagli</label>
                <input type="text" class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" value="{{ old('detail') }}">

                @error('detail')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mq" class="form-label">Metri quadri</label>
                <input type="text" class="form-control @error('mq') is-invalid @enderror" id="mq" name="mq" value="{{ old('mq') }}">

                @error('mq')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover_img" class="form-label">Immagine di copertina</label>
                <input type="file" class="form-control @error('cover_img') is-invalid @enderror" id="cover_img" name="cover_img">

                @error('cover_img')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_visible" name="is_visible">
                <label class="form-check-label @error('is_visible') is-invalid @enderror" for="is_visible">Spunta se vuoi renderlo visibile da subito</label>

                @error('checkbox')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <select name="type" id="type" class="form-select w-25 @error('type') is-invalid @enderror">
                    <option value="">Scegli la tipologia di proprietà</option>
                    @foreach ($types as $type)
                        <option value="{{ $type }}" @selected(old('type') == $type)>{{ $type }}</option>
                    @endforeach
                </select>

                @error('type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror                
            </div>

            <div class="mb-3">
                <div>Servizi:</div>

                @foreach ($services as $service)
                    <div class="mb-1 form-check">
                        <input type="checkbox" class="form-check-input" id="service-{{ $service->id }}"
                            value="{{ $service->id }}" name="services[]" @checked(in_array($service->id, old('services', [])))>
                        <label class="form-check-label" for="service-{{ $service->id }}">{{ $service->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label class="form-check-label" for="description">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>

                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Inserisci Prezzo</label>
                <input class="form-control w-25 @error('price') is-invalid @enderror" type="number" min="0.01" step="0.01" max="3000" name="price" id="price" value="{{ old('price') }}" />

                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror 
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Inserisci proprietà</button>
                <button type="reset" class="btn btn-secondary">Resetta i campi</button>
            </div>
        </form>

    </div>
@endsection
