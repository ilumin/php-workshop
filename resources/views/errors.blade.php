@extends('layouts.app')

@section('content')
    <div class="error-page text-center">
        <h2 class="headline text-info">ERROR: {{ $error_code }}</h2>
        <div class="error-content">
            <p>
                {{ $error_message }}<br />
                <a href="{{ url('/') }}" class="btn btn-primary">return to home</a>
            </p>
        </div>
    </div>
@endsection
