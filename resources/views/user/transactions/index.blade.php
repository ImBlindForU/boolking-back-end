@extends('layouts.user')

@section('title', "Sponsorizza $estate->title")

@section('content')
    <h1>Pagamento di {{ $estate->title }}</h1>

    <form id="payment-form" action="{{ route('user.transaction.process', $estate->id)}}" method="post">

        @csrf

        <select name="sponsors" id="sponsor">
            <option value="">Seleziona una sponsorizzazione</option>
            @foreach ($sponsors as $sponsor)
                <option value="{{$sponsor->id}}">{{ $sponsor->type }}</option>
            @endforeach
        </select>
        <div id="dropin-container"></div>
        <input type="submit" id="submit-button" token="{{ $clientToken }}">
        <input type="hidden" id="nonce" name="payment_method_nonce">
        <input type="hidden" name="estate" value="{{ $estate->id }}">
    </form>

    <script src="https://js.braintreegateway.com/web/dropin/1.34.0/js/dropin.min.js"></script>
    @vite(['resources/js/payments.js'])
@endsection