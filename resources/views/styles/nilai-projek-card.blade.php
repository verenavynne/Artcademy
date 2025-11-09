<style>
    .project-card {
    width: 236px;
    padding: 12px;
    border-radius: 40px;
    min-height: auto;
    background: var(--white, #FFF);
    box-shadow: 0 2px 10px 0 rgba(67, 39, 0, 0.20);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: transform 0.2s ease;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 10px;
    }

    .project-card:hover {
    transform: translateY(-4px);
    }

    .project-image {
    width: 100%;
    height: 156px;
    background: repeating-conic-gradient(#ccc 0% 25%, transparent 0% 50%) 50% / 40px 40px;
    opacity: 0.3;
    border-radius: 40px;
    }

    .project-content {
        display: flex;
        width: 100%;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 0 8px;
    }

    .project-title {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        align-self: stretch;
        overflow: hidden;
        color: var(--Black, #1B1B1B);
        text-overflow: ellipsis;
        margin: 0;
        font-size: 14px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }

    .project-user {
    display: flex;
    align-items: center;
    gap: 10px;
    align-self: stretch;
    }

    .user-photo {
    width: 25px;
    height: 25px;
    border-radius: 100%;
    object-fit: cover;
    }

    .user-name {
    font-size: 14px;
    color: #333;
    font-weight: 500;
    margin: 0;
    }

    .project-deadline {
    display: flex;
    align-items: center;
    gap: 6px;
    align-self: stretch;
    }

    .deadline-label {
    color: var(--Dark-gray, #474747);
    font-family: Afacad;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    margin: 0;
    width: 100%;
    }

    .deadline-date {
    display: flex;
    width: 107px;
    padding: 4px 10px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    border-radius: 10px;
    background: #FFF0DF;
    margin: 0;
    width: 100%;
    }

    .deadline-date-text{
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    background: var(--Orange-Gradient, linear-gradient(0deg, #F69000 0%, #F8BA0C 100%));
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin: 0;

    }

.yellow-gradient-btn{
    width: 100%;
}
</style>