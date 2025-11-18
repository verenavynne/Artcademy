<style>
    .zoom-card-container{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        justify-items: center;
        gap: 17px;

    }
    .zoom-card{
        background-color: white;
        width: 259px;
        min-height: 377px;
        border-radius: 40px;
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
        border: none;
        padding:8px;
    }

    .zoom-card-header{
        border-radius: 40px; 
        height: 55%;
        padding: 19px 14px;
        padding-block-end: 0px;
    }

    .zoom-text-container{
        display: flex;
        height: 29px;
        padding: 10px;
        justify-content: start;
        align-items: center;
        border-radius: 10px;
        width: max-content;
    }

    .zoom-record-icon{
        width: 5px;
        height: 5px;
        background-color: #EB0000;
        border-radius: 100%;
    }

    .zoom-date-container{
        display: flex;
        height: 38px;
        padding: 8px;
        justify-content: center;
        align-items: center;
        border-radius: 100px;
        background: white;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.15);
        width: max-content;
    }

    .zoom-tutor-profile{
        display: flex;
        object-fit: cover;
        object-position: center 20%;
        height: 80px;
        width: 70px;
        overflow: hidden;
    }

    .zoom-tutor-image{
        display: flex;
        background-color: #e0e0e0;;
        object-fit: cover;
        object-position: center 30%;
        border-radius: 37px;
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
    }

    .zoom-title{
        margin:0; 
        font-size: var(--font-size-tiny); 
        font-weight: 700
    }

    .zoom-level-text-container{
        border-radius: 10px;
        display: flex;
        padding: 4px 20px;
        justify-content: center;
        align-items: center;
        font-size: 16px
    }

    .zoom-level-text{
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .zoom-card-bottom {
        padding-inline: 8px;
        padding-block-end: 8px;
        padding-block-start: 12px;
        gap: 12px
    }
</style>