<style>
    .plyr.plyr--full-ui.plyr--video{
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
        border-radius: 40px;
        width: 100%;
    }

    .plyr--full-ui.plyr--video .plyr__control--overlaid{
        border-radius: 50%;
        border: none;
        background: var(--yellow-gradient-color);
        cursor: pointer;
        color: var(--black-color);
        transition: transform 0.3s ease;
        box-shadow: 0 8.714px 17.429px 0 rgba(67, 39, 0, 0.20);

    }

    .plyr__controls__item.plyr__progress__container{
        .plyr__progress{
            --plyr-range-fill-background: var(--yellow-gradient-color);
        }
    }

    .plyr__controls__item.plyr__volume{
        > input[type=range]{
            --plyr-range-fill-background: var(--yellow-gradient-color);
        }
    }


    .plyr__controls__item.plyr__control:focus,
    .plyr__controls__item.plyr__control:active {
        background-color: none !important;
        box-shadow: none !important; 
        outline: none !important;
    }

    .plyr.plyr--menu-open .plyr__controls__item.plyr__control {
        background-color: transparent;
    
    }
</style>