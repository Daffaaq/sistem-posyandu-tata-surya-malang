@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <div class="error mx-auto" data-text="Success">Success</div>
            <p class="lead text-gray-800 mb-5">{{ session('success') }}</p>
            <p class="text-gray-500 mb-3">Your registration was successful. However, your account is pending approval from the admin. Please wait for an email notification.</p>
            <p class="text-gray-500 mb-0">Once your account is approved, you can log in and start using the application.</p>

            <!-- Optionally, you can also add a logout form if needed -->
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-link">&larr; Logout</button>
            </form>
        </div>
    </div>
@endsection
