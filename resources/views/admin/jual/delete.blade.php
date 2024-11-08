<div class="modal fade" id="deleteJualModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Jual</h4>
            </div>
            <div class="modal-body">
                <form id="deleteJualForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <p>Are you sure you want to delete this Jual?</p>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger float-right"
                                    id="confirmDeleteBtn">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
