<template id="material-template">
    <div class="materi-group shadow-sm rounded-4 p-3 mt-3 bg-white position-relative">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Materi __MATERIAL_INDEX_PLUS_ONE__</h6>
        </div>

        <input type="text" name="weeks[__WEEK_INDEX__][materials][__MATERIAL_INDEX__][materiName]" 
            placeholder="Nama Materi" class="form-control mb-2 rounded-pill custom-input" required> 

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
                <span>Artikel</span>
            </label>
            <label class="d-flex align-items-center gap-2 mb-0">
                <input type="radio" 
                       name="weeks[__WEEK_INDEX__][materials][__MATERIAL_INDEX__][type]" 
                       value="project" class="materi-type-radio" required>
                <span>Projek</span>
            </label>
        </div>

        <div class="materi-content mt-3"></div>
    </div>
</template>

<script src="https://cdn.tiny.cloud/1/2er11i2hdiuvi67l797urfnb807szvxxzzrsxu79b1qgecmu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('click', e => {
    if (e.target.classList.contains('materi-type-radio')) {
        const materiGroup = e.target.closest('.materi-group');
        const materiContent = materiGroup.querySelector('.materi-content');
        const type = e.target.value;
        const baseName = e.target.name.replace('[type]', '');

        let html = '';
        if (type === 'article') {
            html = `
                <input type="text" name="${baseName}[articleName]" placeholder="Masukkan Judul Artikel" class="form-control mb-2 rounded-pill custom-input">
                <textarea name="${baseName}[articleText]" placeholder="Masukkan Isi Artikel" class="form-control article-textarea"></textarea>
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
                <input type="text" name="${baseName}[vblName]" placeholder="Masukkan Judul Video" class="form-control mb-2 rounded-pill custom-input">
                <input type="text" name="${baseName}[vblDesc]" placeholder="Masukkan Deskripsi Video" class="form-control mb-2 rounded-pill custom-input">
                <div class="video-input d-flex align-items-center px-3 py-2 rounded-pill shadow-sm custom-input">
                        <iconify-icon icon="material-symbols:link-rounded"></iconify-icon>                    
                        <input type="text" 
                        name="${baseName}[vblUrl]" 
                        placeholder="Masukkan Link Video" 
                        class="form-control border-0 bg-transparent custom-input flex-grow-1 shadow-none"
                        style="box-shadow:none; outline:none;">
                </div>     
            `;
            materiContent.innerHTML = html; 
        }
    }
});
</script>