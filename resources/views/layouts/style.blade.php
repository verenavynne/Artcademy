<style>
    :root{
        --cream-color: rgba(255, 249, 239, 1);
        --cream2-color: rgba(249, 238, 219, 1);
        --orange-color: rgba(251, 168, 52, 1);
        --brown-color: rgba(86, 54, 0, 1);
        --brown-shadow-color: rgba(67, 39, 0, 0.2);
        --dark-gray-color: rgba(71, 71, 71, 1);
        --pink-color: rgba(233, 45, 98, 1);
        --very-light-grey-color: rgba(250, 250, 250, 1);

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

    /* icons */
    .icon-google {
        display: inline-block;
        width: 48px;
        height: 48px;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 48 48'%3E%3Cpath fill='%23ffc107' d='M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917'/%3E%3Cpath fill='%23ff3d00' d='m6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691'/%3E%3Cpath fill='%234caf50' d='M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.9 11.9 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44'/%3E%3Cpath fill='%231976d2' d='M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917'/%3E%3C/svg%3E");
    }

    .icon-password-hide {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cg fill='none'%3E%3Cpath d='m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z'/%3E%3Cpath fill='%23000' d='M3.05 9.31a1 1 0 1 1 1.914-.577c2.086 6.986 11.982 6.987 14.07.004a1 1 0 1 1 1.918.57a9.5 9.5 0 0 1-1.813 3.417L20.414 14A1 1 0 0 1 19 15.414l-1.311-1.311a9.1 9.1 0 0 1-2.32 1.269l.357 1.335a1 1 0 1 1-1.931.518l-.364-1.357c-.947.14-1.915.14-2.862 0l-.364 1.357a1 1 0 1 1-1.931-.518l.357-1.335a9.1 9.1 0 0 1-2.32-1.27l-1.31 1.312A1 1 0 0 1 3.585 14l1.275-1.275c-.784-.936-1.41-2.074-1.812-3.414Z'/%3E%3C/g%3E%3C/svg%3E");
    }

    .icon-password-show {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cg fill='none'%3E%3Cpath d='m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z'/%3E%3Cpath fill='%23000' d='M12 4c2.787 0 5.263 1.257 7.026 2.813c.885.781 1.614 1.658 2.128 2.531c.505.857.846 1.786.846 2.656s-.34 1.799-.846 2.656c-.514.873-1.243 1.75-2.128 2.531C17.263 18.743 14.786 20 12 20c-2.787 0-5.263-1.257-7.026-2.813c-.885-.781-1.614-1.658-2.128-2.531C2.34 13.799 2 12.87 2 12s.34-1.799.846-2.656c.514-.873 1.243-1.75 2.128-2.531C6.737 5.257 9.214 4 12 4m0 2c-2.184 0-4.208.993-5.702 2.312c-.744.656-1.332 1.373-1.729 2.047C4.163 11.049 4 11.62 4 12s.163.951.569 1.641c.397.674.985 1.39 1.729 2.047C7.792 17.007 9.816 18 12 18s4.208-.993 5.702-2.312c.744-.657 1.332-1.373 1.729-2.047c.406-.69.569-1.261.569-1.641s-.163-.951-.569-1.641c-.397-.674-.985-1.39-1.729-2.047C16.208 6.993 14.184 6 12 6m0 3q.132 0 .261.011a2 2 0 0 0 2.728 2.728A3 3 0 1 1 12 9'/%3E%3C/g%3E%3C/svg%3E");
    }

    .icon-password-hide, .icon-password-show {
        display: inline-block;
        width: 24px;
        height: 24px;
        background-repeat: no-repeat;
        background-size: 100% 100%;
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