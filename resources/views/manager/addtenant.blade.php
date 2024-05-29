<!-- Add Tenant Modal -->
<div class="modal fade" id="addTenantModal" tabindex="-1" role="dialog" aria-labelledby="addTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTenantModalLabel">Add New Tenant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Add form fields for tenant details -->
                    <div class="form-group">
                        <label for="tenant_name">Tenant Name</label>
                        <input type="text" class="form-control" id="tenant_name" name="tenant_name" required>
                    </div>
                    <div class="form-group">
                        <label for="tenant_email">Email</label>
                        <input type="email" class="form-control" id="tenant_email" name="tenant_email" required>
                    </div>
                    <!-- Add more fields as needed -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Tenant</button>
                </div>
            </form>
        </div>
    </div>
</div>
