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
        @if (session('status'))
            <div class="auth-alert auth-alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="auth-form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" class="@error('email') auth-input-error @enderror" name="email" value="{{ old('email') }}" placeholder="your@email.com" required autocomplete="email" autofocus>
                @error('email')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="auth-submit">Send Password Reset Link</button>
        </form>
    </div>
</div>
@endsection
