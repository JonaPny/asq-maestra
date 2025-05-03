<!-- Day Edit Modal -->
<div class="modal fade" id="dayEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-pink text-white">
                <h5 class="modal-title">Edit Day Status</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dayEditForm">
                    <input type="hidden" id="selected-date">
                    <div class="mb-3">
                        <label class="form-label">Day Status</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="dayStatus" id="statusNormal"
                                value="normal" checked>
                            <label class="form-check-label" for="statusNormal">
                                Normal (Available)
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="dayStatus" id="statusFull"
                                value="full">
                            <label class="form-check-label" for="statusFull">
                                Full Schedule
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="dayStatus" id="statusBlocked"
                                value="blocked">
                            <label class="form-check-label" for="statusBlocked">
                                Blocked (Unavailable)
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dayNotes" class="form-label">Notes</label>
                        <textarea class="form-control" id="dayNotes" rows="3"
                            placeholder="Add notes about this day (optional)"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-pink" id="saveDayStatus">Save Changes</button>
            </div>
        </div>
    </div>
</div>
