@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 mb-4 bg-light rounded-3">
    <div id="container-welcome" class="container py-5">
        <div id="logo-welcome" class="logo w-25">
            <img class="logo w-50" src="{{Vite::asset('resources/images/logo.png')}}" alt="" srcset="">
        </div>
        <h1 id="h1-welcome" class="display-5 fw-bold">
            Welcome to Boolking
        </h1>

        <p class="col-md-8 fs-6">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
    </div>
</div>

<div id="content-welcome" class="content">
    <div class="container">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis accusamus dolores!</p>
    </div>
</div>
@endsection
