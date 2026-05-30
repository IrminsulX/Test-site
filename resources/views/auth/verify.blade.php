@extends('layouts.app')

@section('content')
<div class="auth-card">
    <div class="auth-card-header">
        <div class="auth-heading">
            <span class="auth-star">&#9733;</span>
            <h2>VERIFY EMAIL</h2>
            <span class="auth-star">&#9733;</span>
        </div>
    </div>
    <div class="auth-card-body">
        @if (session('resent'))
            <div class="auth-alert auth-alert-success">A fresh verification link has been sent to your email address.</div>
        @endif

        <p class="auth-text">Before proceeding, please check your email for a verification link.</p>
        <p class="auth-text">
            If you did not receive the email,
            <a href="#" onclick="event.preventDefault(); document.getElementById('resend-form').submit();">click here to request another</a>.
        </p>

        <form id="resend-form" method="POST" action="{{ route('verification.resend') }}" class="d-none">
            @csrf
        </form>
    </div>
</div>
@endsection
