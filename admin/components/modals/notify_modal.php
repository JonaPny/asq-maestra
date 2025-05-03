<!-- Notify Customer Modal -->
<div class="modal fade" id="notifyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-pink text-white">
                <h5 class="modal-title">Notify Customer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="notifyForm">
                    <input type="hidden" id="notifyQueueId">
                    <div class="mb-3">
                        <label for="notifyMessage" class="form-label">Message</label>
                        <textarea class="form-control" id="notifyMessage" rows="3" required></textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="sendSMS" checked>
                        <label class="form-check-label" for="sendSMS">
                            Send via SMS
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-pink" id="sendNotification">Send Notification</button>
            </div>
        </div>
    </div>
</div>
