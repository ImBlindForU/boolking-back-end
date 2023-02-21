@extends('layouts.user')
@section('title', "Statistiche di $estate->title")

@section('content')


    <div class="container">

        <h1 id="statsTitle">Statistiche di "{{ $estate->title }}"</h1>



        <div style="width: 500px;"><canvas id="dimensions"></canvas></div><br />
        <div style="width: 800px;"><canvas id="acquisitions"></canvas></div>
    </div>

    {{-- <script type="module" src="dimensions.js"></script>
    <script type="module" src="acquisitions.js"></script> --}}

    <script>
        const views = {!! json_encode($views) !!}
        // console.log(views);
    </script>

@endsection
