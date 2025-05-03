document.addEventListener("DOMContentLoaded", () => {
  // Get sidebar element
  const sidebar = document.querySelector(".sidebar")

  // Get all admin icons that should toggle the sidebar
  const adminIcons = document.querySelectorAll(".admin-icon")

  // Function to toggle sidebar
  function toggleSidebar() {
    sidebar.classList.toggle("show")
    document.body.classList.toggle("sidebar-open")
    console.log("Sidebar toggled:", sidebar.classList.contains("show"))
  }

  // Function to check if we're in mobile view
  function isMobileView() {
    return window.innerWidth <= 768
  }

  // Add click event to all admin icons, but only allow toggling in mobile view
  adminIcons.forEach((icon) => {
    icon.addEventListener("click", (e) => {
      // Only toggle sidebar if in mobile view
      if (isMobileView()) {
        e.stopPropagation() // Prevent event bubbling
        toggleSidebar()
      }
    })
  })

  // Close sidebar when clicking outside
  document.addEventListener("click", (e) => {
    // If sidebar is open and click is outside sidebar and not on an admin icon
    if (
      sidebar.classList.contains("show") &&
      !sidebar.contains(e.target) &&
      !Array.from(adminIcons).some((icon) => icon.contains(e.target))
    ) {
      toggleSidebar()
    }
  })

  // Prevent clicks inside sidebar from closing it
  sidebar.addEventListener("click", (e) => {
    e.stopPropagation()
  })

  // Format date for display
  window.formatDate = (dateStr) => {
    const date = new Date(dateStr)
    return `${String(date.getMonth() + 1).padStart(2, "0")}-${String(date.getDate()).padStart(2, "0")}-${date.getFullYear()}`
  }

  // Format time for display
  window.formatTime = (timeStr) => {
    if (!timeStr) return ""

    const [hours, minutes] = timeStr.split(":")
    const hour = Number.parseInt(hours)
    const ampm = hour >= 12 ? "PM" : "AM"
    const hour12 = hour % 12 || 12

    return `${hour12}:${minutes} ${ampm}`
  }

  // Format currency
  window.formatCurrency = (amount) =>
    new Intl.NumberFormat("en-PH", {
      style: "currency",
      currency: "PHP",
    }).format(amount)
})
