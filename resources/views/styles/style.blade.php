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
        --red-gradient-color: linear-gradient(0deg, #E53636 25%, #FF6E6E 70%);

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

    /* For disabled item */
    [aria-disabled="true"] {
        opacity: 0.5;
        pointer-events: none; 
        cursor: not-allowed;  
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

    /* Navigate Previous Page Button */
    .navigation-prev .page-link{
        background: var(--yellow-gradient-color);
        border-radius: 50%;
        color: black;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 7.571px 15.143px 0px rgba(67, 39, 0, 0.20);
    }
    /* navbar admin */
    .nav-link-admin {
        color: var(--Dark-gray, #474747);
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
        font-size: 18px;
        font-weight: 500;
        display: flex;
        align-items: center;
        padding: 12px 12px 12px 12px; 
        border-radius: 10px;
        transition: all 0.25s ease-in-out;
        text-decoration: none !important;
        width: 100%;
    }

    .nav-link-admin::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 2.5px;
        width: 100%;
        font-weight: 700;
    }



.nav-link-admin:hover {
    background-color: rgba(255, 221, 160, 0.25);
    color: #000;
    text-decoration: none !important;
    font-weight: 700;
}

    .nav-link-admin:hover::after {
        transform: scaleX(1);
    }

    .nav-link-admin.active {
    font-weight: 600;
    color: #000;
}

    .nav-link-admin.active::after {
        transform: scaleX(1);
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

    .text-orange-gradient {
        background: var(--orange-gradient-color);
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

    /* Divider Line */
    
    .divider{
        border: none;
        height: 3px;
        background-color: var(--orange-color);
        border-radius: 2px;
        margin-block: 34px;
    }

    /* Category Button */
    
    .category-btn-group{
        justify-content: space-between;
    }
    .category-btn-group a{
        text-decoration: none;
        padding: 32px 0;
    }

    .review-btn,
    .category-btn{
        border-radius: 1000px;
        background: white;
        border: none;
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
        height: 42px;
        padding: 10px 40px;
        font-size: var(--font-size-primary);
        justify-content: space-center;
    }

    .review-btn.active,
    .category-btn.active{
        background: var(--pink-medium-gradient-color);
    }

    .category-btn.filter-icon{
        padding: 10px;
        border-radius: 100px;
    }

    /* Pagination */
    .pagination {
        margin-top: 58px;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .pagination .page-item .page-link {
        border: none;
        color: var(----dark-gray-color);
        font-size: var(--font-size-normal);
        background-color: transparent;
    }

    .pagination .page-item.active .page-link {
        text-decoration: underline;
        background-color: transparent;
        font-weight: 700;
    }

    .pagination .page-item.next .page-link,
    .pagination .page-item.prev .page-link{
        background: var(--yellow-gradient-color);
        border-radius: 50%;
        color: black;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: box-shadow: 0px 7.571px 15.143px 0px rgba(67, 39, 0, 0.20);
    }

    /* table */
    .table {
        margin-bottom: 0;
    }

    /* .table thead {
        position: relative;
    } */

    .table thead::after {
        content: "";
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 95%;
        height: 3px;
        background-color: #F9EEDB;
        border-radius: 4px;
    }

    .table th,
    .table td {
        padding: 10px 15px;
        border: none !important;
        background-color: #FFFFFF;
    }

    .footer-admin-text{
        color: #AAA18F !important;
        font-size: 16px;
        border-top: 3px solid var(--cream2-color);
    }
    /* Sub-title in many page */
    .title{
        margin: 0;
        font-size: var(--font-size-title); 
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-block-end: 18px;
    
    }
</style>