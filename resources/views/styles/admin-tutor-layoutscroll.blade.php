<style>
    html, body {
    height: 100%;
    margin: 0;
    overflow: hidden; /* biar scroll cuma di area card */
    }

    .admin-tutor-card-wrapper {
    display: flex;
    flex-direction: wrap;
    gap: 24px; 
    overflow-y: auto;
    white-space: nowrap;
    padding-bottom: 8px;
    scroll-behavior: smooth;
    /* overflow: visible; */
    }

  .admin-tutor-card-wrapper::-webkit-scrollbar {
    height: 8px;
    }

  .admin-tutor-card-wrapper::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
    }

  .container-content {
  display: flex;
  flex-direction: column;
  height: 100vh; /* layar penuh */
  overflow: hidden;
  padding: 24px;
  box-sizing: border-box;
  }

  
</style>