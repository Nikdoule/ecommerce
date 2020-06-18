@extends('layouts.app')
@section('products')
@include('includes.menu')
<div class="flex-center position-ref full-height">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <products-component></products-component>
</div>
@endsection
