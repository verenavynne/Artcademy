@extends('layouts.master')

@section('content')

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 80px;">
    <div class="navigation-prev d-flex flex-start mt-1">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-evenly" style="width: 100%; align-items: flex-start; align-self: stretch; gap: 24px;">
        <!-- <div style="width: 20%"> -->
            @include('profile.components.sidebar-profile')
        <!-- </div> -->

        <div class="d-flex flex-column" style="width: 75%; ">
            <p class="title text-start fw-bold">Lihat Riwayat Transaksimu!</p>
            
            <div class="transaction-history-section d-flex flex-column gap-2">
                @if($transactions->count() === 0)
                    <div class="d-flex flex-column align-items-center gap-3">
                        <p class="text-muted text-center" style="font-size: 18px">Belum ada riwayat transaksi</p>
                    </div>
                @endif
                @foreach ($transactions as $transaction)
                    <div class="transaction-history-card d-flex flex-row w-100 justify-content-between">
                        <div class="transaction-history-left d-flex flex-column gap-2">
                            <p class="transaction-id">{{ $transaction['tokenId'] }}</p>
                            <p class="transaction-name fw-bold">{{ $transaction['name'] }} - {{ $transaction['type'] }}</p>
                            <div class="transaction-details d-flex flex-row gap-2">
                                <div class="d-flex flex-column gap-1">
                                    <p>Tanggal Dibuat: </p>
                                    <p>Tanggal Dibayar: </p>
                                  
                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <p>{{ $transaction['created_at']->format('d M Y, H:i') }}</p>
                                    <p>{{ $transaction['created_at']->format('d M Y, H:i') }}</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="transaction-history-right d-flex flex-column align-items-start text-center gap-2">
                            <div class="dibayar-container">
                                <p class="dibayar-text">{{ $transaction['status'] }}</p>
                            </div>
                            <p class="harga-text fw-bold">Rp{{ number_format($transaction['price'], 0, ',','.') }}</p>

                        </div>
                        
                    </div>
                
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4 ">
                {{ $transactions->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<style>
    .transaction-history-card{
        padding: 35px 28px;
        height: max-content;
        background: white;
        border-radius: 24px;
        box-shadow: 0 4px 8px 0  var(--brown-shadow-color)
    }

    .transaction-details p{
        margin: 0;
        font-size: var(--font-size-tiny);
        color: var(--dark-gray-color);
    }

    .transaction-id{
        margin: 0;
        background: var(--orange-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: var(--font-size-primary);
        font-weight: 500;
    }

    
    .transaction-name{
        margin: 0;
        font-size: var(--font-size-big);
        color: var(--black-color);
    }

    .harga-text{
        margin: 0;
        font-size: var(--font-size-big);
        color: var(--black-color);
    }

    .dibayar-container{
        border-radius: 10px;
        display: flex;
        padding: 4px 20px;
        justify-content: center;
        align-items: center;
        background-color: #DAFFE9;;
    }

    .dibayar-text{
        margin: 0;
        background: var(--green-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection