@extends('layouts.user')
@section('title', "Statistiche di $estate->title")

@section('content')


    <div class="container">

        <h1 class="text-center" id="statsTitle">Statistiche di "{{ $estate->title }}"</h1>


        <div class="text-center">

            <div style="width: 100%;"><canvas id="acquisitions"></canvas></div>
        </div>
    </div>

    {{-- <script type="module" src="dimensions.js"></script>
    <script type="module" src="acquisitions.js"></script> --}}

    <script>
        const views = {!! json_encode($views) !!}
        // console.log(views);
    </script>

@endsection
