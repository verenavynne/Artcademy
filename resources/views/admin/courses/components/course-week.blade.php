<template id="week-template">
    <div class="week-group bg-white shadow-sm rounded-4 p-4 mb-4 position-relative" data-week="__WEEK_INDEX__"
        style="border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">

        <!-- Header Minggu -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="week-header d-flex justify-content-between align-items-center cursor-pointer">
                <h5 class="fw-bold mb-0 text-orange-gradient">Minggu __WEEK_INDEX_PLUS_ONE__</h5>
                <iconify-icon icon="iconamoon:arrow-down-2-bold" class="toggle-icon"></iconify-icon>
            </div>

            <button type="button" class="btn p-0 text-danger remove-week">
                <iconify-icon icon="fluent:delete-12-filled" class="toggle-icon"></iconify-icon>
            </button>
        </div>

        <!-- Judul dan Tutor -->
        <div class="week-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="fw-semibold">Judul</label>
                    <input type="text" name="weeks[__WEEK_INDEX__][weekName]" 
                        placeholder="Masukkan Judul" 
                        class="form-control rounded-pill px-3 py-2 custom-input" required>
                </div>
                <div class="col-md-6">
                    <label class="fw-semibold">Tutor</label>
                    <select name="weeks[__WEEK_INDEX__][tutorId]" 
                        class="form-select rounded-pill px-3 py-2 custom-input" required>
                        <option value="" disabled selected>Pilih tutor minggu ini</option>
                        @foreach($tutors as $tutor)
                            <option value="{{ $tutor->id }}">{{ $tutor->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            

            <!-- Container Materi -->
            <div class="materi-container"></div>

            <!-- Tombol Tambah Materi -->
            <div class="d-flex justify-content-end align-items-center mt-3">
                <button type="button" 
                    class="rounded-circle d-flex justify-content-center align-items-center fw-bold me-2 add-materi"
                    style="width:24px;height:24px; background: var(--yellow-gradient-color); border: none;"
                    data-week="__WEEK_INDEX__">+</button>
                    <span class="fw-bold">Materi</span>
            </div>
        </div>
    </div>
</template>

<script>
    // arrow icon
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
            const header = e.target.closest('.week-header');
            if (!header) return;

            const weekGroup = header.closest('.week-group');
            if (!weekGroup) return;

            weekGroup.classList.toggle('active');

            const icon = header.querySelector('.toggle-icon');
            if (icon) {
            const isActive = weekGroup.classList.contains('active');
            icon.setAttribute('icon', isActive ? 'iconamoon:arrow-up-2-bold' : 'iconamoon:arrow-down-2-bold');
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        // HAPUS WEEK
        document.addEventListener("click", function (e) {
            const btn = e.target.closest(".remove-week");
            if (!btn) return;

            const weekGroup = btn.closest(".week-group");
            if (!weekGroup) return;

            if (!confirm("Hapus minggu ini?")) return;

            weekGroup.remove();
            updateWeekIndexes();
            updateAllIndexes();
        });

        // FUNGSI UPDATE INDEX
        function updateWeekIndexes() {
            document.querySelectorAll(".week-group").forEach((week, i) => {
                week.setAttribute("data-week", i);

                const title = week.querySelector("h5");
                if (title) title.textContent = "Minggu " + (i + 1);

                week.querySelectorAll("input, select").forEach(el => {
                    if (el.name) {
                        el.name = el.name.replace(/weeks\[\d+\]/, `weeks[${i}]`);
                    }
                });

                const addMateriBtn = week.querySelector(".add-materi");
                if (addMateriBtn) addMateriBtn.setAttribute("data-week", i);
            });
        }

        document.getElementById("add-week").addEventListener("click", function () {
            const container = document.getElementById("weeks-container");
            
            const newIndex = document.querySelectorAll(".week-group").length;

            const newWeekHtml = generateWeekHtml(newIndex);

            container.insertAdjacentHTML("beforeend", newWeekHtml);
        });

        function generateWeekHtml(index) {
            let template = document.getElementById("week-template").innerHTML;

            template = template.replace(/__WEEK_INDEX__/g, index);
            template = template.replace(/__WEEK_INDEX_PLUS_ONE__/g, index + 1);

            return template;
        }
    });
</script>