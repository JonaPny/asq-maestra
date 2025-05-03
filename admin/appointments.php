<?php
$page_title = "Appointments - Salon Admin";
include 'components/header.php';
include 'components/sidebar.php';
include 'components/navbar.php';
?>

<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Pending Appointments</h2>
        <div>
            <select class="form-select form-select-sm me-2 d-inline-block w-auto" id="filter-status">
                <option value="all">All Status</option>
                <option value="pending" selected>Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <button class="btn btn-sm btn-outline-pink" id="refresh-btn">
                <i class="bi bi-arrow-clockwise me-1"></i> Refresh
            </button>
        </div>
    </div>

    <div class="alert alert-success d-none" id="status-message"></div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID no.</th>
                    <th>Name</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Service Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="appointments-table">
                <!-- Appointments will be loaded by JavaScript -->
            </tbody>
        </table>
    </div>
</div>

<?php include 'components/modals/appointment_modal.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sample appointment data
        const appointmentsData = [
            {
                id: 1,
                customer: {
                    name: 'Jennie Kim',
                    phone: '+639123456789',
                    image: 'https://via.placeholder.com/150'
                },
                date: '2023-02-15',
                time: '10:27',
                type: 'salon',
                status: 'pending',
                services: ['Hair Cut & Style', 'Hot Oil Treatment'],
                notes: 'First-time customer'
            },
            {
                id: 2,
                customer: {
                    name: 'Customer 2',
                    phone: '+639123456782',
                    image: 'https://via.placeholder.com/150'
                },
                date: '2023-02-15',
                time: '12:18',
                type: 'home',
                status: 'pending',
                services: ['Manicure & Pedicure'],
                notes: 'Address: Makati City'
            },
            {
                id: 3,
                customer: {
                    name: 'Customer 3',
                    phone: '+639123456783',
                    image: 'https://via.placeholder.com/150'
                },
                date: '2023-02-16',
                time: '15:45',
                type: 'salon',
                status: 'confirmed',
                services: ['Facial Treatment'],
                notes: ''
            }
        ];

        // Load appointments
        function loadAppointments(status = 'pending') {
            const tableBody = document.getElementById('appointments-table');
            tableBody.innerHTML = '';

            const filteredAppointments = status === 'all'
                ? appointmentsData
                : appointmentsData.filter(app => app.status === status);

            filteredAppointments.forEach(appointment => {
                const row = document.createElement('tr');

                // Format date for display
                const dateObj = new Date(appointment.date);
                const formattedDate = `${String(dateObj.getMonth() + 1).padStart(2, '0')}-${String(dateObj.getDate()).padStart(2, '0')}-${dateObj.getFullYear()}`;

                // Format time for display
                const [hours, minutes] = appointment.time.split(':');
                const formattedTime = `${hours}:${minutes} ${hours >= 12 ? 'PM' : 'AM'}`;

                // Create status badge
                let statusBadgeClass = 'bg-secondary';
                if (appointment.status === 'confirmed') statusBadgeClass = 'bg-primary';
                if (appointment.status === 'completed') statusBadgeClass = 'bg-success';
                if (appointment.status === 'cancelled') statusBadgeClass = 'bg-danger';

                row.innerHTML = `
                    <td>#${appointment.id}</td>
                    <td>${appointment.customer.name}</td>
                    <td>${formattedTime}</td>
                    <td>${formattedDate}</td>
                    <td>${appointment.type === 'salon' ? 'Salon Service' : 'Home Service'}</td>
                    <td><span class="badge ${statusBadgeClass}">${appointment.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-secondary rounded-circle view-appointment" 
                                data-appointment-id="${appointment.id}">
                            <i class="bi bi-eye"></i>
                        </button>
                    </td>
                `;

                tableBody.appendChild(row);
            });

            // Add event listeners to view buttons
            document.querySelectorAll('.view-appointment').forEach(button => {
                button.addEventListener('click', function () {
                    const appointmentId = this.getAttribute('data-appointment-id');
                    openAppointmentModal(appointmentId);
                });
            });
        }

        // Initial load
        loadAppointments('pending');

        // Filter change event
        document.getElementById('filter-status').addEventListener('change', function () {
            loadAppointments(this.value);
        });

        // Refresh button
        document.getElementById('refresh-btn').addEventListener('click', function () {
            const status = document.getElementById('filter-status').value;
            loadAppointments(status);
            showStatusMessage('Appointments refreshed');
        });

        // Appointment modal
        const appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'));

        function openAppointmentModal(appointmentId) {
            // Find appointment data
            const appointment = appointmentsData.find(app => app.id == appointmentId);
            if (!appointment) return;

            // Format date for display
            const dateObj = new Date(appointment.date);
            const formattedDate = `${String(dateObj.getMonth() + 1).padStart(2, '0')}-${String(dateObj.getDate()).padStart(2, '0')}-${dateObj.getFullYear()}`;

            // Format time for display
            const [hours, minutes] = appointment.time.split(':');
            const formattedTime = `${hours}:${minutes} ${hours >= 12 ? 'PM' : 'AM'}`;

            // Populate modal
            document.getElementById('customer-name').textContent = appointment.customer.name;
            document.getElementById('customer-contact').textContent = `Phone: ${appointment.customer.phone}`;
            document.getElementById('appointment-date').textContent = `Date: ${formattedDate}`;
            document.getElementById('appointment-time').textContent = `Time: ${formattedTime}`;
            document.getElementById('appointment-type').textContent = `Type: ${appointment.type === 'salon' ? 'Salon Service' : 'Home Service'}`;
            document.getElementById('appointment-notes').value = appointment.notes;
            document.getElementById('appointment-status').value = appointment.status;

            // Populate services
            const serviceList = document.getElementById('service-list');
            serviceList.innerHTML = '';
            appointment.services.forEach(service => {
                const li = document.createElement('li');
                li.innerHTML = `<i class="bi bi-circle-fill me-2 small"></i> ${service}`;
                serviceList.appendChild(li);
            });

            // Set data attribute for save button
            document.getElementById('save-appointment').setAttribute('data-appointment-id', appointmentId);
            document.getElementById('notify-customer').setAttribute('data-appointment-id', appointmentId);

            // Show modal
            appointmentModal.show();
        }

        // Save appointment changes
        document.getElementById('save-appointment').addEventListener('click', function () {
            const appointmentId = this.getAttribute('data-appointment-id');
            const appointment = appointmentsData.find(app => app.id == appointmentId);
            if (!appointment) return;

            // Update appointment data
            appointment.status = document.getElementById('appointment-status').value;
            appointment.notes = document.getElementById('appointment-notes').value;

            // Close modal
            appointmentModal.hide();

            // Reload appointments
            const status = document.getElementById('filter-status').value;
            loadAppointments(status);

            // Show success message
            showStatusMessage(`Appointment #${appointmentId} updated successfully`);
        });

        // Notify customer
        document.getElementById('notify-customer').addEventListener('click', function () {
            const appointmentId = this.getAttribute('data-appointment-id');
            const appointment = appointmentsData.find(app => app.id == appointmentId);
            if (!appointment) return;

            // Simulate sending notification
            showStatusMessage(`Notification sent to ${appointment.customer.name} via SMS`);
        });

        // Show status message
        function showStatusMessage(message) {
            const statusMessage = document.getElementById('status-message');
            statusMessage.textContent = message;
            statusMessage.classList.remove('d-none');

            // Hide after 3 seconds
            setTimeout(() => {
                statusMessage.classList.add('d-none');
            }, 3000);
        }
    });
</script>

<?php include 'components/footer.php'; ?>
