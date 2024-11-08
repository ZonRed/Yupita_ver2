<!-- create -->
<div class="modal fade" id="createItemModal" tabindex="-1" aria-labelledby="createItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createItemModalLabel">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createItemForm">
                    <div class="mb-3">
                        <label for="createItemName" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="createItemName" required>
                    </div>
                    <div class="mb-3">
                        <label for="createItemPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="createItemPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="createItemQuantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="createItemQuantity" value="0" min="0" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewItem">Save Item</button>
            </div>
        </div>
    </div>
</div>


<!-- edit -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
                    <input type="hidden" id="editItemIndex">
                    <div class="mb-3">
                        <label for="editItemName" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="editItemName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editItemPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="editItemPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="editItemQuantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="editItemQuantity" value="0" min="0" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateItem">Update Item</button>
            </div>
        </div>
    </div>
</div>
