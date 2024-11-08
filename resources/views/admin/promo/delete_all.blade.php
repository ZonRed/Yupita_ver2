<!-- resources/views/admin/promo/delete_all.blade.php -->
<div class="modal fade" id="deleteAllPromoModal" tabindex="-1" aria-labelledby="deleteAllPromoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteAllPromoModalLabel">Confirm Delete All</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              Are you sure you want to delete all Promo?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form id="deleteAllPromoForm" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-danger">Delete All</button>
              </form>
          </div>
      </div>
  </div>
</div>
