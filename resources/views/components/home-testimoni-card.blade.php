<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ribeye&display=swap" rel="stylesheet">

<div class="testimonial-card">
    <div class="header-testimoni">
        <img src="{{asset('assets/default-profile.jpg')}}" alt="Profile Picture" class="profile-testimoni-img">
        <div class="info-testimoni">
            <p class="name-testimoni">{{ $testimoni->student->user->name }}</p>
            <p class="title-testimoni">{{ optional($testimoni->student->user)->profession ?? '' }}</p>
        </div>
    </div>

    <hr class= testimoni-line>

    <div class="body-testimoni">
        <span class="quote-icon">“</span>
        <p class="quote-text">{{ $testimoni->testimoniContent }}</p>
    </div>
</div>

<style>
    .testimonial-card{
    display: flex;
    width: 300px;
    min-height: 259px;
    padding: 34px 24px;
    flex-direction: column;
    align-items: flex-start;
    gap: 14px;
    border-radius: 44px;
    background: var(--white, #FFF);
    box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .testimonial-card:hover{
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
    }

    .header-testimoni{
        display: flex;
        align-items: center;
        gap: 19px;
        align-self: stretch;
    }

    .name-testimoni{
        font-size: 14px;
        font-weight: 700;
        background: var(--Orange-Gradient, linear-gradient(0deg, #F69000 0%, #F8BA0C 100%));
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin:0;
    }

    .title-testimoni{
        font-size: 12px;
        color: var(--dark-gray-color);
        margin:0;
    }

    .profile-testimoni-img{
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 100px;
    }

    .info-testimoni{
        display: flex;
        width: auto;
        height: 45px;
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }

    .testimoni-line{
        border: none; 
        background-color: var(--cream2-color);
        height: 1px;
        opacity: 1;
        width: 100%;
        margin: 0;
    }

    .quote-text{
        font-size: 14px;
        color: var(--dark-gray-color);
        margin: 0;
    }

    .quote-icon{
        height: 26px;
        align-self: stretch;
        font-family: Ribeye;
        font-size: 40px;
        font-weight: 400;
        background: var(--Orange-Gradient, linear-gradient(0deg, #F69000 0%, #F8BA0C 100%));
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 0;
        line-height: 0.8; /* Mengecilkan ruang vertikal yang dihasilkan font 40px */
        display: block; /* Memastikan line-height dapat diterapkan dengan baik */
    }
</style>
