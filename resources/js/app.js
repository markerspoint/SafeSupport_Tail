import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import Chart from 'chart.js/auto';
window.Chart = Chart;

import { Modal, Dropdown } from 'flowbite';
import { DataTable } from 'simple-datatables';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

console.log('app.js loaded with Flowbite and simple-datatables'); // Debug

window.Flowbite = { Modal, Dropdown };
window.DataTable = DataTable;
window.FullCalendar = { Calendar, dayGridPlugin, timeGridPlugin, interactionPlugin };

// Sidebar toggle (unchanged)
const sidebar = document.getElementById("sidebar");
const toggleBtn = document.getElementById("sidebarToggle");

function toggleSidebar(collapse) {
    sidebar.classList.toggle("w-20", collapse);
    sidebar.classList.toggle("w-64", !collapse);
    sidebar.querySelectorAll(".menu-text, .logo-text").forEach((el) => {
        el.classList.toggle("hidden", collapse);
    });
    sidebar.querySelectorAll("a").forEach((el) => {
        el.classList.toggle("justify-center", collapse);
    });
}

toggleBtn.addEventListener("click", () => {
    toggleSidebar(sidebar.classList.contains("w-64"));
});

const mediaQuery = window.matchMedia("(max-width: 640px)");
function handleScreenSize(e) {
    if (e.matches) {
        toggleSidebar(true);
    } else {
        toggleSidebar(false);
    }
}
handleScreenSize(mediaQuery);
mediaQuery.addEventListener("change", handleScreenSize);