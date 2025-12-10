@extends('layouts.master-tutor')

@section('content')
<div class="container-content">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-semibold" style="font-size: 32px">Kursus Saya</h4>
    </div>

    <ul class="nav mb-4 mt-4 w-100 statusTabs">
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ $status === 'dipublikasikan' ? 'active' : 'text-custom' }}" 
                href="{{ route('lecturer.kursus-saya', ['status' => 'dipublikasikan']) }}">
                Dipublikasikan
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ $status === 'diarsipkan' ? 'active' : 'text-custom' }}" 
                href="{{ route('lecturer.kursus-saya', ['status' => 'diarsipkan']) }}">
                Diarsipkan
            </a>
        </li>
    </ul>

    <div class="d-flex flex-row flex-wrap gap-4 p-3">
        @forelse ($courses as $course)
            @include('components.course-card')
        @empty
            <div class="d-flex justify-content-center align-items-center w-100" style="height: 200px;">
                <p class="text-center m-0">Tidak ada kursus yang {{ $status }}.</p>
            </div>
        @endforelse
    </div>
</div>

<style>    
    .nav-link{
        width: 100%;
    }
    .statusTabs {
        border-bottom: 4px solid #F9EEDB;
        position: relative;
    }

    .statusTabs .nav-link:hover,
    .statusTabs .nav-link.active {
        background: var(--pink-gradient-color);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .statusTabs .nav-link:hover::after,
    .statusTabs .nav-link.active::after {
        position: absolute;
        bottom: -4px;
        border-radius: 10px;
        height: 4px;
    }

    .text-custom {
        color: #D0C4AF !important;
    }
</style>
@endsection