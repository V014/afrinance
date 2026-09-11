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
    <link rel="stylesheet" href="css/manage.css">
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
          <a href="dashboard.php" data-page="dashboard"
            ><i class="fas fa-th-large"></i> Dashboard</a
          >
          <a href="manage.php" data-page="admins" class="active-link"
            ><i class="fas fa-user-cog"></i> Admin Accounts</a
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
          <!-- BACK BUTTON -->
          <!-- <div class="back-bar">
            <a href="dashboard2.php" class="back-btn"
              ><i class="fas fa-arrow-left"></i> Back to Dashboard</a
            >
          </div> -->

          <!-- WELCOME CARD (no time/date) -->
          <div class="panel-card welcome-card">
            <div class="welcome-left">
              <h2>
                <i
                  class="fas fa-users-cog"
                  style="color: var(--admin-purple)"
                ></i>
                Manage Admins
              </h2>
            </div>
          </div>

          <!-- ACTION BAR (Create only) -->
          <div class="action-bar">
            <a href="create.php" class="action-btn primary-btn">
              <i class="fas fa-user-plus"></i> Create New Account
            </a>
          </div>

          <!-- STATS MINI -->
          <div class="stats-mini">
            <div class="stat-mini">
              <div class="stat-number" id="miniTotal">0</div>
              <div class="stat-label">Total Admins</div>
            </div>
            <div class="stat-mini">
              <div class="stat-number" id="miniActive">0</div>
              <div class="stat-label">Active</div>
            </div>
            <div class="stat-mini">
              <div class="stat-number" id="miniCashier">0</div>
              <div class="stat-label">Cashiers</div>
            </div>
            <div class="stat-mini">
              <div class="stat-number" id="miniAdminManager">0</div>
              <div class="stat-label">Admin Managers</div>
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
                  <th>Actions</th>
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

    <!-- DELETE MODAL -->
    <div class="modal-overlay" id="deleteModal">
      <div class="modal-box">
        <div class="modal-icon">
          <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h3>Confirm Deletion</h3>
        <p class="modal-sub">
          Are you sure you want to delete
          <strong id="deleteUserName">User</strong>? <br />This action cannot be
          undone.
        </p>
        <div class="form-group">
          <label for="deletePassword">Enter your password to confirm</label>
          <input
            type="password"
            id="deletePassword"
            placeholder="Enter your password..."
          />
          <div class="modal-error" id="deleteError">
            Incorrect password. Please try again.
          </div>
        </div>
        <div class="modal-actions">
          <button class="btn-cancel-delete" id="cancelDeleteBtn">Cancel</button>
          <button class="btn-confirm-delete" id="confirmDeleteBtn">
            <i class="fas fa-trash-alt"></i> Delete
          </button>
        </div>
      </div>
    </div>

    <script>
      (function () {
        "use strict";

        // ----- SAMPLE DATA (3 roles) -----
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
        let deleteTargetId = null;

        // ----- UPDATE MINI STATS -----
        function updateMiniStats() {
          document.getElementById("miniTotal").textContent = admins.length;
          document.getElementById("miniActive").textContent = admins.filter(
            (a) => a.status === "active",
          ).length;
          document.getElementById("miniCashier").textContent = admins.filter(
            (a) => a.role === "cashier",
          ).length;
          document.getElementById("miniAdminManager").textContent =
            admins.filter((a) => a.role === "admin-manager").length;
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
            html += `<tr data-id="${a.id}">
          <td style="text-align:center;opacity:0.5;">${rowNum}</td>
          <td><strong>${a.name}</strong></td>
          <td>${a.email}</td>
          <td><span class="role-badge ${roleClasses[a.role]}">${roleLabels[a.role]}</span></td>
          <td><span class="status-badge ${statusClasses[a.status]}">${statusLabels[a.status]}</span></td>
          <td>${a.lastLogin}</td>
          <td>${a.twoFA ? '<i class="fas fa-check-circle" style="color:var(--accent-color)"></i>' : '<i class="fas fa-times-circle" style="color:var(--expenses)"></i>'}</td>
          <td class="action-icons">
            <a href="edit.html?id=${a.id}" class="edit" data-id="${a.id}" title="Edit"><i class="fas fa-edit"></i></a>
            <a href="#" class="delete" data-id="${a.id}" title="Delete"><i class="fas fa-trash-alt"></i></a>
          </td>
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

        // ----- DELETE MODAL LOGIC -----
        const modal = document.getElementById("deleteModal");
        const deletePasswordInput = document.getElementById("deletePassword");
        const deleteError = document.getElementById("deleteError");
        const deleteUserName = document.getElementById("deleteUserName");

        function openDeleteModal(userId) {
          const user = admins.find((a) => a.id === userId);
          if (!user) return;
          deleteTargetId = userId;
          deleteUserName.textContent = user.name;
          deletePasswordInput.value = "";
          deleteError.classList.remove("visible");
          modal.classList.add("active");
          deletePasswordInput.focus();
        }

        function closeDeleteModal() {
          modal.classList.remove("active");
          deleteTargetId = null;
          deletePasswordInput.value = "";
          deleteError.classList.remove("visible");
        }

        function confirmDelete() {
          const password = deletePasswordInput.value.trim();
          // In a real app, you'd verify against the logged-in user's password hash
          // For demo, we'll use a hardcoded password: "admin123"
          if (password === "admin123") {
            if (deleteTargetId !== null) {
              const index = admins.findIndex((a) => a.id === deleteTargetId);
              if (index > -1) {
                admins.splice(index, 1);
                updateMiniStats();
                currentPage = 1;
                renderTable();
                closeDeleteModal();
                // Show success feedback
                const toast = document.createElement("div");
                toast.style.cssText = `
                  position: fixed; bottom: 20px; right: 20px;
                  background: var(--accent-color); color: #1a1a1a;
                  padding: 0.8rem 1.5rem; border-radius: var(--border-radius);
                  font-weight: 600; box-shadow: 0 4px 20px rgba(0,0,0,0.15);
                  z-index: 2000; animation: slideUp 0.3s ease;
                `;
                toast.textContent = "✅ Admin account deleted successfully!";
                document.body.appendChild(toast);
                setTimeout(() => {
                  toast.style.opacity = "0";
                  toast.style.transition = "opacity 0.3s";
                  setTimeout(() => toast.remove(), 300);
                }, 3000);
              }
            }
          } else {
            deleteError.classList.add("visible");
            deletePasswordInput.value = "";
            deletePasswordInput.focus();
          }
        }

        // Modal event listeners
        document
          .getElementById("cancelDeleteBtn")
          .addEventListener("click", closeDeleteModal);
        document
          .getElementById("confirmDeleteBtn")
          .addEventListener("click", confirmDelete);
        deletePasswordInput.addEventListener("keydown", function (e) {
          if (e.key === "Enter") {
            e.preventDefault();
            confirmDelete();
          }
          if (e.key === "Escape") {
            closeDeleteModal();
          }
        });
        modal.addEventListener("click", function (e) {
          if (e.target === modal) closeDeleteModal();
        });

        // ----- DELETE BUTTON (modal trigger) -----
        document.addEventListener("click", function (e) {
          const target = e.target.closest("a");
          if (!target) return;

          // Delete button - open modal
          if (target.classList.contains("delete")) {
            e.preventDefault();
            const id = parseInt(target.dataset.id);
            if (id) {
              openDeleteModal(id);
            }
          }
        });

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
        updateMiniStats();
        renderTable();
        document.getElementById("sidebarUserName").textContent =
          "Admin Manager";

        // Add keyframe animation for toast
        const style = document.createElement("style");
        style.textContent = `
          @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
          }
        `;
        document.head.appendChild(style);
      })();
    </script>
  </body>
</html>
