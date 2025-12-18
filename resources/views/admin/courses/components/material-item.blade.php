<template id="material-template">
    <div class="materi-group shadow-sm rounded-4 p-3 mt-3 bg-white position-relative">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="material-header d-flex justify-content-between align-items-center cursor-pointer">
                <h6 class="fw-bold mb-0">Materi __MATERIAL_INDEX_PLUS_ONE__</h6>
                <iconify-icon icon="iconamoon:arrow-down-2-bold" class="toggle-icon"></iconify-icon>
            </div>

            <button type="button" class="btn p-0 text-danger remove-materi">
                <iconify-icon icon="fluent:delete-12-filled" class="toggle-icon"></iconify-icon>
            </button>
        </div>

        <div class="material-body">
            <div class="row">
                <div class="col-md-12">
                    <label class="fw-semibold">Durasi Materi (menit)</label>
                    <input type="number" name="weeks[__WEEK_INDEX__][materials][__MATERIAL_INDEX__][duration]" 
                        placeholder="Masukkan durasi (menit)" class="form-control mb-2 rounded-pill custom-input" required> 
                </div>
            </div>

            <div class="d-flex align-items-center gap-4">
                <label class="d-flex align-items-center gap-2 mb-0">
                    <input type="radio" 
                        name="weeks[__WEEK_INDEX__][materials][__MATERIAL_INDEX__][type]" 
                        value="video" class="materi-type-radio" required>
                    <span>Video</span>
                </label>
                <label class="d-flex align-items-center gap-2 mb-0">
                    <input type="radio" 
                        name="weeks[__WEEK_INDEX__][materials][__MATERIAL_INDEX__][type]" 
                        value="article" class="materi-type-radio" required>
                    <span>Materi Bacaan</span>
                </label>
            </div>

            <div class="materi-content mt-3"></div>
        </div>
    </div>
</template>

<script src="https://cdn.tiny.cloud/1/2er11i2hdiuvi67l797urfnb807szvxxzzrsxu79b1qgecmu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    const tools = @json($tools);

    // vbl / article
    document.addEventListener('click', e => {
        if (e.target.classList.contains('materi-type-radio')) {
            const materiGroup = e.target.closest('.materi-group');
            const materiContent = materiGroup.querySelector('.materi-content');
            const type = e.target.value;
            const baseName = e.target.name.replace('[type]', '');

            let html = '';
            if (type === 'article') {
                html = `
                    <input type="text" name="${baseName}[tblName]" placeholder="Masukkan Judul Materi Bacaan" class="form-control mb-2 rounded-pill custom-input">
                    <textarea name="${baseName}[tblText]" placeholder="Masukkan Isi Materi Bacaan" class="form-control article-textarea"></textarea>
                `;
                materiContent.innerHTML = html;

                tinymce.init({
                    selector: '.article-textarea',
                    menubar: false,
                    plugins: 'lists link code font fontsize textcolor',
                    toolbar: 'undo redo | bold italic underline | bullist numlist | forecolor | code',
                    height: 300
                });

            } else if (type === 'video') {
                html = `
                    <div class="row mb-3">
                        <div class="col-md mb-3 mb-md-0">
                            <label class="form-label fw-semibold">Judul Video</label>
                            <input type="text" 
                                name="${baseName}[vblName]" 
                                placeholder="Masukkan Judul Video" 
                                class="form-control rounded-pill custom-input">
                        </div>

                        <div class="col-md">
                            <label class="form-label fw-semibold">Link Video</label>
                            <div class="link-input-container">
                                <iconify-icon icon="material-symbols:link-rounded" class="me-2"></iconify-icon>                    
                                <input type="text" 
                                    name="${baseName}[vblUrl]" 
                                    placeholder="Masukkan Link Video" 
                                    class="form-control border-0 bg-transparent flex-grow-1 shadow-none"
                                    style="box-shadow:none; outline:none;">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi Video</label>
                        <textarea 
                            name="${baseName}[vblDesc]" 
                            placeholder="Masukkan deskripsi video..." 
                            rows="3"
                            class="form-control rounded-4 custom-input"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tools yang digunakan</label>
                        <div class="border rounded-4 p-3 custom-input">
                            ${tools.map(tool => `
                                <div class="form-check mb-2">
                                    <input 
                                        type="checkbox"
                                        name="${baseName}[tools][]"
                                        value="${tool.id}"
                                        class="form-check-input tool-checkbox"
                                        id="tool-${tool.id}">
                                    <label class="form-check-label" for="tool-${tool.id}">
                                        ${tool.toolsName}
                                    </label>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
                materiContent.innerHTML = html; 
            }
        }
    });

    // arrow icon
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
            const header = e.target.closest('.material-header');
            if (!header) return;

            const materiGroup = header.closest('.materi-group');
            if (!materiGroup) return;

            materiGroup.classList.toggle('active');

            const icon = header.querySelector('.toggle-icon');
            if (icon) {
            const isActive = materiGroup.classList.contains('active');
            icon.setAttribute('icon', isActive ? 'iconamoon:arrow-up-2-bold' : 'iconamoon:arrow-down-2-bold');
            }
        });
    });

    // remove materi
    document.addEventListener('click', e => {
        if (e.target.classList.contains('remove-materi') || e.target.closest('.remove-materi')) {
            const btn = e.target.closest('.remove-materi');
            const materiGroup = btn.closest('.materi-group');
            const parent = materiGroup.parentNode;

            parent.removeChild(materiGroup);
            updateAllIndexes();

            const materiGroups = parent.querySelectorAll('.materi-group');
            materiGroups.forEach((group, i) => {
                const title = group.querySelector('h6');
                title.textContent = `Materi ${i + 1}`;

                const inputs = group.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    input.name = input.name
                        .replace(/\[materials\]\[\d+\]/, `[materials][${i}]`)
                        .replace(/__MATERIAL_INDEX__/, i)
                        .replace(/__MATERIAL_INDEX_PLUS_ONE__/, i + 1);
                });
            });
        }
    });
</script>