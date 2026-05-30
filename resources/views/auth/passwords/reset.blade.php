@extends('layouts.app')

@section('content')
<div class="auth-card">
    <div class="auth-card-header">
        <div class="auth-heading">
            <span class="auth-star">&#9733;</span>
            <h2>RESET PASSWORD</h2>
            <span class="auth-star">&#9733;</span>
        </div>
    </div>
    <div class="auth-card-body">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="auth-form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" class="@error('email') auth-input-error @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="your@email.com" required autocomplete="email" autofocus>
                @error('email')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="@error('password') auth-input-error @enderror" name="password" placeholder="New password" required autocomplete="new-password">
                @error('password')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-form-group">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm new password" required autocomplete="new-password">
            </div>

            <button type="submit" class="auth-submit">Reset Password</button>
        </form>
    </div>
</div>
@endsection
