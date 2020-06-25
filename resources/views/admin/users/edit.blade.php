@extends('layouts.app')

@section('edit-user')
@include('includes.menu')
<div class="container">
   
<user-component :user="{{ $user }}" :roles="{{ $roles }}" :roles-user="{{ $rolesUser }}"></user-component>
</div>
@endsection
