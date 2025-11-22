<style>
  html, body {
    height: 100%;
    margin: 0;
    /*overflow: hidden;  biar scroll cuma di area card */
    }

  .admin-tutor-card-wrapper {
    display: flex;
    flex-direction: row;
    gap: 16px;
    padding: 8px;
    justify-content: flex-start;
    align-items: flex-start;
    width: 100%;
    height: auto;
    overflow-y: hidden;
    scrollbar-width: thin;
  }

  .admin-tutor-card-wrapper::-webkit-scrollbar {
    height: 8px;
  }

  .admin-tutor-card-wrapper::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
  }

  .container-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    width: calc(100% - 300px);
    height: 100%; /* layar penuh */
    padding-right: 0px;
    padding-left: 28px;
    padding-top: 0;
    padding-bottom: 0;
    box-sizing: border-box;
  /* overflow: visible; */
  }

  
</style>