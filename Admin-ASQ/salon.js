document.addEventListener('DOMContentLoaded', function () {
    const toggleIcon = document.getElementById('toggle-icon');
    const sidebar = document.querySelector('.sidebar');

    // Toggle sidebar only on small screens
    if (toggleIcon && sidebar) {
        toggleIcon.addEventListener('click', function (event) {
            if (window.innerWidth <= 991) {
                event.stopPropagation();
                sidebar.classList.toggle('show');
            }
        });
    }

    // Close sidebar when clicking outside (small screens only)
    document.addEventListener('click', function (event) {
        if (
            window.innerWidth <= 991 &&
            sidebar &&
            sidebar.classList.contains('show') &&
            !sidebar.contains(event.target) &&
            !toggleIcon.contains(event.target)
        ) {
            sidebar.classList.remove('show');
        }
        
    });

    
    // Format date for display
    window.formatDate = function(dateStr) {
        const date = new Date(dateStr);
        return `${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}-${date.getFullYear()}`;
    };
    
    // Format time for display
    window.formatTime = function(timeStr) {
        if (!timeStr) return '';
        
        const [hours, minutes] = timeStr.split(':');
        const hour = parseInt(hours);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const hour12 = hour % 12 || 12;
        
        return `${hour12}:${minutes} ${ampm}`;
    };
    
    // Format currency
    window.formatCurrency = function(amount) {
        return new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP'
        }).format(amount);
    };
});