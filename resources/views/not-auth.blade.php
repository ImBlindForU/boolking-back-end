@extends('layouts.user')

@section('title', 'Accesso negato')

@section('content')

    <h1 class="text-center py-5">
        Non sei autorizzato a visualizzare questo contenuto
    </h1>

    <div class="text-center">
        <a href="{{ route('user.estates.index') }}" class="btn our-btn-header">Torna alla home</a>
    </div>
@endsection
