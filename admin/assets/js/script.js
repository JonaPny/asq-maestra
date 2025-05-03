document.addEventListener("DOMContentLoaded", () => {
  // Mobile sidebar toggle
  const toggleSidebarBtn = document.querySelector(".navbar-toggler")
  const sidebar = document.querySelector(".sidebar")

  if (toggleSidebarBtn && sidebar) {
    toggleSidebarBtn.addEventListener("click", () => {
      sidebar.classList.toggle("show")
    })
  }

  // Close sidebar when clicking outside on mobile
  document.addEventListener("click", (event) => {
    if (
      sidebar &&
      sidebar.classList.contains("show") &&
      !sidebar.contains(event.target) &&
      toggleSidebarBtn &&
      !toggleSidebarBtn.contains(event.target)
    ) {
      sidebar.classList.remove("show")
    }
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
