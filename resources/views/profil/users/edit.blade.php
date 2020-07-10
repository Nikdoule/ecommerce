@extends('layouts.app')

@section('edit-profil-user')
@include('includes.menu')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="card mt-5">
                <div class="card-header">Edit {{ $user->name }}</div>
                <div class="card-body">
                    <form action="{{ route('profil.users.update', $user) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="email" class="col-md-6 col-form-label">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email')  ?? $user->email}}" required
                                    autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-6 col-form-label">{{ __('First name') }}</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name"
                                    autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-6 col-form-label">{{ __('Last name') }}</label>
                            <div class="col-md-12">
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') ?? $user->last_name }}" required autocomplete="last_name"
                                    autofocus>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="civility"
                                class="col-md-4 col-form-label text-md-right">{{ __('Civility') }}</label>
                            <div class="col-md-6 d-flex">
                                <input id="civility" type="radio" class="@error('civility') is-invalid @enderror"
                                    name="civility" id="man" value="m" @if ($user->civility == 'm') checked @endif>
                                <label class="ml-2 form-check-label" for="exampleRadios1">
                                    Masculin
                                </label>
                                @error('civility')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input id="civility" type="radio" class="ml-4 @error('civility') is-invalid @enderror"
                                    name="civility" id="woman" value="f" @if ($user->civility == 'f') checked @endif>
                                <label class="ml-2 form-check-label" for="exampleRadios1">
                                    Feminin
                                </label>
                                @error('civility')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="adress" class="col-md-4 col-form-label text-md-right">{{ __('Adress') }}</label>
                            <div class="col-md-6">
                                <input id="adress" type="text"
                                    class="form-control @error('adress') is-invalid @enderror" name="adress"
                                    value="{{ old('adress') ?? $user->adress }}" required autocomplete="adress"
                                    autofocus>
                                @error('adress')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="zip_code"
                                class="col-md-4 col-form-label text-md-right">{{ __('Zip code') }}</label>
                            <div class="col-md-6">
                                <input id="zip_code" type="text"
                                    class="form-control @error('zip_code') is-invalid @enderror" name="zip_code"
                                    value="{{ old('zip_code') ?? $user->zip_code }}" required autocomplete="zip_code"
                                    autofocus>
                                @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror"
                                    name="city" value="{{ old('city') ?? $user->city }}" required autocomplete="city"
                                    autofocus>
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-6 col-form-label">{{ __('Phone') }}</label>
                            <div class="col-md-12">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') ?? $user->phone }}" required
                                    autocomplete="phone" autofocus>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @if ($user->image)
                        <img src="{{asset('storage/' . $user->image)}}" alt="client-avatar" class="img-thumbnail">
                        @endif
                        
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <input 
                                name="image" type="file" class="form-control @error('image') is-invalid 
                                @enderror" id="image"
                                >
                                <label class="custom-file-label" for="image" >Choose image...</label>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update informations</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <profil-component></profil-component>
</div>
@endsection
