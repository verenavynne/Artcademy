<div class="rincian-event-card d-flex flex-column">
    <p class="rincian-event-title fw-bold">Rincian Produk</p>

    <hr class="rincian-event-divider">

    <p class="fw-bold fs-5 m-0">{{ $event->eventName }}</p>

    <hr class="rincian-event-divider">

    <div class="rincian-event-list d-flex flex-column">
        <div class="list-rincian-event d-flex flex-row justify-content-between">
            <p>Sub Total</p>
            <p>Rp {{ number_format($event->eventPrice, 0, ',', '.') }}</p>
        </div>
        <div class="list-rincian-event d-flex flex-row justify-content-between">
            <p class="m-0">PPN (8%)</p>
            <p class="m-0">Rp {{ number_format($event->eventPrice * 0.08, 0, ',', '.') }}</p>
        </div>
    </div>

    <hr class="rincian-event-divider">

    <div class="rincian-event-list d-flex flex-column">
        <div class="list-rincian-event d-flex flex-row justify-content-between">
            <p class="fw-bold">Total</p>
            <p class="fw-bold">Rp {{ number_format($event->eventPrice * 1.08, 0, ',', '.') }}</p>
        </div>
    </div>

    @if($isCheckoutPage)
        <form id="payment-form">
            @csrf
            <input type="hidden" name="eventId" value="{{ $event->id }}">
            <button type="submit" id="pay-button" class="btn w-100 text-dark yellow-gradient-btn">
                <span id="btn-text">Bayar Sekarang</span>
                <span id="btn-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </form>
    @else
        <a href="{{ route('event.checkoutInfo', $event->id) }}">
            <button class="btn w-100 text-dark yellow-gradient-btn">
                Checkout
            </button>
        </a>
    @endif

</div>

<style>
    .rincian-event-card{
        display: flex;
        width: 439px;
        height: max-content;
        padding: 32px 30px;
        justify-content: center;
        border-radius: 44px;
        background: white;
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
    }

    .rincian-event-list{
        gap: 10px;
        padding-inline: 5px;
        padding-block: 20px;
    } 

    .rincian-event-title{
        margin: 0;
        font-size: var(--font-size-title); 
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .rincian-event-divider{
        border: none;
        height: 3px;
        background-color: var(--orange-color);
        border-radius: 2px;
    }
</style>


<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.clientKey') }}">
</script>

<script>
    document.getElementById('payment-form').addEventListener('submit', function(e){
        e.preventDefault();
    });

    document.querySelector('#payment-form button[type="submit"]').addEventListener('click', async function(e) {
        e.preventDefault();

        const form = document.getElementById('payment-form');
        const formData = new FormData(form);
        const payButton = document.getElementById('pay-button');
        const btnText = document.getElementById('btn-text');
        const btnSpinner = document.getElementById('btn-spinner');

        btnText.classList.add('d-none');
        btnSpinner.classList.remove('d-none');
        payButton.disabled = true;

        let response = await fetch("{{ route('event.pay') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        });

        let result = await response.json();
        console.log('Snap token dari backend:', result.snap_token);

        btnText.classList.remove('d-none');
        btnSpinner.classList.add('d-none');
        payButton.disabled = false;

        snap.pay(result.snap_token, {
            onSuccess: function(res){
                console.log('Respon Midtrans:', res);

                fetch("/student/event/payment/update-payment-status", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        snap_token: result.snap_token,
                        eventId: "{{ $event->id }}",
                        transaction_status: res.transaction_status
                    })
                })
                .then(r => r.json())
                .then(data => {
                    console.log('Update status response:', data);
                    if(data.success){
                        if(data.paymentStatus === 'paid'){
                            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                            successModal.show();
                        } else if(data.paymentStatus === 'pending'){
                            alert('Pembayaran masih pending. Silakan tunggu konfirmasi.');
                        } else {
                            alert('Pembayaran gagal. Silakan coba lagi.');
                        }
                    } else {
                        alert('Gagal update payment, coba lagi');
                    }
                })
                .catch(err => console.error('Update status error:', err));
            },
        });
    });
</script>


