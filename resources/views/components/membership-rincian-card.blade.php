<div class="rincian-card d-flex flex-column">
    <p class="rincian-title fw-bold">Rincian Produk</p>

    <hr class="rincian-divider">

    <p class="fw-bold fs-5 m-0">Paket Membership {{ $membership->membershipName }} 1 Bulan</p>

    <hr class="rincian-divider">

    <div class="rincian-list d-flex flex-column">
        <div class="list-rincian d-flex flex-row justify-content-between">
            <p>Sub Total</p>
            <p>Rp {{ number_format($membership->membershipPrice, 0, ',', '.') }}</p>
        </div>
        <div class="list-rincian d-flex flex-row justify-content-between">
            <p class="m-0">PPN (8%)</p>
            <p class="m-0">Rp {{ number_format($membership->membershipPrice * 0.08, 0, ',', '.') }}</p>
        </div>
    </div>

    <hr class="rincian-divider">

    <div class="rincian-list d-flex flex-column">
        <div class="list-rincian d-flex flex-row justify-content-between">
            <p class="fw-bold">Total</p>
            <p class="fw-bold">Rp {{ number_format($membership->membershipPrice * 1.08, 0, ',', '.') }}</p>
        </div>
    </div>

    @if ($isCheckoutPage)
        <form action="#" method="POST">
            @csrf
            <button type="submit" class="btn w-100 text-dark yellow-gradient-btn">
                Bayar Sekarang
            </button>
        </form>
    @else
        <a href="{{ route('membership.checkoutInfo', $membership->id) }}">
            <button class="btn w-100 text-dark yellow-gradient-btn">
                Checkout
            </button>
        </a>
    @endif
</div>

<style>
    .rincian-card{
        display: flex;
        width: 439px;
        height: max-content;
        padding: 32px 30px;
        justify-content: center;
        border-radius: 44px;
        background: white;
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
    }

    .rincian-list{
        gap: 10px;
        padding-inline: 5px;
        padding-block: 20px;
    } 

    .rincian-title{
        margin: 0;
        font-size: var(--font-size-title); 
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .rincian-divider{
        border: none;
        height: 3px;
        background-color: var(--orange-color);
        border-radius: 2px;
    }
</style>