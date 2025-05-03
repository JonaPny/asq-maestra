<?php
$page_title = "Services Manager - Salon Admin";
include 'components/header.php';
include 'components/sidebar.php';
include 'components/navbar.php';
?>

<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Services Manager</h2>
        <div>
            <button class="btn btn-sm btn-outline-pink" id="add-service-btn">
                <i class="bi bi-plus-circle me-1"></i> Add New Service
            </button>
        </div>
    </div>

    <div class="alert alert-success d-none" id="service-message"></div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-pink text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Service Categories</h5>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-outline-light active category-filter"
                            data-category="all">All</button>
                        <button type="button" class="btn btn-sm btn-outline-light category-filter"
                            data-category="hair">Hair</button>
                        <button type="button" class="btn btn-sm btn-outline-light category-filter"
                            data-category="makeup">Makeup</button>
                        <button type="button" class="btn btn-sm btn-outline-light category-filter"
                            data-category="spa">Spa</button>
                        <button type="button" class="btn btn-sm btn-outline-light category-filter"
                            data-category="nails">Nails</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Service Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="services-table">
                                <!-- Services will be loaded by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'components/modals/service_modal.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sample services data
        let servicesData = [
            {
                id: 1,
                name: 'Hair Cut & Style',
                description: 'Professional haircut and styling by our expert stylists',
                price: 350.00,
                duration: 60,
                category: 'hair',
                status: 1
            },
            {
                id: 2,
                name: 'Hair Color',
                description: 'Full hair coloring service with premium products',
                price: 1500.00,
                duration: 120,
                category: 'hair',
                status: 1
            },
            {
                id: 3,
                name: 'Manicure & Pedicure',
                description: 'Complete nail care for hands and feet',
                price: 500.00,
                duration: 90,
                category: 'nails',
                status: 1
            },
            {
                id: 4,
                name: 'Facial Treatment',
                description: 'Rejuvenating facial treatment for glowing skin',
                price: 800.00,
                duration: 60,
                category: 'spa',
                status: 1
            },
            {
                id: 5,
                name: 'Hot Oil Treatment',
                description: 'Deep conditioning treatment for healthy hair',
                price: 600.00,
                duration: 45,
                category: 'hair',
                status: 1
            },
            {
                id: 6,
                name: 'Makeup Application',
                description: 'Professional makeup application for any occasion',
                price: 1200.00,
                duration: 60,
                category: 'makeup',
                status: 1
            },
            {
                id: 7,
                name: 'Bridal Package',
                description: 'Complete hair and makeup package for brides',
                price: 5000.00,
                duration: 180,
                category: 'makeup',
                status: 0
            }
        ];

        // Load services
        function loadServices(category = 'all') {
            const servicesTable = document.getElementById('services-table');
            servicesTable.innerHTML = '';

            const filteredServices = category === 'all'
                ? servicesData
                : servicesData.filter(service => service.category === category);

            filteredServices.forEach(service => {
                const row = document.createElement('tr');

                // Format price
                const formattedPrice = new Intl.NumberFormat('en-PH', {
                    style: 'currency',
                    currency: 'PHP'
                }).format(service.price);

                // Create status badge
                const statusBadge = service.status === 1
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-secondary">Inactive</span>';

                row.innerHTML = `
                    <td>#${service.id}</td>
                    <td>${service.name}</td>
                    <td>${service.category.charAt(0).toUpperCase() + service.category.slice(1)}</td>
                    <td>${formattedPrice}</td>
                    <td>${service.duration} mins</td>
                    <td>${statusBadge}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-secondary me-1 edit-service" data-service-id="${service.id}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger delete-service" data-service-id="${service.id}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                `;

                servicesTable.appendChild(row);
            });

            // Add event listeners
            document.querySelectorAll('.edit-service').forEach(button => {
                button.addEventListener('click', function () {
                    const serviceId = this.getAttribute('data-service-id');
                    openServiceModal(serviceId);
                });
            });

            document.querySelectorAll('.delete-service').forEach(button => {
                button.addEventListener('click', function () {
                    const serviceId = this.getAttribute('data-service-id');
                    deleteService(serviceId);
                });
            });
        }

        // Initial load
        loadServices();

        // Category filter
        document.querySelectorAll('.category-filter').forEach(button => {
            button.addEventListener('click', function () {
                // Remove active class from all buttons
                document.querySelectorAll('.category-filter').forEach(btn => {
                    btn.classList.remove('active');
                });

                // Add active class to clicked button
                this.classList.add('active');

                // Load services for selected category
                const category = this.getAttribute('data-category');
                loadServices(category);
            });
        });

        // Service modal
        const serviceModal = new bootstrap.Modal(document.getElementById('serviceModal'));

        // Add service button
        document.getElementById('add-service-btn').addEventListener('click', function () {
            openServiceModal();
        });

        function openServiceModal(serviceId = null) {
            // Reset form
            document.getElementById('serviceForm').reset();

            // Set modal title
            document.getElementById('serviceModalTitle').textContent = serviceId ? 'Edit Service' : 'Add New Service';

            if (serviceId) {
                // Find service
                const service = servicesData.find(s => s.id == serviceId);
                if (!service) return;

                // Populate form
                document.getElementById('serviceId').value = service.id;
                document.getElementById('serviceName').value = service.name;
                document.getElementById('serviceDescription').value = service.description;
                document.getElementById('servicePrice').value = service.price;
                document.getElementById('serviceDuration').value = service.duration;
                document.getElementById('serviceCategory').value = service.category;
                document.getElementById('serviceStatus').value = service.status;
            } else {
                // Clear service ID
                document.getElementById('serviceId').value = '';
            }

            // Show modal
            serviceModal.show();
        }

        // Save service
        document.getElementById('saveService').addEventListener('click', function () {
            // Get form values
            const serviceId = document.getElementById('serviceId').value;
            const serviceName = document.getElementById('serviceName').value;
            const serviceDescription = document.getElementById('serviceDescription').value;
            const servicePrice = parseFloat(document.getElementById('servicePrice').value);
            const serviceDuration = parseInt(document.getElementById('serviceDuration').value);
            const serviceCategory = document.getElementById('serviceCategory').value;
            const serviceStatus = parseInt(document.getElementById('serviceStatus').value);

            // Validate form
            if (!serviceName || isNaN(servicePrice) || isNaN(serviceDuration)) {
                alert('Please fill in all required fields');
                return;
            }

            if (serviceId) {
                // Update existing service
                const serviceIndex = servicesData.findIndex(s => s.id == serviceId);
                if (serviceIndex === -1) return;

                servicesData[serviceIndex] = {
                    id: parseInt(serviceId),
                    name: serviceName,
                    description: serviceDescription,
                    price: servicePrice,
                    duration: serviceDuration,
                    category: serviceCategory,
                    status: serviceStatus
                };

                // Show success message
                showServiceMessage(`Service "${serviceName}" updated successfully`);
            } else {
                // Add new service
                const newService = {
                    id: servicesData.length > 0 ? Math.max(...servicesData.map(s => s.id)) + 1 : 1,
                    name: serviceName,
                    description: serviceDescription,
                    price: servicePrice,
                    duration: serviceDuration,
                    category: serviceCategory,
                    status: serviceStatus
                };

                servicesData.push(newService);

                // Show success message
                showServiceMessage(`Service "${serviceName}" added successfully`);
            }

            // Close modal
            serviceModal.hide();

            // Reload services
            const activeCategory = document.querySelector('.category-filter.active').getAttribute('data-category');
            loadServices(activeCategory);
        });

        // Delete service
        function deleteService(serviceId) {
            // Find service
            const service = servicesData.find(s => s.id == serviceId);
            if (!service) return;

            // Confirm deletion
            if (!confirm(`Are you sure you want to delete "${service.name}"?`)) {
                return;
            }

            // Remove service
            servicesData = servicesData.filter(s => s.id != serviceId);

            // Reload services
            const activeCategory = document.querySelector('.category-filter.active').getAttribute('data-category');
            loadServices(activeCategory);

            // Show success message
            showServiceMessage(`Service "${service.name}" deleted successfully`);
        }

        // Show service message
        function showServiceMessage(message) {
            const serviceMessage = document.getElementById('service-message');
            serviceMessage.textContent = message;
            serviceMessage.classList.remove('d-none');

            // Hide after 3 seconds
            setTimeout(() => {
                serviceMessage.classList.add('d-none');
            }, 3000);
        }
    });
</script>

<?php include 'components/footer.php'; ?>
