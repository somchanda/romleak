@extends('layouts.app')

@section('content')

    <form method="post" action="{{ route('password.email') }}" class="form-signin">
        @csrf
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @error('email')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror
        <p class="text-muted text-center btn-block btn btn-primary btn-rect">{{ __('E-Mail Address') }}</p>
        <input id="email" type="email" class="form-control" value="{{old('email')}}" name="email" required autocomplete="email" autofocus>
        <br />
        <button class="btn text-muted text-center btn-success form-control" type="submit">{{ __('Send Password Reset Link') }}</button>
    </form>
    <div class="text-center">
        <ul class="list-inline">
            <li><a class="text-muted" href="{{route('admin')}}" >Login</a></li>
            <li><a class="text-muted" href="{{route('password.request')}}" >Forgot Password</a></li>
        </ul>
    </div>
@endsection
