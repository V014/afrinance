<?php
session_start();

// Block access if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"
    />
    <title>Afrinance</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="css/dashboard.css">
  </head>
  <body>
    <div class="app-layout">
      <!-- SIDEBAR (Admin Manager) -->
      <aside class="sidebar" id="sidebar">
        <div class="brand">
          <div class="avatar">
            <img
              src="1774245015_69c0d497743f0.jpeg"
              alt="User avatar"
              onerror="
                this.parentElement.innerHTML =
                  '<i class=\'fas fa-user\' style=\'font-size:1.5rem;color:#1a1a1a;\'></i>'
              "
            />
          </div>
          <div class="user-info">
            <span id="sidebarUserName">Admin Manager</span>
            <br /><small>System Admin</small>
          </div>
        </div>

        <!-- <div class="nav-section">Management</div> -->
        <nav class="nav-links">
          <a href="dashboard.php" data-page="dashboard" class="active-link"
            ><i class="fas fa-th-large"></i> Dashboard</a
          >
          <a href="manage.php" data-page="admins"
            ><i class="fas fa-user-cog"></i> Manage Admins</a
          >
          <a href="roles.php" data-page="roles"
            ><i class="fas fa-user-tag"></i> Manage Roles</a
          >
          <a href="audit.php" data-page="audit"
            ><i class="fas fa-clipboard-list"></i> Audit Log</a
          >
        </nav>

        <!-- <div class="nav-section">System</div>
        <nav class="nav-links">
          <a href="#" data-page="settings"
            ><i class="fas fa-cog"></i> Settings</a
          >
          <a href="#" data-page="backup"
            ><i class="fas fa-database"></i> Backup</a
          >
        </nav> -->

        <div class="logout-wrapper">
          <a href="login.php" data-page="logout"
            ><i class="fas fa-sign-out-alt"></i> Logout</a
          >
        </div>
      </aside>

      <!-- MAIN CONTENT -->
      <main class="main-content">
        <div class="content-wrapper">
          <!-- WELCOME CARD -->
          <div class="panel-card welcome-card">
            <div class="welcome-left">
              <h2>
                <i
                  class="fas fa-user-shield"
                  style="color: var(--admin-purple)"
                ></i>
                Admin Manager · <span id="dashUserName">System</span>
              </h2>
            </div>
            <div class="welcome-center">
              <strong>Time:</strong> <span id="liveTime">--:--:--</span>
            </div>
            <div class="welcome-right">
              <strong>Day:</strong> <span id="liveDay">----</span>
            </div>
          </div>

          <!-- STATS CARDS -->
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-users-cog"></i></span>
                <span class="stat-label">Total Admins</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Active</span>
                <span class="detail-value" id="statActive">0</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Inactive</span>
                <span class="detail-value" id="statInactive">0</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Total</span>
                <span class="detail-value" id="statTotalAdmins">0</span>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-user-tag"></i></span>
                <span class="stat-label">Roles</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Cashiers</span>
                <span class="detail-value" id="statRoleCashier">0</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Accountants</span>
                <span class="detail-value" id="statRoleAccountant">0</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Admin Managers</span>
                <span class="detail-value" id="statRoleAdminManager">0</span>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-clock"></i></span>
                <span class="stat-label">Recent Activity</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Last 7 days</span>
                <span class="detail-value" id="statRecent7">0</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Last 30 days</span>
                <span class="detail-value" id="statRecent30">0</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Last login</span>
                <span class="detail-value" id="statLastLogin">--</span>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-shield-alt"></i></span>
                <span class="stat-label">Security</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">2FA Enabled</span>
                <span class="detail-value" id="stat2fa">0</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Pending invites</span>
                <span class="detail-value" id="statPending">0</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Locked accounts</span>
                <span class="detail-value" id="statLocked">0</span>
              </div>
            </div>
          </div>

          <!-- FILTERS (from table columns) -->
          <div class="filters-container">
            <div class="filter-group">
              <label for="filterName">Name</label>
              <input type="text" id="filterName" placeholder="Search name..." />
            </div>
            <div class="filter-group">
              <label for="filterEmail">Email</label>
              <input
                type="text"
                id="filterEmail"
                placeholder="Search email..."
              />
            </div>
            <div class="filter-group">
              <label for="filterRole">Role</label>
              <select id="filterRole">
                <option value="all">All Roles</option>
                <option value="cashier">Cashier</option>
                <option value="accountant">Accountant</option>
                <option value="admin-manager">Admin Manager</option>
              </select>
            </div>
            <div class="filter-group">
              <label for="filterStatus">Status</label>
              <select id="filterStatus">
                <option value="all">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
            <button class="clear-filters-btn" id="clearFilters">
              <i class="fas fa-times"></i> Clear Filters
            </button>
          </div>

          <!-- TABLE -->
          <div class="table-wrapper">
            <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Last Login</th>
                  <th>2FA</th>
                </tr>
              </thead>
              <tbody id="tableBody"></tbody>
            </table>
            <div id="emptyState" class="empty-state" style="display: none">
              No admin accounts found
            </div>
          </div>

          <!-- PAGINATION -->
          <div class="pagination-container">
            <div class="rows-per-page">
              <label for="rowsPerPage">Rows per page:</label>
              <select id="rowsPerPage">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="all">All</option>
              </select>
            </div>
            <div class="pagination-controls">
              <button id="prevPage" disabled>
                <i class="fas fa-chevron-left"></i> Previous
              </button>
              <span class="page-info" id="pageInfo">Page 1 of 1</span>
              <button id="nextPage" disabled>
                Next <i class="fas fa-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>
      </main>
    </div>

    <script>
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
          document.getElementById("statActive").textContent = active;
          document.getElementById("statInactive").textContent = inactive;
          document.getElementById("statTotalAdmins").textContent =
            admins.length;

          const cashier = admins.filter((a) => a.role === "cashier").length;
          const accountant = admins.filter(
            (a) => a.role === "accountant",
          ).length;
          const adminManager = admins.filter(
            (a) => a.role === "admin-manager",
          ).length;
          document.getElementById("statRoleCashier").textContent = cashier;
          document.getElementById("statRoleAccountant").textContent =
            accountant;
          document.getElementById("statRoleAdminManager").textContent =
            adminManager;

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
          document.getElementById("statRecent7").textContent = recent7;
          document.getElementById("statRecent30").textContent = recent30;

          const sorted = [...admins].sort(
            (a, b) => new Date(b.lastLogin) - new Date(a.lastLogin),
          );
          document.getElementById("statLastLogin").textContent = sorted.length
            ? sorted[0].lastLogin
            : "--";
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
    </script>
  </body>
</html>
