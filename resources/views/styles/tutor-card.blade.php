<style>
    .tutor-card-container{
        gap: 17px;
        justify-content: space-between;
        
    }

    .tutor-card{
        border-radius: 32px;
        background: white;
        min-width: 259px;
        padding-inline-end: 22px;
        padding-inline-start: 22px;
        padding-block-start: 22px;
        gap: 2px;
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .tutor-card:hover{
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
    }

    .tutor-profile-image{
        display: flex;
        object-fit: cover;
        object-position: center 20%;
        height: 122px;
        width: 122px;
    }

    .tutor-name{
        margin: 0;
        font-size: var(--font-size-small); 
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    .tutor-info{
        margin: 0;
        font-size: var(--font-size-mini);
        color: var(--dark-gray-color);

    }

    .tutor-info-container{
        width: 100%;
        padding-left: 12px;
        padding-bottom: 4px;
    }

</style>