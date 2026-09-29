(function () {
"use strict";

// ----- LIVE CLOCK -----
function updateClock() {
    const now = new Date();
    document.getElementById("liveTime").textContent =
    now.toLocaleTimeString("en-US", { hour12: false });
    document.getElementById("liveDay").textContent =
    now.toLocaleDateString("en-US", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    });
}
updateClock();
setInterval(updateClock, 1000);

// ----- SAMPLE DATA (admin accounts with 3 roles) -----
let admins = [
    {
    id: 1,
    name: "Alice Mwale",
    email: "alice@3maze.com",
    role: "cashier",
    status: "active",
    lastLogin: "2026-08-05 14:23",
    twoFA: true,
    },
    {
    id: 2,
    name: "Bob Phiri",
    email: "bob@3maze.com",
    role: "accountant",
    status: "active",
    lastLogin: "2026-08-04 09:10",
    twoFA: false,
    },
    {
    id: 3,
    name: "Carol Banda",
    email: "carol@3maze.com",
    role: "admin-manager",
    status: "inactive",
    lastLogin: "2026-07-28 11:45",
    twoFA: false,
    },
    {
    id: 4,
    name: "David Zulu",
    email: "david@3maze.com",
    role: "cashier",
    status: "active",
    lastLogin: "2026-08-06 08:00",
    twoFA: true,
    },
    {
    id: 5,
    name: "Ester Tembo",
    email: "ester@3maze.com",
    role: "accountant",
    status: "active",
    lastLogin: "2026-08-03 16:20",
    twoFA: false,
    },
    {
    id: 6,
    name: "Frank Kamanga",
    email: "frank@3maze.com",
    role: "admin-manager",
    status: "inactive",
    lastLogin: "2026-07-25 13:00",
    twoFA: false,
    },
    {
    id: 7,
    name: "Grace Banda",
    email: "grace@3maze.com",
    role: "cashier",
    status: "active",
    lastLogin: "2026-08-06 07:30",
    twoFA: true,
    },
    {
    id: 8,
    name: "Henry Moyo",
    email: "henry@3maze.com",
    role: "accountant",
    status: "active",
    lastLogin: "2026-08-02 10:00",
    twoFA: false,
    },
    {
    id: 9,
    name: "Ivy Nkhoma",
    email: "ivy@3maze.com",
    role: "admin-manager",
    status: "active",
    lastLogin: "2026-08-05 12:15",
    twoFA: true,
    },
];

// ----- STATE -----
let currentPage = 1;
let rowsPerPage = 5;
let filteredData = [];

// ----- HELPERS -----
function todayStr() {
    return new Date().toISOString().slice(0, 10);
}

// ----- POPULATE STATS -----
function updateStats() {
    const active = admins.filter((a) => a.status === "active").length;
    const inactive = admins.filter((a) => a.status === "inactive").length;
    // document.getElementById("statActive").textContent = active;
    // document.getElementById("statInactive").textContent = inactive;
    // document.getElementById("statTotalAdmins").textContent = admins.length;

    const cashier = admins.filter((a) => a.role === "cashier").length;
    const accountant = admins.filter(
    (a) => a.role === "accountant",
    ).length;
    const adminManager = admins.filter(
    (a) => a.role === "admin-manager",
    ).length;
    // document.getElementById("statRoleCashier").textContent = cashier;
    // document.getElementById("statRoleAccountant").textContent = accountant;
    // document.getElementById("statRoleAdminManager").textContent = adminManager;

    const now = new Date();
    const sevenDays = new Date(now);
    sevenDays.setDate(now.getDate() - 7);
    const thirtyDays = new Date(now);
    thirtyDays.setDate(now.getDate() - 30);
    const recent7 = admins.filter((a) => {
    const d = new Date(a.lastLogin.split(" ")[0]);
    return d >= sevenDays;
    }).length;
    const recent30 = admins.filter((a) => {
    const d = new Date(a.lastLogin.split(" ")[0]);
    return d >= thirtyDays;
    }).length;
    // document.getElementById("statRecent7").textContent = recent7;
    // document.getElementById("statRecent30").textContent = recent30;

    /*
    const sorted = [...admins].sort(
    (a, b) => new Date(b.lastLogin) - new Date(a.lastLogin),
    );
    document.getElementById("statLastLogin").textContent = sorted.length
    ? sorted[0].lastLogin
    : "--";
    */
    document.getElementById("stat2fa").textContent = admins.filter(
    (a) => a.twoFA,
    ).length;
    document.getElementById("statPending").textContent = admins.filter(
    (a) => a.status === "inactive",
    ).length;
    document.getElementById("statLocked").textContent = 0;
}

// ----- RENDER TABLE -----
function renderTable() {
    const nameFilter = document
    .getElementById("filterName")
    .value.toLowerCase()
    .trim();
    const emailFilter = document
    .getElementById("filterEmail")
    .value.toLowerCase()
    .trim();
    const roleFilter = document.getElementById("filterRole").value;
    const statusFilter = document.getElementById("filterStatus").value;

    let filtered = admins.filter((a) => {
    const matchName = a.name.toLowerCase().includes(nameFilter);
    const matchEmail = a.email.toLowerCase().includes(emailFilter);
    const matchRole = roleFilter === "all" || a.role === roleFilter;
    const matchStatus =
        statusFilter === "all" || a.status === statusFilter;
    return matchName && matchEmail && matchRole && matchStatus;
    });

    filtered = [...filtered].sort(
    (a, b) => new Date(b.lastLogin) - new Date(a.lastLogin),
    );
    filteredData = filtered;

    const tbody = document.getElementById("tableBody");
    const empty = document.getElementById("emptyState");

    if (filteredData.length === 0) {
    tbody.innerHTML = "";
    empty.style.display = "block";
    document.getElementById("prevPage").disabled = true;
    document.getElementById("nextPage").disabled = true;
    document.getElementById("pageInfo").textContent = "Page 0 of 0";
    return;
    }
    empty.style.display = "none";

    const totalPages =
    rowsPerPage === "all"
        ? 1
        : Math.ceil(filteredData.length / rowsPerPage);
    if (currentPage > totalPages) currentPage = totalPages;
    if (currentPage < 1) currentPage = 1;

    const startIndex =
    rowsPerPage === "all" ? 0 : (currentPage - 1) * rowsPerPage;
    const endIndex =
    rowsPerPage === "all"
        ? filteredData.length
        : Math.min(startIndex + rowsPerPage, filteredData.length);
    const pageData = filteredData.slice(startIndex, endIndex);

    document.getElementById("prevPage").disabled =
    currentPage === 1 || totalPages === 0;
    document.getElementById("nextPage").disabled =
    currentPage === totalPages || totalPages === 0;
    document.getElementById("pageInfo").textContent =
    `Page ${currentPage} of ${totalPages}`;

    const roleLabels = {
    cashier: "Cashier",
    accountant: "Accountant",
    "admin-manager": "Admin Manager",
    };
    const roleClasses = {
    cashier: "role-cashier",
    accountant: "role-accountant",
    "admin-manager": "role-admin-manager",
    };
    const statusLabels = { active: "Active", inactive: "Inactive" };
    const statusClasses = {
    active: "status-active",
    inactive: "status-inactive",
    };

    let html = "";
    pageData.forEach((a, idx) => {
    const rowNum = startIndex + idx + 1;
    html += `<tr>
    <td style="text-align:center;opacity:0.5;">${rowNum}</td>
    <td><strong>${a.name}</strong></td>
    <td>${a.email}</td>
    <td><span class="role-badge ${roleClasses[a.role]}">${roleLabels[a.role]}</span></td>
    <td><span class="status-badge ${statusClasses[a.status]}">${statusLabels[a.status]}</span></td>
    <td>${a.lastLogin}</td>
    <td>${a.twoFA ? '<i class="fas fa-check-circle" style="color:var(--accent-color)"></i>' : '<i class="fas fa-times-circle" style="color:var(--expenses)"></i>'}</td>
</tr>`;
    });
    tbody.innerHTML = html;
}

// ----- PAGINATION -----
function goToPage(page) {
    const totalPages =
    rowsPerPage === "all"
        ? 1
        : Math.ceil(filteredData.length / rowsPerPage);
    if (page < 1 || page > totalPages || totalPages === 0) return;
    currentPage = page;
    renderTable();
}
function prevPage() {
    if (currentPage > 1) goToPage(currentPage - 1);
}
function nextPage() {
    const totalPages =
    rowsPerPage === "all"
        ? 1
        : Math.ceil(filteredData.length / rowsPerPage);
    if (currentPage < totalPages) goToPage(currentPage + 1);
}

// ----- EVENT LISTENERS -----
document
    .getElementById("filterName")
    .addEventListener("input", function () {
    currentPage = 1;
    renderTable();
    });
document
    .getElementById("filterEmail")
    .addEventListener("input", function () {
    currentPage = 1;
    renderTable();
    });
document
    .getElementById("filterRole")
    .addEventListener("change", function () {
    currentPage = 1;
    renderTable();
    });
document
    .getElementById("filterStatus")
    .addEventListener("change", function () {
    currentPage = 1;
    renderTable();
    });

document
    .getElementById("clearFilters")
    .addEventListener("click", function () {
    document.getElementById("filterName").value = "";
    document.getElementById("filterEmail").value = "";
    document.getElementById("filterRole").value = "all";
    document.getElementById("filterStatus").value = "all";
    currentPage = 1;
    renderTable();
    });

document
    .getElementById("rowsPerPage")
    .addEventListener("change", function () {
    rowsPerPage = this.value === "all" ? "all" : parseInt(this.value);
    currentPage = 1;
    renderTable();
    });
document.getElementById("prevPage").addEventListener("click", prevPage);
document.getElementById("nextPage").addEventListener("click", nextPage);

// ----- INIT -----
updateStats();
renderTable();
document.getElementById("sidebarUserName").textContent =
    "Admin Manager";
document.getElementById("dashUserName").textContent = "System";
})();