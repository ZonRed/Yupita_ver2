<div class="modal fade" id="createPromoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Promo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createPromoForm" name="createPromoForm" class="form-horizontal">
                    @csrf
                    <div class="mb-3">
                        <label for="tanggal_mulai_promo" class="form-label">Tanggal Mulai Promo<span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control mb-2" id="tanggal_mulai_promo_create"
                            name="tanggal_mulai_promo">
                        <span class="text-danger mb-2" id="tanggal_mulai_promo_create_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_akhir_promo" class="form-label">Tanggal Akhir Promo<span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control mb-2" id="tanggal_akhir_promo_create"
                            name="tanggal_akhir_promo">
                        <span class="text-danger mb-2" id="tanggal_akhir_promo_create_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="type_promo" class="form-label">Type Promo<span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" id="type_promo_create" name="type_promo">
                        <span class="text-danger mb-2" id="type_promo_create_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="info_promo" class="form-label">Info Promo<span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" id="info_promo_create" name="info_promo">
                        <span class="text-danger mb-2" id="info_promo_create_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="harga_promo" class="form-label">Harga Promo<span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control mb-2" id="harga_promo_create" name="harga_promo">
                        <span class="text-danger mb-2" id="harga_promo_create_error"></span>
                    </div>
                    <div class="modal-footer text-end">
                        <button type="submit" class="btn btn-primary" id="saveCreateBtn" value="create">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPromoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Promo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPromoForm" name="editPromoForm" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id_edit">
                    <div class="mb-3">
                        <label for="tanggal_mulai_promo" class="form-label">Tanggal Mulai Promo<span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control mb-2" id="tanggal_mulai_promo_edit"
                            name="tanggal_mulai_promo">
                        <span class="text-danger mb-2" id="tanggal_mulai_promo_edit_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_akhir_promo" class="form-label">Tanggal Akhir Promo<span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control mb-2" id="tanggal_akhir_promo_edit"
                            name="tanggal_akhir_promo">
                        <span class="text-danger mb-2" id="tanggal_akhir_promo_edit_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="type_promo" class="form-label">Type Promo<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" id="type_promo_edit" name="type_promo">
                        <span class="text-danger mb-2" id="type_promo_edit_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="info_promo" class="form-label">Info Promo<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" id="info_promo_edit" name="info_promo">
                        <span class="text-danger mb-2" id="info_promo_edit_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="harga_promo" class="form-label">Harga Promo<span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control mb-2" id="harga_promo_edit" name="harga_promo">
                        <span class="text-danger mb-2" id="harga_promo_edit_error"></span>
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
