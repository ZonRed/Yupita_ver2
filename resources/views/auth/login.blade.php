@extends('layouts.auth')
@section('name')
<h2>Login</h2>
<p> Yupita Air Minum ADMIN</p>
@endsection
@section('content')
    @if (session('status'))
    <div id="success-message" class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required
                autofocus autocomplete="username">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="position-relative mb-3 mt-4">
            <label class="form-label" for="password">{{ __('Password') }}</label>
            <div class="input-group">
                <input id="password" class="form-control" type="password" name="password" required
                    autocomplete="current-password">
              <span class="input-group-text">
                    <i class="fa fa-eye" id="togglePasswordConfirmation" style="cursor: pointer;"></i>
                </span>
            </div>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
    <small class="mt-3 text-center d-block">Lupa password? <a href="{{ route('password.reset') }}">Reset Password</a></small>
    <small class="mt-3 text-center d-block">Belum punya akun? <a href="{{ route('register') }}">Register</a> sekarang</small>

    <script>
        document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    // Hide success message after 3 seconds
    setTimeout(() => {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);
    </script>
@endsection
