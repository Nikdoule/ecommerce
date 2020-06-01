@extends('layouts.app')

@section('thankyou')
    @if(Session::has('success'))
<div class="col-md-12">
    <div class="jumbotron text-center">
        <h1 class="display-3">Merci!</h1>
        <p class="lead"><strong>{{ Session::get('success') }}</strong></p>
        <hr>
        <p>
            Vous rencontrez un problème? <a href="#">Nous contacter</a>
        </p>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}" role="button">Continuer vers la
                boutique</a>
        </p>
        @endif
    </div>
</div>
@endsection
