@php
    $backgroundGradient = match($membership->membershipName) {
        'Basic Canvas' => 'var(--orange-gradient-color)',    
        'Creative Studio' => 'var(--blue-gradient-color)',
        'Masterpiece Pro' => 'var(--pink-gradient-color)',
    };

    $checkBenefit = match($membership->membershipName){
        'Basic Canvas' => 'var(--orange-color)',    
        'Creative Studio' => 'var(--blue-color)',         
        'Masterpiece Pro' => 'var(--pink-color)', 
    };

    $subtileText = match($membership->membershipName){
        'Basic Canvas' => 'Langkah awal untuk mulai berkarya',    
        'Creative Studio' => 'Naikin level, biar skill makin kece',         
        'Masterpiece Pro' => 'All out jadi seniman, tanpa batasan', 
    };
@endphp

<div class="pricing-card {{ $membership->membershipName === 'Creative Studio' ? 'highlight' : '' }}">
    @if ($membership->membershipName === 'Creative Studio')
        <div class="badge">Terpopuler</div>
    @endif
    <div class="card-top">
        <h3 class="title-membership" style="background: {{ $backgroundGradient }}; background-clip: text;">{{ $membership->membershipName}}</h3>
        <p class="subtitle">{{ $subtileText }}</p>

        <div class="price-section">
            <h2 class="price">Rp {{ number_format($membership->membershipPrice, 0, ',', '.') }} <span>/ Bulan</span></h2>
        </div>
    </div>
            
    <div class="card-bottom">
        <ul class="features">
            @foreach ($membership->membershipBenefits as $benefit)
                <li><iconify-icon icon="mingcute:check-fill" style="color: {{ $checkBenefit }}"></iconify-icon>{{ $benefit }}</li>
            @endforeach
        </ul>

        <a href="{{ route('membership.detail', ['membershipId' => $membership->id]) }}">
            <button class="btn-membership {{ $membership->membershipName === 'Creative Studio' ? 'yellow-gradient-btn' : 'pink-cream-btn' }} mb-3">Pilih Langganan</button>
        </a>
    </div>
</div>

<style>
    .pricing-card {
        position: relative;
        width: 300px;
        border-radius: 53px;
        background: var(--cream2-color);
        box-shadow: 0 4px 8px rgba(67, 39, 0, 0.2);
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s ease-in-out;
    }

    .pricing-card:hover {
        transform: scale(1.02);
    }

    .card-top {
        background: #FFFFFF;
        padding: 20px 35px;
        border-radius: 53px;
        text-align: center;
        box-shadow: 0 4px 9px rgba(67, 39, 0, 0.2);

    }

    .card-bottom {
        background: var(--cream2-color);
        padding: 0px 35px;
        border-radius: 53px;
    }

    .highlight {
        border: 2px solid var(--pink-color);
        transform: scale(1.1);
        z-index: 15;
    }

    .highlight:hover {
        transform: scale(1.12);
    }

    .badge {
        position: absolute;
        top: -18px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--pink-gradient-color);
        padding: 8px 22px;
        border-radius: 40px;
        color: white;
        font-weight: 600;
        font-size: 14px;
    }

    .title-membership{
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 18px;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;    
    }

    .subtitle {
        color: var(--dark-gray-color);
        font-size: 14px;
        margin-bottom: 20px;
    }

    .price {
        margin-top: 10px;
        font-size: 28px;
        font-weight: 700;
    }

    .price span {
        font-size: 14px;
        font-weight: 400;
    }

    .features {
        list-style: none;
        padding: 0;
        text-align: left;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .features li {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 6px 0;
        font-size: 14px;
        color: var(--dark-gray-color);
    }

    .btn-membership {
        width: 100%;
        padding: 14px 0;
        border-radius: 40px;
        cursor: pointer;
        font-size: 18px;
        transition: all .3s ease;
        
    }

    .pink-cream-btn:hover {
        transform: scale(1.05);
        border: var(--pink-color) 2px solid;
    }

    .yellow-gradient-btn:hover {
        transform: scale(1.05);
        color: var(--black-color);
    }
</style>