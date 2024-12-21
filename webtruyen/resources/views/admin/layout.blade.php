@extends('layouts.app')

@section('content')
@include('admin.nav')
<main class="py-4" style="min-height: 70vh;">
    @yield('content-for')
</main>
@endsection