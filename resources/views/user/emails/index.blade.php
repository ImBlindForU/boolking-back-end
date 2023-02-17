@extends('layouts.user')

@section('content')
    <div class="container mt-4  ">
        <div class="container mt-4">
            <h3 class="text-center text-danger fw-bold">Messaggi:</h3>
            <div class="row justify-content-center">
                <div class="col-11">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <ul>
                        @foreach ($leads as $lead)
                            @foreach ($lead as $item)
                                <li>{{ $item['message'] }}</li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
