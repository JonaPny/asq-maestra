<!-- Service Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-pink text-white">
                <h5 class="modal-title" id="serviceModalTitle">Add New Service</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="serviceForm">
                    <input type="hidden" id="serviceId">
                    <div class="mb-3">
                        <label for="serviceName" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="serviceName" required>
                    </div>
                    <div class="mb-3">
                        <label for="serviceDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="serviceDescription" rows="3"></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="servicePrice" class="form-label">Price (PHP)</label>
                            <input type="number" class="form-control" id="servicePrice" min="0" step="0.01"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="serviceDuration" class="form-label">Duration (minutes)</label>
                            <input type="number" class="form-control" id="serviceDuration" min="15" step="15"
                                required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="serviceCategory" class="form-label">Category</label>
                            <select class="form-select" id="serviceCategory" required>
                                <option value="hair">Hair</option>
                                <option value="makeup">Makeup</option>
                                <option value="spa">Spa</option>
                                <option value="nails">Nails</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="serviceStatus" class="form-label">Status</label>
                            <select class="form-select" id="serviceStatus" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-pink" id="saveService">Save Service</button>
            </div>
        </div>
    </div>
</div>
