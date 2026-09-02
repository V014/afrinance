const sidebar = document.getElementById('sidebar');
const mobileToggleBtn = document.getElementById('mobileToggleBtn');
const headerToggleBtn = document.getElementById('desktopToggleBtn');
const sidebarOverlay = document.getElementById('sidebarOverlay');

// --- MOBILE FUNCTIONS ---
function openMobileSidebar() {
  sidebar.classList.add('mobile-open');
  sidebarOverlay.classList.add('active');
}

function closeMobileSidebar() {
  sidebar.classList.remove('mobile-open');
  sidebarOverlay.classList.remove('active');
}

function toggleMobileSidebar() {
  if (sidebar.classList.contains('mobile-open')) {
    closeMobileSidebar();
  } else {
    openMobileSidebar();
  }
}

// --- EVENT LISTENERS ---

// Top-left floating button (Mobile only)
mobileToggleBtn.addEventListener('click', toggleMobileSidebar);

// Dark backdrop click (Mobile only)
sidebarOverlay.addEventListener('click', closeMobileSidebar);

// Header button (Strictly separated by screen width)
headerToggleBtn.addEventListener('click', () => {
  const isMobile = window.innerWidth <= 768;

  if (isMobile) {
    // Mobile action: ONLY close the overlay drawer
    closeMobileSidebar();
  } else {
    // Desktop action: ONLY toggle collapsed (icon-only) state
    sidebar.classList.toggle('collapsed');
  }
});

// Reset states if window is resized across breakpoint
window.addEventListener('resize', () => {
  if (window.innerWidth > 768) {
    closeMobileSidebar(); // Remove mobile drawer classes on desktop
  } else {
    sidebar.classList.remove('collapsed'); // Remove desktop collapse on mobile
  }
});