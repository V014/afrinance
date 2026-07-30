const sidebar = document.getElementById('sidebar');
const mobileToggleBtn = document.getElementById('mobileToggleBtn');
const desktopToggleBtn = document.getElementById('desktopToggleBtn');
const sidebarOverlay = document.getElementById('sidebarOverlay');

// Function to open mobile sidebar drawer
function openMobileSidebar() {
    sidebar.classList.add('mobile-open');
    sidebarOverlay.classList.add('active');
    // Hide the toggle button when the sidebar is open
    mobileToggleBtn.style.display = 'none';
}

// Function to close mobile sidebar drawer
function closeMobileSidebar() {
    sidebar.classList.remove('mobile-open');
    sidebarOverlay.classList.remove('active');
    // Show the toggle button when the sidebar is closed
    mobileToggleBtn.style.display = 'block';
}

// Event Listeners
mobileToggleBtn.addEventListener('click', openMobileSidebar);
desktopToggleBtn.addEventListener('click', closeMobileSidebar);
sidebarOverlay.addEventListener('click', closeMobileSidebar);