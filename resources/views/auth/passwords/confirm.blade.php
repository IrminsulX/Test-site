@extends('layouts.app')

@section('content')
<div class="auth-card">
    <div class="auth-card-header">
        <div class="auth-heading">
            <span class="auth-star">&#9733;</span>
            <h2>CONFIRM PASSWORD</h2>
            <span class="auth-star">&#9733;</span>
        </div>
    </div>
    <div class="auth-card-body">
        <p class="auth-text">Please confirm your password before continuing.</p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="auth-form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="@error('password') auth-input-error @enderror" name="password" placeholder="Enter your password" required autocomplete="current-password">
                @error('password')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="auth-submit">Confirm Password</button>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
            @endif
        </form>
    </div>
</div>
@endsection
