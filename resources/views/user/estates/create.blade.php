@extends('layouts.user')

@section('title', 'Tutti i tuoi proprietà')

@section('content')
    <div class="container">
        <h1 class="text-center">Inserisci la tua proprietà :0</h1>

        <form enctype="multipart/form-data" action="{{route('user.estates.store')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Titolo</label>
              <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="mb-3">
              <label for="room_number" class="form-label">Numero di stanze</label>
              <input type="text" class="form-control" id="room_number" name="room_number">
            </div>

            <div class="mb-3">
                <label for="bed_number" class="form-label">Numero di letti</label>
                <input type="text" class="form-control" id="bed_number" name="bed_number">
            </div>

            <div class="mb-3">
                <label for="bathroom_number" class="form-label">Numero di bagni</label>
                <input type="text" class="form-control" id="bathroom_number" name="bathroom_number">
            </div>
            
            <div class="mb-3">
                <label for="detail" class="form-label">Altri dettagli</label>
                <input type="text" class="form-control" id="detail" name="detail">
            </div>
            <div class="mb-3">
                <label for="mq" class="form-label">Metri quadri</label>
                <input type="text" class="form-control" id="mq" name="mq">
            </div>
            <div class="mb-3">
                <label for="cover_img" class="form-label">Immagine di copertina</label>
                <input type="file" class="form-control" id="cover_img" name="cover_img">
            </div>
            <div class="mb-3">
                <select name="type" id="type">
                    <option value="">Scegli la tipologia di proprietà</option>
                    @foreach ($types as $type)
                        <option value="{{$type}}">{{$type}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="is_visible" >
              <label class="form-check-label" for="is_visible" name="is_visible">Seleziona se vuoi renderlo visibile da subito</label>
            </div>
                @foreach ($services as $service)
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="service-{{$service->id}}" value="{{$service->id}}" name="services[]"    >
                        <label class="form-check-label" for="service-{{$service->id}}" >{{$service->name}}</label>
                    </div>
                @endforeach
            
            <div class="mb-3">
                <label for="price" class="form-label">Inserisci Prezzo</label>
                <input class="form-control w-25" type="number" min="0.01" step="0.01" max="3000" name="price" id="price"/>
            </div>        
            <button type="submit" class="btn btn-primary">Inserisci proprietà</button>
          </form>

    </div>
@endsection