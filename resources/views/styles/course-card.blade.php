<style>
    .course-card{
        background-color: white;
        width: 300px;
        height: max-content;
        border-radius: 44px;
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
        border: none;
        padding:8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .course-card:hover{
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
    }

    .course-card-header{
        border-radius: 44px; 
        height: 55%;
        padding: 26px 19px;
    }

    .course-type-text-container{
        display: flex;
        height: 29px;
        padding: 10px;
        justify-content: start;
        align-items: center;
        border-radius: 10px;
        width: max-content;
    }

    .course-time-container{
        display: flex;
        height: 38px;
        padding: 10px;
        justify-content: center;
        align-items: center;
        border-radius: 100px;
        background: white;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.15);
        width: max-content;
    }

    .course-level-text-container{
        border-radius: 10px;
        display: flex;
        padding: 4px 20px;
        justify-content: center;
        align-items: center;
        font-size: 16px
    }

    .course-level-text{
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .course-card-bottom {
        padding: 17px 13px 20px 13px;
        gap: 10px
    }

    .tutor-image{
        border-radius: 37px;
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
        object-fit: cover;
    }

    .tutor-avatars{
        display: flex;
        align-items: center;
    }

    .tutor-avatars .tutor-image:not(:first-child) {
        margin-left: -12px; 
    }

    .overlay-arsip {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(224, 224, 224, 0.5);
        border-radius: 44px;
        z-index: 10;
        text-align: center;
    }

    .overlay-content {
        align-items: center;
        background-color: white;
        width: 80%;
        border-radius: 10px;
        padding: 2rem;
    }

    .icon-circle {
        background-color: #FFF0DF;
        width: 30px;
        height: 30px;
        border-radius: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        aspect-ratio: 1/1;
    }
</style>