<style>
.table-data {
  width: 100%;
  overflow-y: auto;
  position: relative;
}

.table-wrapper {
  width: 100%;
  display: flex;
  flex-direction: column;
  overflow-x: hidden; 

}

.table-body-scroll {
  max-height: calc(63vh - 180px);
  overflow-y: auto;
}

/* Scrollbar */
.table-body-scroll::-webkit-scrollbar {
  width: 8px;
}
.table-body-scroll::-webkit-scrollbar-thumb {
  background: #d2c7b5;
  border-radius: 8px;
}
.table-body-scroll::-webkit-scrollbar-thumb:hover {
  background: #bfa97c;
}

/* === Table Styling === */
.table {
  width: 100%;
  border-collapse: collapse;
  table-layout: auto;
}

/* Table Head */
.table thead th {
  background: #FFF;
  color: #1B1B1B;
  font-weight: 700;
  font-size: 18px;
  padding: 12px 16px;
  text-align: left;
  width: auto;
  border-bottom: 3px solid #F9EEDB;
  white-space: nowrap;
  vertical-align: middle;
}

.table thead::after {
  position: absolute;
  transform: translateX(-50%);
  width: 100%;
  height: 3px;
  background-color: #F9EEDB;
  border-radius: 4px;
}

/* Table Body */
.table tbody td {
  padding: 12px 16px;
  text-align: left;
  color: #333;
  font-size: 18px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  vertical-align: middle;
}

.textpanjang{
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

/* === Column Widths === */
.table th:nth-child(1){
   width: 6%; 
}


.table td:nth-child(1) {
  width: 6%; 
} 

.table th:nth-child(2){
  width: auto;
}


.table td:nth-child(2) {
  width: auto;
}

.table th:nth-child(3){
  width: auto;
}

.table td:nth-child(3) {
  width: auto;
}

.table th:nth-child(4){
   width: auto;
}

.table td:nth-child(4) {
  width: auto;
}

.table th:nth-child(5){
  width: auto;
}


.table td:nth-child(5) {
  width: auto;
}

.table th:nth-child(6),
.table td:nth-child(6) {
  width: auto;
}

.table th:nth-child(7){
  width: auto;
}

.table td:nth-child(7) {
  width: auto;
}

/* === Badge Status === */

.badge-status {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  padding: 4px 20px;
  border-radius: 10px;
  font-weight: 700;
  font-size: 18px;
  min-width: 90px;
}

/* Warna latar */
.badge-status.success {
  background: #E9FAEF;
}

.badge-status.pending {
  background: #FFF0DF;
}

.badge-status.danger {
  background: #FFECEC;
}

/* Gradient text masing-masing status */
.gradient-text {
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-weight: 700;
}

.gradient-text.success {
  background-image: var(--green-gradient-color);
}

.gradient-text.pending {
  background-image: var(--orange-gradient-color);
}

.gradient-text.danger {
  background-image: var(--red-gradient-color);
}


/* === Action Icons === */
.table td:last-child {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 10px;
  
}


/* === Responsive Adjustment === */
@media (max-width: 992px) {
  .table th,
  .table td {
    font-size: 14px;
    padding: 8px 12px;
  }
}

.view-icon{
  width: 27px;
  height: 24px;
  aspect-ratio: 9/8;
  color: var(--dark-gray-color);
}

.aman-icon{
  width: 24px;
  height: 24px;
  aspect-ratio: 1/1;
  color: #3EC973;
}

.hapus-icon{
  width: 24px;
  height: 24px;
  aspect-ratio: 1/1;
  color: #FF4646;
}
</style>