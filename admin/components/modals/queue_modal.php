<!-- Add to Queue Modal -->
<div class="modal fade" id="addQueueModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-pink text-white">
                <h5 class="modal-title">Add to Queue</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addQueueForm">
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerPhone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="customerPhone" required>
                    </div>
                    <div class="mb-3">
                        <label for="serviceType" class="form-label">Service</label>
                        <select class="form-select" id="serviceType" required>
                            <option value="">Select a service</option>
                            <option value="Hair Cut & Style">Hair Cut & Style</option>
                            <option value="Hair Color">Hair Color</option>
                            <option value="Manicure & Pedicure">Manicure & Pedicure</option>
                            <option value="Facial Treatment">Facial Treatment</option>
                            <option value="Hot Oil Treatment">Hot Oil Treatment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="queueDate" class="form-label">Date</label>
                        <select class="form-select" id="queueDate">
                            <option value="today">Today</option>
                            <option value="tomorrow">Tomorrow</option>
                        </select>
                    </div>
                    <div class="mb-3" id="timeField">
                        <label for="queueTime" class="form-label">Time (Tomorrow Only)</label>
                        <input type="time" class="form-control" id="queueTime">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-pink" id="saveQueue">Add to Queue</button>
            </div>
        </div>
    </div>
</div>
