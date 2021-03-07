@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
@endsection

@section('content')
    <form method="POST" action="/payments" style="width: 150px">
        @csrf
        <button type="submit" class="ml-24 bg-blue-500 py-2 rounded text-white text-sm w-full">Make Payment</button>
    </form>
@endsection
