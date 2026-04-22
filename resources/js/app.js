import "./bootstrap";

flatpickr("#start-date-input", {
    dateFormat: "d-m-Y", // Format saved to database
    altInput: true, // Hides original input and shows a human-friendly version
    altFormat: "F j, Y", // How user sees it (e.g., January 1, 2024)
    minDate: "today", // Prevents picking past dates
    disableMobile: true,
    mode: "range",
});
flatpickr("#bootstrap-flatpickr", {
    disableMobile: "true", // Force Flatpickr UI instead of native mobile picker
    altInput: true,
    altFormat: "F j, Y",
});

// Get saved theme or use system preference
const getPreferredTheme = () => {
    const storedTheme = localStorage.getItem("theme");
    if (storedTheme) {
        return storedTheme;
    }
    return window.matchMedia("(prefers-color-scheme: dark)").matches
        ? "dark"
        : "light";
};

const setTheme = (theme) => {
    document.documentElement.setAttribute("data-bs-theme", theme);
    localStorage.setItem("theme", theme);
};

// Set theme on page load
setTheme(getPreferredTheme());

// Toggle button
document.getElementById("theme-toggle")?.addEventListener("click", () => {
    const currentTheme = document.documentElement.getAttribute("data-bs-theme");
    const newTheme = currentTheme === "dark" ? "light" : "dark";
    setTheme(newTheme);
});

// Listen for system theme changes
window
    .matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", () => {
        if (!localStorage.getItem("theme")) {
            setTheme(getPreferredTheme());
        }
    });
