<div class="modal fade" id="createJadwalModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Jadwal</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createJadwalForm" name="createJadwalForm" class="form-horizontal">
                    @csrf
                    <div class="mb-3">
                        <label for="hari_jadwal" class="form-label">Hari Jadwal<span class="text-danger">*</span></label>
                        <select class="form-select mb-2" id="hari_jadwal_create" name="hari_jadwal" required>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                        <span class="text-danger mb-2" id="hari_jadwal_create_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="buka_jadwal" class="form-label">Buka Jadwal<span class="text-danger">*</span></label>
                        <input type="time" class="form-control mb-2" id="buka_jadwal_create" name="buka_jadwal">
                        <span class="text-danger mb-2" id="buka_jadwal_create_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="tutup_jadwal" class="form-label">Tutup Jadwal<span class="text-danger">*</span></label>
                        <input type="time" class="form-control mb-2" id="tutup_jadwal_create" name="tutup_jadwal">
                        <span class="text-danger mb-2" id="tutup_jadwal_create_error"></span>
                    </div>
                    <div class="modal-footer text-end">
                        <button type="submit" class="btn btn-primary" id="saveCreateBtn" value="create">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editJadwalModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Jadwal</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editJadwalForm" name="editJadwalForm" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id_edit">
                    <div class="mb-3">
                        <label for="hari_jadwal" class="form-label">Hari Jadwal<span class="text-danger">*</span></label>
                        <select class="form-select mb-2" id="hari_jadwal_edit" name="hari_jadwal" required>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                        <span class="text-danger mb-2" id="hari_jadwal_edit_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="buka_jadwal" class="form-label">Buka Jadwal<span class="text-danger">*</span></label>
                        <input type="time" class="form-control mb-2" id="buka_jadwal_edit" name="buka_jadwal">
                        <span class="text-danger mb-2" id="buka_jadwal_edit_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="tutup_jadwal" class="form-label">Tutup Jadwal<span class="text-danger">*</span></label>
                        <input type="time" class="form-control mb-2" id="tutup_jadwal_edit" name="tutup_jadwal">
                        <span class="text-danger mb-2" id="tutup_jadwal_edit_error"></span>
                    </div>
                    <div class="modal-footer text-end">
                        <button type="submit" class="btn btn-primary" id="saveEditBtn" value="edit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
