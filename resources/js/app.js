import './bootstrap';
import './fade'
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'

// animate on scroll
import AOS from 'aos'
import 'aos/dist/aos.css'

// import '../css/app.css' 

AOS.init({
  duration: 500,
  easing: 'ease-in-out',
  once: false,     // re-animate when scrolling back up
  mirror: false,    // animate OUT when leaving viewport (upscroll)
  offset: 120,
})

// Recalculate once images/fonts are ready (important for absolutely-positioned layers)
window.addEventListener('load', () => AOS.refreshHard())


window.Alpine = Alpine;
Alpine.plugin(collapse)
Alpine.start();

import Chart from 'chart.js/auto';
window.Chart = Chart;

import { Modal, Dropdown } from 'flowbite';
import { DataTable } from 'simple-datatables';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

// console.log('app.js loaded with Flowbite and simple-datatables'); // Debug

window.Flowbite = { Modal, Dropdown };
window.DataTable = DataTable;
window.FullCalendar = { Calendar, dayGridPlugin, timeGridPlugin, interactionPlugin };

// Sidebar toggle (unchanged)
// const sidebar = document.getElementById("sidebar");
// const toggleBtn = document.getElementById("sidebarToggle");

// function toggleSidebar(collapse) {
//     sidebar.classList.toggle("w-20", collapse);
//     sidebar.classList.toggle("w-64", !collapse);
//     sidebar.querySelectorAll(".menu-text, .logo-text").forEach((el) => {
//         el.classList.toggle("hidden", collapse);
//     });
//     sidebar.querySelectorAll("a").forEach((el) => {
//         el.classList.toggle("justify-center", collapse);
//     });
// }

// toggleBtn.addEventListener("click", () => {
//     toggleSidebar(sidebar.classList.contains("w-64"));
// });

// const mediaQuery = window.matchMedia("(max-width: 640px)");
// function handleScreenSize(e) {
//     if (e.matches) {
//         toggleSidebar(true);
//     } else {
//         toggleSidebar(false);
//     }
// }
// handleScreenSize(mediaQuery);
// mediaQuery.addEventListener("change", handleScreenSize);


