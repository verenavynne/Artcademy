    <div class="d-flex align-items-center justify-content-between mb-3">
        <!-- Dropdown Pagination -->
        <form action="{{ route('admin.courses.index') }}" method="GET" class="d-flex align-items-center">
            <select name="perPage" 
                    class="form-select form-select-sm rounded-pill  border-0 me-2 p-3" 
                    onchange="this.form.submit()" 
                    style="width: 65px; font-size: 18px; box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);">
                <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
            </select>
            <span style="font-size: 18px">Data Pengguna</span>
        </form>

        <!-- Search -->
        <form action="{{ route('admin.courses.index') }}" method="GET" class="d-flex align-items-center">
            <div class="d-flex align-items-center rounded-pill px-3  custom-input-2"
                style="width: 250px; background-color: #fff; box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);">
                
                <input type="text" 
                    name="search"
                    value="{{ request('search') }}" 
                    placeholder="Cari kursus..."
                    class="form-control border-0 bg-transparent flex-grow-1 ps-2"
                    style="outline: none; box-shadow: none; font-size: 18px;">
                    
                <button type="submit" 
                        class="btn border-0 bg-transparent p-0 d-flex align-items-center justify-content-center">
                    <iconify-icon icon="icon-park-outline:search" width="20" height="20"></iconify-icon>
                </button>
            </div>
        </form>
    </div>