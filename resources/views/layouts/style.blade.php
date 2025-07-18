<style>
    :root{
        --cream-color: rgba(255, 249, 239, 1);
        --orange-color: rgba(251, 168, 52, 1);
        --brown-color: rgba(86, 54, 0, 1);
        --dark-gray-color: rgba(71, 71, 71, 1);

        --pink-gradient-color: linear-gradient(0deg, #E92D62 25%, #FF6E97 70%);
        --pink-medium-gradient-color: linear-gradient(180deg, #FFE0E1 0%, #FF8E92 100%);
        --yellow-gradient-color: linear-gradient(158.38deg, #FFDE22 36.37%, #F4A700 89.58%);
        --blue-gradient-color: linear-gradient(149.46deg, #50C4ED 5.33%, #387ADF 75.32%);
        --orange-gradient-color: linear-gradient(0deg, #F69000 25%, #F8BA0C 64.38%);
        --green-gradient-color:linear-gradient(182.72deg, #3EC973 43.36%, #0E8F53 81.22%);

        --font-size-tiny: 14px;
        --font-size-small: 16px;
        --font-size-primary: 18px;
        --font-size-big: 20px;
        --font-size-title: 32px;
    }

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
</style>