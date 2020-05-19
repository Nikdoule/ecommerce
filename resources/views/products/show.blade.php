@extends('layouts.app')
@section('product')
<div class="flex-center position-ref full-height">
<product-component :product="{{ $product }}"></product-component>
</div>
@endsection