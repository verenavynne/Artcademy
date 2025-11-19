<style>
    .form-label{
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);
        font-weight: 700;
        margin-block-end: 10px;
    }

    .form-select,
    .form-link-input,
    .form-control{
        background: var(--very-light-grey-color);
        min-height: 56px;
        padding: 10px 30px;
        align-items: center;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        border: none
    }

    .form-link-input{
        padding: 10px 30px 10px 50px; 
    }

    .form-upload-file{
        height: 56px;
        background: #FAFAFA;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        color: #D0C4AF
    }

    .input-icon {
        position: absolute;
        left: 20px; 
        top: 50%;
        transform: translateY(-50%);
        color: #5a5a5a;
        font-size: 20px;
        pointer-events: none; 
    }

    .placeholder-file,
    .form-control::placeholder,
    .form-link-input::placeholder {
        color: #D0C4AF;
    }

    .form-select:focus,
    .form-control:focus,
    .form-link-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(233, 45, 98, 0.25);
        outline: none;
    }
</style>