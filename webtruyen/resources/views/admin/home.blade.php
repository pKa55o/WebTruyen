@extends('layouts.app')

@section('content')
@include('admin.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top: 50px;">
                <div class="card-header" style="background-color: #483d8b; color: white; text-align: center; font-size: 18px;">Chào mừng {{ Auth::user()->name }} đến với trang quản lí</div>
                <div class="card-body"></div>
            </div>
        </div>
    </div>
</div>
@endsection