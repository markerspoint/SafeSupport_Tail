import "./bootstrap";
// import "../css/app.css";

import Alpine from "alpinejs";
window.Alpine = Alpine;

Alpine.start();

import Chart from "chart.js/auto";
window.Chart = Chart;



// Sidebar master layout toggle
const sidebar = document.getElementById("sidebar");
const toggleBtn = document.getElementById("sidebarToggle");

// Function to toggle sidebar state
function toggleSidebar(collapse) {
    sidebar.classList.toggle("w-20", collapse);
    sidebar.classList.toggle("w-64", !collapse);

    // Hide/show only the text
    sidebar.querySelectorAll(".menu-text, .logo-text").forEach((el) => {
        el.classList.toggle("hidden", collapse);
    });

    // Center icons when collapsed
    sidebar.querySelectorAll("a").forEach((el) => {
        el.classList.toggle("justify-center", collapse);
    });
}

// Manual toggle on button click
toggleBtn.addEventListener("click", () => {
    toggleSidebar(sidebar.classList.contains("w-64"));
});

// Automatic toggle based on screen size
const mediaQuery = window.matchMedia("(max-width: 640px)"); // Tailwind's 'sm' breakpoint

function handleScreenSize(e) {
    if (e.matches) {
        // Collapse sidebar on small screens
        toggleSidebar(true);
    } else {
        // Expand sidebar on larger screens
        toggleSidebar(false);
    }
}

// Run on initial load
handleScreenSize(mediaQuery);

// Listen for screen size changes
mediaQuery.addEventListener("change", handleScreenSize);
