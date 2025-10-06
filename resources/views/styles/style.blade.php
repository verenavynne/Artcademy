<style>
    :root{
        --cream-color: rgba(255, 249, 239, 1);
        --cream2-color: rgba(249, 238, 219, 1);
        --orange-color: rgba(251, 168, 52, 1);
        --brown-color: rgba(86, 54, 0, 1);
        --brown-shadow-color: rgba(67, 39, 0, 0.2);
        --dark-gray-color: rgba(71, 71, 71, 1);
        --pink-color: rgba(233, 45, 98, 1);
        --pink-medium-color: rgba(255, 93, 139, 1);
        --very-light-grey-color: rgba(250, 250, 250, 1);
        --black-color: rgba(27, 27, 27, 1);

        --pink-gradient-color: linear-gradient(0deg, #E92D62 25%, #FF6E97 70%);
        --pink-medium-gradient-color: linear-gradient(180deg, #FFE0E1 0%, #FF8E92 100%);
        --yellow-gradient-color: linear-gradient(158.38deg, #FFDE22 36.37%, #F4A700 89.58%);
        --blue-gradient-color: linear-gradient(149.46deg, #50C4ED 5.33%, #387ADF 75.32%);
        --orange-gradient-color: linear-gradient(0deg, #F69000 25%, #F8BA0C 64.38%);
        --green-gradient-color:linear-gradient(182.72deg, #3EC973 43.36%, #0E8F53 81.22%);

        --font-size-mini: 12px;
        --font-size-tiny: 14px;
        --font-size-small: 16px;
        --font-size-primary: 18px;
        --font-size-big: 20px;
        --font-size-title: 32px;
    }

    body{
        font-family: 'Afacad', sans-serif;
    }

    /* navbar */
    .nav-link {
        position: relative;
        display: inline-block;
        transition: color 0.3s ease;
        font-weight: 400;
    }

    .nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 2.5px;
        width: 100%;
        font-weight: 700;
        background: var(--pink-gradient-color);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .nav-link:hover {
        font-weight: 700;
    }

    .nav-link:hover::after {
        transform: scaleX(1);
    }

    .nav-link.active {
        font-weight: 700;
    }

    .nav-link.active::after {
        transform: scaleX(1);
    }

    .navbar-button-login{
        background: var(--yellow-gradient-color);
        height: 56px;
        width: 117px;
        border-radius: 100px;
        font-size: var(--font-size-primary);
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.2);
        padding: 0;
        margin: 0;
    }

    .navbar-button-login:hover{
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.4);
    }

    /* button */
    .yellow-gradient-btn {
        background: linear-gradient(180deg, #FFDE22 0%, #F4A700 100%);
        border: none;
        border-radius: 50rem;
        padding: 12px 0;
        box-shadow: 0px 4px 8px 0px var(--brown-shadow-color);
        transition: all 0.3s ease;
    }

    .yellow-gradient-btn:hover {
        opacity: 0.7;
    }

    .pink-cream-btn {
        border: 2px solid var(--pink-color);
        background-color: var(--cream2-color);
        border-radius: 50rem;
        padding: 12px 0;
    }

    .pink-cream-btn:hover {
        border: 2px solid var(--cream2-color);
        background-color: var(--cream2-color);
    }

    /* text */
    .text-pink-gradient {
        background: var(--pink-gradient-color);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* form input */
    .custom-input {
        background-color: var(--very-light-grey-color);
        border: none;
        box-shadow: 0px 4px 8px var(--brown-shadow-color);
    }

    .custom-input::placeholder {
        color: #D0C4AF;
        opacity: 1;
    }

    .custom-input-2 {
        padding: 10px 30px 10px 30px;
        box-shadow: 0px 4px 10px var(--brown-shadow-color);
        font-size: 18px;
    }

    /* icons */
    iconify-icon {
        font-size: 24px;
    }

    /* others */
    .left-panel {
        border-top-right-radius: 45px;
        border-bottom-right-radius: 45px;
        box-shadow: 0px 4px 8px var(--brown-shadow-color);
    }

    .separator {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1rem 0;
    }

    .separator::before,
    .separator::after {
        content: '';
        flex: 1;
        border-bottom: 4px solid var(--cream2-color);
        border-radius: 50rem;
        margin: 0 12px;
    }

    .circle {
        position: absolute;
        border-radius: 50%;
    }

    .circle-1 { width: 79px; height: 79px; top: -40px; left: 154px; }
    .circle-2 { width: 34px; height: 34px; top: 39px; left: 250px; }
    .circle-3 { width: 25px; height: 25px; top: 73px; left: 636px; }
    .circle-4 { width: 74px; height: 74px; top: 575px; left: 39px; }
    .circle-5 { width: 31px; height: 31px; top: 400px; left: 600px; }
    .circle-6 { width: 48px; height: 48px; top: 578px; left: 640px; }

</style>