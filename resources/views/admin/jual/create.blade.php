<div class="modal fade" id="createJualModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Jual</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createJualForm" name="createJualForm" class="form-horizontal">
                    @csrf
                    <div class="mb-3">
                        <label for="tanggal_jual" class="form-label">Tanggal Jual<span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control mb-2" id="tanggal_jual_create" name="tanggal_jual">
                        <span class="text-danger mb-2" id="tanggal_jual_create_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="type_jual" class="form-label">Type Jual<span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" id="type_jual_create" name="type_jual">
                        <span class="text-danger mb-2" id="type_jual_create_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual<span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control mb-2" id="harga_jual_create"
                            name="harga_jual">
                        <span class="text-danger mb-2" id="harga_jual_create_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="stock_jual" class="form-label">Stock Jual<span class="text-danger">*</span></label>
                        <select class="form-select mb-2" id="stock_jual_create" name="stock_jual" required>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                        <span class="text-danger mb-2" id="stock_jual_create_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_jual" class="form-label">Jumlah Jual<span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control mb-2" id="jumlah_jual_create" name="jumlah_jual">
                        <span class="text-danger mb-2" id="jumlah_jual_create_error"></span>
                    </div>
                    <div class="modal-footer text-end">
                        <button type="submit" class="btn btn-primary" id="saveCreateBtn" value="create">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editJualModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Jual</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editJualForm" name="editJualForm" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id_edit">
                    <div class="mb-3">
                        <label for="tanggal_jual" class="form-label">Tanggal Jual<span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control mb-2" id="tanggal_jual_edit" name="tanggal_jual">
                        <span class="text-danger mb-2" id="tanggal_jual_edit_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="type_jual" class="form-label">Type Jual<span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" id="type_jual_edit" name="type_jual">
                        <span class="text-danger mb-2" id="type_jual_edit_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual<span
                                class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control mb-2" id="harga_jual_edit"
                            name="harga_jual">
                        <span class="text-danger mb-2" id="harga_jual_edit_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="stock_jual" class="form-label">Stock Jual<span class="text-danger">*</span></label>
                        <select class="form-select mb-2" id="stock_jual_edit" name="stock_jual" required>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                        <span class="text-danger mb-2" id="stock_jual_edit_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_jual" class="form-label">Jumlah Jual<span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control mb-2" id="jumlah_jual_edit" name="jumlah_jual">
                        <span class="text-danger mb-2" id="jumlah_jual_edit_error"></span>
                    </div>
                    <div class="modal-footer text-end">
                        <button type="submit" class="btn btn-primary" id="saveEditBtn" value="edit">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
