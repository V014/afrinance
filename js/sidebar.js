const sidebar = document.getElementById('sidebar');
const mobileToggleBtn = document.getElementById('mobileToggleBtn');
const desktopToggleBtn = document.getElementById('desktopToggleBtn');
const sidebarOverlay = document.getElementById('sidebarOverlay');

// Function to open mobile sidebar drawer
function openMobileSidebar() {
    sidebar.classList.add('mobile-open');
    sidebarOverlay.classList.add('active');
}

// Function to close mobile sidebar drawer
function closeMobileSidebar() {
    sidebar.classList.remove('mobile-open');
    sidebarOverlay.classList.remove('active');
}

// Event Listeners
mobileToggleBtn.addEventListener('click', openMobileSidebar);
desktopToggleBtn.addEventListener('click', closeMobileSidebar);
sidebarOverlay.addEventListener('click', closeMobileSidebar);