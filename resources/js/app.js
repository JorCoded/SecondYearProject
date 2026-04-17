import './bootstrap';

flatpickr("#start-date-input", {
    
    dateFormat: "d-m-Y", // Format saved to database
    altInput: true,      // Hides original input and shows a human-friendly version
    altFormat: "F j, Y", // How user sees it (e.g., January 1, 2024)
    minDate: "today",     // Prevents picking past dates
    disableMobile: true,
    mode: "range",
});
flatpickr("#bootstrap-flatpickr", {
    disableMobile: "true", // Force Flatpickr UI instead of native mobile picker
    altInput: true,
    altFormat: "F j, Y",
  });