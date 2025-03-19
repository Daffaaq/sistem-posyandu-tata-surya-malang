@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <div class="error mx-auto" data-text="403">403</div>
            <p class="lead text-gray-800 mb-5">Your account is inactive. Please contact an administrator to activate your
                account.</p>
            <p class="text-gray-500 mb-0"></p>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link">&larr; Logout</button>
            </form>
        </div>
    </div>
@endsection
