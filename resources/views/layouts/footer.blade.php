<footer class="footer text-white text-left py-5" style="background: var(--pink-medium-gradient-color); bottom: 0;">
    <div class="container mt-5">
        <div class="content-footer row justify-content-between">
            <div class="col-md-3 mb-3">
                <a href="" >
                    <img src="{{ asset('assets/logo.png') }}" class="mb-3" alt="Logo" width="153px" height="38px">
                </a>
                <p class="footer-logo-text"><i class="fa-regular fa-copyright" style="color: var(--brown-color);"></i> Artcademy 2025.</p>
            </div>
            <div class="col-md-2 mb-3 d-flex flex-column gap-2" >
                <h5 class="fw-bold">Artcademy</h5>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li><a href="#"  >Tentang Kami</a></li>
                    <li><a href="#" >Kursus</a></li>
                    <li><a href="#" >Membership</a></li>
                    <li><a href="#" >Komunitas</a></li>
                </ul>
            </div>
            <div class="col-md-2 mb-3 d-flex flex-column gap-2">
                <h5 class="fw-bold">Pusat Bantuan</h5>
                <ul class="list-unstyled d-flex flex-column gap-2" >
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Kontak Kami</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>
            <div class="col-md-2 mb-3 d-flex flex-column gap-2">
                <h5 class="fw-bold">Ikuti kami</h5>
                <ul class="icon-group list-unstyled d-flex flex-row gap-4" >
                    <li><a href="#"><i class="fa-brands fa-instagram icon"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-facebook icon"></i> </a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube icon"></i> </a></li>
                    <li><a href="#"><i class="fa-brands fa-tiktok icon"></i> </a></li>
                </ul>
            </div>
        </div>
    </div>

</footer>

<style>

    footer {
        overflow: visible;
        border-top-left-radius: 80% 25%;
        border-top-right-radius: 80% 25%;

    }

    .content-footer h5{
        font-size: var(--font-size-primary); 
        color: black
    }

    .content-footer ul{
        font-size: var(--font-size-tiny); 
        color:var(--brown-color)
    }

    .content-footer li a,
    .footer-logo-text{
        text-decoration: none; 
        font-size: var(--font-size-tiny); 
        color:var(--brown-color)
    }

    .content-footer .icon{
        color:var(--brown-color);
        font-size: 24px;
        
    }

    @media (max-width: 768px) {
        .content-footer {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            gap: 50px; 
            text-align: left;
            padding-left: 40px;
        }

        .content-footer > div {
            justify-content: center;
            align-items: center;
        }

        .content-footer h5{
            font-size: 150% !important; 
        }

        .content-footer ul, .content-footer p {
            font-size: 90% !important; 
        }

    }

</style>
