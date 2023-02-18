@extends('layouts.user')

@section('title', "Sponsorizza $estate->title")

@section('content')
    <div class="container">
        <h1>Pagamento di {{ $estate->title }}</h1>
    
        <form id="payment-form" action="{{ route('user.transaction.process', $estate->id)}}" method="post">
    
            @csrf
    
            {{-- <select name="sponsors" id="sponsor" class="form-select w-50 @error('sponsors') is-invalid @enderror" required>
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
                 --}}
            <div class="row-card">
                @foreach ($sponsors  as $sponsor)
                    <div class="sponsorship-card d-flex flex-column ">
                        <div class="sponsorship title-sponsor">
                            {{ $sponsor->type }}
                        </div>
                        <div class="sponsorship description-sponsor">
                            {{ $sponsor->description }}
                            
                        </div>
                        <div class="sponsorship price-sponsor">
                            {{ $sponsor->price }}$
                            
                        </div>
                        <div class="sponsorship">
                            <input type="radio" name="sponsors" value="{{$sponsor->id}}">
                        </div>
                    </div>
                @endforeach
                
            </div>

           
            <div id="dropin-container"></div>
            <input type="submit" class="btn our-btn-header" id="submit-button" token="{{ $clientToken }}">
            <input type="hidden" id="nonce" name="payment_method_nonce">
            <input type="hidden" name="estate" value="{{ $estate->id }}">
        </form>
    </div>

    
    <div class="container1">
        <div class="left-side">
                <div class="card">
                    <div class="card-line"></div>
                    <div class="buttons"></div>
                </div>
                    <div class="post">
                        <div class="post-line"></div>
                        <div class="screen">
                            <div class="dollar">$</div>
                    </div>
                    <div class="numbers"></div>
                    <div class="numbers-line2"></div>
                </div>
        </div>
        <div class="right-side">
            <div class="new">New Transaction</div>
            <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 451.846 451.847"><path d="M345.441 248.292L151.154 442.573c-12.359 12.365-32.397 12.365-44.75 0-12.354-12.354-12.354-32.391 0-44.744L278.318 225.92 106.409 54.017c-12.354-12.359-12.354-32.394 0-44.748 12.354-12.359 32.391-12.359 44.75 0l194.287 194.284c6.177 6.18 9.262 14.271 9.262 22.366 0 8.099-3.091 16.196-9.267 22.373z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#cfcfcf"/></svg>    
        </div>
   </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.34.0/js/dropin.min.js"></script>
    @vite(['resources/js/payments.js'])
@endsection