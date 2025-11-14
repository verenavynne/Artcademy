@php
    $containerId = "mockup-container-" . $portfolioId;
@endphp


<div id="{{ $containerId }}"
    style="position: relative; width: max-content; height: auto; margin: 0 auto;">
</div>

<script type="module" src="{{ asset('js/portfolio-mockup.js') }}"></script>

<script type="module">
    import { initMockup } from '/js/portfolio-mockup.js';

     const config = {
        containerId: @json($containerId),
        mockupType: @json($mockupType),
        portoType: @json($portoType),
        mediaPath: @json($mediaPath),
        mockupSize: @json($mockupSize),
        animation: @json($animation),
    };

    initMockup(config);
</script>