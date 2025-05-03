<!-- Appointment Details Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-pink text-white">
                <h5 class="modal-title">Appointment Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="https://via.placeholder.com/150" alt="Customer"
                            class="rounded-circle customer-image mb-3">
                        <h5 id="customer-name" class="text-pink">Customer Name</h5>
                        <p id="customer-contact">Phone: +639123456789</p>
                    </div>
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6>Appointment Details</h6>
                                <p id="appointment-date">Date: </p>
                                <p id="appointment-time">Time: </p>
                                <p id="appointment-type">Type: </p>
                            </div>
                            <div class="col-md-6">
                                <h6>Services</h6>
                                <ul id="service-list" class="list-unstyled">
                                    <!-- Services will be loaded by JavaScript -->
                                </ul>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6>Notes</h6>
                            <textarea class="form-control" id="appointment-notes" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <h6>Status</h6>
                            <select class="form-select" id="appointment-status">
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="notify-customer">Notify Customer</button>
                <button type="button" class="btn btn-pink" id="save-appointment">Save Changes</button>
            </div>
        </div>
    </div>
</div>
