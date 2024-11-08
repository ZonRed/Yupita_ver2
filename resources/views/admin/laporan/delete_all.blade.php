<!-- resources/views/admin/laporan/delete_all.blade.php -->
<div class="modal fade" id="deleteAllLaporanModal" tabindex="-1" aria-labelledby="deleteAllLaporanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteAllLaporanModalLabel">Confirm Delete All</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              Are you sure you want to delete all Laporan?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form id="deleteAllLaporanForm" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-danger">Delete All</button>
              </form>
          </div>
      </div>
  </div>
</div>
