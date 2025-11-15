@extends('layouts.master')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-4" style="margin-bottom: 75px;">
    <div class="row">
        <div class="col-3">
            <div class="sidebar-left position-fixed">
                <div class="profile-box shadow rounded ">
                    <img src="{{ asset('assets/default-profile.jpg') }}" 
                    class="profile-picture rounded-circle object-fit"
                    alt="" width="74" height="74">
                    <div class="col">
                        <p>Farren</p>
                        <p>Graphic designer</p>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection