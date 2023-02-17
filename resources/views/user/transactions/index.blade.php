@extends('layouts.user')

@section('title', "Sponsorizza $estate->title")

@section('content')
    <div class="container">
        <h1>Pagamento di {{ $estate->title }}</h1>
    
        <form id="payment-form" action="{{ route('user.transaction.process', $estate->id)}}" method="post">
    
            @csrf
    
            <select name="sponsors" id="sponsor" class="form-select w-50 @error('sponsors') is-invalid @enderror" required>
                <option value="">Seleziona una sponsorizzazione</option>
                @foreach ($sponsors as $sponsor)
                    <option value="{{$sponsor->id}}">{{ $sponsor->type }}</option>
                @endforeach
            </select>
            @error('sponsors')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
    
            <div id="dropin-container"></div>
            <input type="submit" class="btn our-btn-header" id="submit-button" token="{{ $clientToken }}">
            <input type="hidden" id="nonce" name="payment_method_nonce">
            <input type="hidden" name="estate" value="{{ $estate->id }}">
        </form>
    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.34.0/js/dropin.min.js"></script>
    @vite(['resources/js/payments.js'])
@endsection