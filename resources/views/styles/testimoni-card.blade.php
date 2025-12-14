<style>
    .testimoni-card-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        justify-items: center;
    }

    .testimoni-card{
        width: 368px;
        max-height: 245px;
        border-radius: 45px;
        background: white;
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
        padding-inline: 29px;
        padding-block: 36px;
    }

    .testimoni-header{
        gap: 15px;
        padding-block-end: 20px;
    }

    .testimoni-name p,
    .testimoni-review p,
    .testimoni-footer p {
        margin: 0;
    }

    .membantu-text{
        font-size: var(--font-size-tiny);
        color: var(--black-color);

    }

    .lihat-testimoni-text{
        font-size: var(--font-size-tiny); 
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .testimoni-button a {
        text-decoration: none; 
    }

    .testimoni-btn {
        display: flex;
        width: 181px;
        height: 56px;
        padding: 10px;
        justify-content: center;
        align-items: center;
        border-radius: 100px;
        position: relative;
        background: transparent;
        color: transparent;
        border: 2px solid transparent;
    }

    .testimoni-btn p{
        margin: 0; 
        font-size: var(--font-size-primary);
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;

    }

    .testimoni-btn::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 100px;
        padding: 2px;
        background: var(--pink-gradient-color);
        -webkit-mask:
            linear-gradient(#fff 0 0) content-box,
            linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
                mask-composite: exclude;
        pointer-events: none;
    }
    
</style>