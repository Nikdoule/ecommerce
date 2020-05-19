@extends('layouts.app')
@section('home')
<div class="flex-center position-ref full-height">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <products-component :products="{{ $products }}"></products-component>

</div>
@endsection
