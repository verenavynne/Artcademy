<div class="profile-tab-container">
    <div class="tab-header">
        <button class="tab-link {{ $activeTab === $firstTab ? 'active' : '' }}" data-tab={{ $firstTab }}>{{ ucwords(str_replace('-', ' ', $firstTab)) }}</button>
        <button class="tab-link {{ $activeTab === $secondTab ? 'active' : '' }}" data-tab={{ $secondTab }}>{{ ucwords(str_replace('-', ' ', $secondTab)) }}</button>
    </div>
    <div class="tab-underline" data-tab={{ $activeTab }}></div>
</div>
<style>
    .profile-tab-container {
        position: relative;
        width: 100%;
        background-color: #fff8f0;
        border-bottom: 4px solid var(--cream2-color);
    }

    .tab-header {
        display: flex;
        position: relative;
    }

    .tab-link {
        background: none;
        border: none;
        width: 50%;
        font-size: 16px;
        font-weight: 500;
        color: #D0C4AF;
        padding: 12px 0;
        cursor: pointer;
        transition: all 0.25s ease;
        position: relative;
        font-size: 18px;
    }

    .tab-link.active {
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
        font-size: 18px;
    }

    .tab-underline {
        position: absolute;
        left: 0;
        height: 4px;
        width: 100px;
        background: var(--pink-gradient-color);
        border-radius: 2px;
        transition: all 0.3s ease;
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll(".tab-link");
        const underline = document.querySelector(".tab-underline");
        const activeTabName = "{{ $activeTab }}";

        function moveUnderline(activeTab) {
            const rect = activeTab.getBoundingClientRect();
            const containerRect = activeTab.parentElement.getBoundingClientRect();
            underline.style.width = rect.width + "px";
            underline.style.left = (rect.left - containerRect.left) + "px";
        }

        tabs.forEach(tab => {
            if (tab.getAttribute("data-tab") === activeTabName) {
                tab.classList.add("active");
            } else {
                tab.classList.remove("active");
            }
        });

        const realActive = document.querySelector(`.tab-link[data-tab="${activeTabName}"]`);
        if (realActive) moveUnderline(realActive);

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                moveUnderline(tab);
            });
        });

        window.addEventListener("resize", () => {
            const currentActive = document.querySelector(".tab-link.active");
            if (currentActive) moveUnderline(currentActive);
        });
    });

</script>
