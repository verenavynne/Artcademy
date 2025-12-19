<div class="modal fade" id="confirmActionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center flex-column text-center p-4"
             style="border-radius: 24px; box-shadow: 0 4px 8px var(--brown-shadow-color);">

            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"></button>

            <img id="confirmIcon" src="" class="mb-3" width="80" style="align-self: center">

            <h5 id="confirmTitle" class="fw-bold mb-2"
                style="font-size: var(--font-size-title)"></h5>

            <p id="confirmMessage" class="mb-4"
               style="margin:0; font-size: var(--font-size-primary); color: var(--dark-gray-color)">
            </p>

            <div class="d-flex justify-content-center gap-3 w-100">
                <button type="button"
                        class="btn rounded-pill pink-cream-btn px-4"
                        style="width: 50%"
                        data-bs-dismiss="modal">
                    <span class="text-pink-gradient">Kembali</span>
                </button>

                <form id="confirmForm" method="POST" style="width: 50%">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button id="confirmSubmitBtn"
                            type="submit"
                            class="btn w-100 rounded-pill text-white red-btn px-4 py-3">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const confirmModal = document.getElementById('confirmActionModal');

    confirmModal.addEventListener('show.bs.modal', event => {
        const trigger = event.relatedTarget;

        confirmModal.querySelector('#confirmTitle').textContent =
            trigger.getAttribute('data-title');

        confirmModal.querySelector('#confirmMessage').textContent =
            trigger.getAttribute('data-message');

        confirmModal.querySelector('#confirmIcon').src =
            trigger.getAttribute('data-icon');

        confirmModal.querySelector('#confirmSubmitBtn').textContent =
            trigger.getAttribute('data-button');

        confirmModal.querySelector('#confirmForm').action =
            trigger.getAttribute('data-action');
    });
</script>