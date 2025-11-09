    <ul class="nav mb-4 mt-4 w-100 statusTabs">
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ request('courseStatus') == 'draft' ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.courses.index', ['courseStatus' => 'draft']) }}">
            Draft
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ request('courseStatus') == 'publikasi' ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.courses.index', ['courseStatus' => 'publikasi']) }}">
            Dipublikasikan
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ request('courseStatus') == 'arsip' ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.courses.index', ['courseStatus' => 'arsip']) }}">
            Diarsipkan
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ !request('courseStatus') ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.courses.index') }}">
            Semua
            </a>
        </li>
    </ul>

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