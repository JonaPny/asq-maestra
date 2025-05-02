document.addEventListener('DOMContentLoaded', function() {
    // Update current time
    function updateTime() {
      const now = new Date();
      const timeElement = document.getElementById('current-time');
      timeElement.textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }
    
    // Update time initially and then every minute
    updateTime();
    setInterval(updateTime, 60000);
    
    // Toggle Edit Profile link
    const toggleEditProfileBtn = document.querySelector('.toggle-edit-profile');
    const editProfileLink = document.querySelector('.edit-profile-link');
    
    toggleEditProfileBtn.addEventListener('click', function() {
      editProfileLink.classList.toggle('d-none');
      const icon = this.querySelector('i');
      if (icon.classList.contains('bi-chevron-right')) {
        icon.classList.replace('bi-chevron-right', 'bi-chevron-down');
      } else {
        icon.classList.replace('bi-chevron-down', 'bi-chevron-right');
      }
    });
    
    // Show/Hide Edit Profile Form
    const editProfileBtn = document.querySelector('.edit-profile-btn');
    const editProfileForm = document.querySelector('.edit-profile-form');
    const mainContentTabs = document.querySelector('.main-content-tabs');
    const cancelEditBtn = document.querySelector('.cancel-edit');
    
    editProfileBtn.addEventListener('click', function(e) {
      e.preventDefault();
      editProfileForm.classList.remove('d-none');
      mainContentTabs.classList.add('d-none');
    });
    
    cancelEditBtn.addEventListener('click', function() {
      editProfileForm.classList.add('d-none');
      mainContentTabs.classList.remove('d-none');
    });
    
    // Save Profile Changes
    const saveProfileBtn = document.querySelector('.save-profile');
    
    saveProfileBtn.addEventListener('click', function() {
      // Here you would normally send the data to the server
      // For this example, we'll just show a success message and hide the form
      alert('Profile updated successfully!');
      editProfileForm.classList.add('d-none');
      mainContentTabs.classList.remove('d-none');
    });
    
    // Services Carousel
    const services = [
      {
        id: 1,
        name: "Hair Cut & Style",
        price: "₱350",
        image: "https://via.placeholder.com/300x200",
        description: "Professional haircut and styling by our expert stylists"
      },
      {
        id: 2,
        name: "Hair Color",
        price: "₱1,500",
        image: "https://via.placeholder.com/300x200",
        description: "Full hair coloring service with premium products"
      },
      {
        id: 3,
        name: "Manicure & Pedicure",
        price: "₱500",
        image: "https://via.placeholder.com/300x200",
        description: "Complete nail care for hands and feet"
      },
      {
        id: 4,
        name: "Facial Treatment",
        price: "₱800",
        image: "https://via.placeholder.com/300x200",
        description: "Rejuvenating facial treatment for glowing skin"
      },
      {
        id: 5,
        name: "Hair Spa",
        price: "₱1,200",
        image: "https://via.placeholder.com/300x200",
        description: "Deep conditioning treatment for healthy hair"
      }
    ];
    
    const servicesContainer = document.getElementById('servicesContainer');
    
    // Populate services
    services.forEach(service => {
      const serviceCard = document.createElement('div');
      serviceCard.className = 'col service-card';
      serviceCard.innerHTML = `
        <div class="card h-100">
          <img src="${service.image}" class="card-img-top" alt="${service.name}">
          <div class="card-body">
            <h5 class="card-title">${service.name}</h5>
            <p class="card-text small text-muted">${service.description}</p>
            <p class="card-text fw-bold text-pink fs-5">${service.price}</p>
          </div>
          <div class="card-footer bg-white d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm flex-grow-1 add-to-cart" data-id="${service.id}">
              <i class="bi bi-cart me-1"></i> Add to Cart
            </button>
            <button class="btn btn-pink btn-sm flex-grow-1">
              <i class="bi bi-calendar me-1"></i> Book Now
            </button>
          </div>
        </div>
      `;
      servicesContainer.appendChild(serviceCard);
    });
    
    // Carousel navigation
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const carousel = document.querySelector('.services-carousel .row');
    
    prevBtn.addEventListener('click', function() {
      carousel.scrollBy({ left: -300, behavior: 'smooth' });
    });
    
    nextBtn.addEventListener('click', function() {
      carousel.scrollBy({ left: 300, behavior: 'smooth' });
    });
    
    // Add to Cart functionality
    const addToCartBtns = document.querySelectorAll('.add-to-cart');
    const cartCountBadge = document.querySelector('.cart-count');
    let cartCount = 0;
    
    addToCartBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        cartCount++;
        cartCountBadge.textContent = cartCount;
        
        // Optional: Show a confirmation message
        const serviceId = this.getAttribute('data-id');
        const service = services.find(s => s.id == serviceId);
        alert(`${service.name} added to cart!`);
      });
    });
    
    // Dark Mode Toggle
    const darkModeSwitch = document.getElementById('darkModeSwitch');
    
    darkModeSwitch.addEventListener('change', function() {
      if (this.checked) {
        document.body.classList.add('bg-dark', 'text-white');
        document.querySelectorAll('.card, .card-header, .card-footer, .bg-white').forEach(el => {
          el.classList.add('bg-dark');
          el.classList.add('text-white');
          el.classList.add('border-secondary');
        });
      } else {
        document.body.classList.remove('bg-dark', 'text-white');
        document.querySelectorAll('.card, .card-header, .card-footer').forEach(el => {
          el.classList.remove('bg-dark');
          el.classList.remove('text-white');
          el.classList.remove('border-secondary');
        });
      }
    });
  });