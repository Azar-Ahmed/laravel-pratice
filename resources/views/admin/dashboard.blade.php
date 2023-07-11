@extends('admin.includes.layout')
@section('page_title', 'Dashboard')
    @section('container')
        <div class="row">
            <div class="col-md-12">
                <h1>Dashboard</h1>
                <a href="{{ route('logout') }}" class="btn btn-danger">
    Logout
</a>
            </div>
        </div>
@endsection
@section('custom_script')
@endsection