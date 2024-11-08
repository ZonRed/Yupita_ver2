<!-- resources/views/admin/jadwal/delete_all.blade.php -->
<div class="modal fade" id="deleteAllJadwalModal" tabindex="-1" aria-labelledby="deleteAllJadwalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAllJadwalModalLabel">Confirm Delete All</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete all Jadwal records?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteAllJadwalForm" method="POST" action="{{ route('admin.jadwal.deleteAll') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete All</button>
                </form>
            </div>
        </div>
    </div>
</div>
