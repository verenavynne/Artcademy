<div class="container-tutor-home-card">
    <div class="tutor-header-content d-flex justify-content-between align-items-center" style="padding: 32px; width: 100%;">
        <div class="tutor-name-wrapper">
            <p class="tutor-name fw-bold mb-0">Jane Doe</p>
            <p class="tutor-title mb-0" style="font-size:14px; color: var(--dark-gray-color);">Visual Artist di ABC</p>
        </div>
        
        <a href="#" class="tutor-icon-linkedin-circle d-flex align-items-center justify-content-center">
            <img src="{{ asset('assets/home/linkedin-logo.png')}}" alt="" height="33" width="33">
        </a>
    </div>

    <div class="tutor-image-area d-flex justify-content-center">
       <img class="foto-tutor"src="assets/course/default_tutor_profile.png" alt="">
    </div>
</div>

<style>
.tutor-name {
    background: var(--pink-gradient-color);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent;
    font-size: 16px; 
}
.container-tutor-home-card {
    width: 300px; 
    max-height: 348px; 
    background-color: white; 
    border-radius: 2rem !important; 
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
    display: flex;
    flex-direction: column; 
    justify-content: flex-start;
    align-items: center;    
}

.container-tutor-home-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
}

.tutor-header-content {
    flex-shrink: 0;
}



.tutor-image-area {
    flex-grow: 1; 
    display: flex;
    justify-content: center;
    align-items: ;
    width: 100%;
    height: 50%;
    object-fit: cover;
    aspect-ratio: 9/16;
}

.tutor-main-image {
    width: 100%; 
    height: auto; 
    display: block; 
    object-fit: contain;
    transform: translateY(10px);
    max-height: 80%;
}

.foto-tutor{

}

</style>