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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
    <style>
      /* ----- THEME (same as original) ----- */
      :root {
        --bg-color: #e4e4e4;
        --bg-panel: #ffffff;
        --text-color: #1a1a1a;
        --card-bg: #f5f5f5;
        --accent-color: #3ddc84;
        --border: rgba(0, 0, 0, 0.07);
        --border-radius: 12px;
        --sales: #f59e0b;
        --expenses: #e74c3c;
        --debt: #3b82f6;
        --admin-purple: #8b5cf6;
        --audit-create: #3ddc84;
        --audit-update: #f59e0b;
        --audit-delete: #e74c3c;
        --audit-login: #3b82f6;
        --audit-logout: #8b5cf6;
      }

      @media (prefers-color-scheme: dark) {
        :root {
          --bg-color: #0c0d0c;
          --bg-panel: #111412;
          --text-color: #f0f0f0;
          --card-bg: #1e1e1e;
          --accent-color: #3ddc84;
          --border: rgba(255, 255, 255, 0.07);
        }
      }

      * {
        box-sizing: border-box;
        margin: 0;
      }

      body {
        background-color: var(--bg-color);
        color: var(--text-color);
        font-family:
          system-ui,
          -apple-system,
          sans-serif;
        min-height: 100vh;
        transition:
          background 0.2s,
          color 0.2s;
      }

      /* ----- SIDEBAR LAYOUT ----- */
      .app-layout {
        display: flex;
        min-height: 100vh;
      }
      .sidebar {
        width: 260px;
        border-right: 1px solid var(--border);
        padding: 1.5rem 1rem;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        height: 100vh;
        position: sticky;
        top: 0;
        overflow-y: auto;
        transition: transform 0.2s;
      }
      .sidebar .brand {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
      }
      .sidebar .brand .avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        flex-shrink: 0;
        overflow: hidden;
        background: var(--accent-color);
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .sidebar .brand .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      .sidebar .brand .user-info {
        font-size: 0.95rem;
        font-weight: 500;
        line-height: 1.3;
      }
      .sidebar .brand .user-info small {
        font-weight: 400;
        opacity: 0.6;
        font-size: 0.75rem;
      }
      .sidebar .nav-section {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        opacity: 0.4;
        padding: 0.75rem 1rem 0.3rem 1rem;
        font-weight: 700;
      }
      .sidebar .nav-links {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        margin-bottom: 0.5rem;
      }
      .sidebar .nav-links a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.6rem 1rem;
        border-radius: var(--border-radius);
        color: var(--text-color);
        text-decoration: none;
        font-weight: 500;
        cursor: pointer;
        opacity: 0.7;
        font-size: 0.95rem;
        transition:
          background 0.1s,
          opacity 0.1s;
      }
      .sidebar .nav-links a:hover {
        background: var(--card-bg);
        opacity: 1;
      }
      .sidebar .nav-links a.active-link {
        background: var(--accent-color);
        color: #1a1a1a;
        opacity: 1;
      }
      .sidebar .nav-links a i {
        width: 22px;
        text-align: center;
      }
      .sidebar .logout-wrapper {
        margin-top: auto;
        border-top: 1px solid var(--border);
        padding-top: 1rem;
      }
      .sidebar .logout-wrapper a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: var(--border-radius);
        color: #e74c3c;
        text-decoration: none;
        font-weight: 500;
        opacity: 0.7;
        font-size: 1rem;
        transition:
          background 0.1s,
          opacity 0.1s;
        cursor: pointer;
      }
      .sidebar .logout-wrapper a:hover {
        background: var(--card-bg);
        opacity: 1;
      }
      .sidebar .logout-wrapper a i {
        width: 22px;
        text-align: center;
      }

      /* ----- MAIN CONTENT ----- */
      .main-content {
        flex: 1;
        padding: 1.5rem 2rem;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .main-content .content-wrapper {
        width: 100%;
        max-width: 1400px;
      }

      /* ----- PANEL CARD ----- */
      .panel-card {
        border-radius: var(--border-radius);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
      }

      /* ----- WELCOME CARD (no time/date) ----- */
      .welcome-card {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        gap: 10px;
      }
      .welcome-card .welcome-left {
        flex: 0 0 auto;
      }
      .welcome-card .welcome-left h2 {
        font-size: 1.25rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.75rem;
      }
      .welcome-card .welcome-left h2 i {
        color: var(--admin-purple);
      }

      /* ----- BACK BUTTON ----- */
      .back-bar {
        margin-bottom: 1.5rem;
      }
      .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 1.5rem;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 2px solid var(--border);
        background: var(--bg-panel);
        color: var(--text-color);
        cursor: pointer;
      }
      .back-btn:hover {
        transform: translateX(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      }
      .back-btn i {
        font-size: 1rem;
      }

      /* ----- STATS MINI ----- */
      .stats-mini {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
      }
      .stat-mini {
        padding: 0.8rem 1rem;
        border-radius: var(--border-radius);
        background: var(--bg-panel);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        text-align: center;
        border: 1px solid var(--border);
      }
      .stat-mini .stat-number {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--text-color);
      }
      .stat-mini .stat-label {
        font-size: 0.7rem;
        opacity: 0.6;
        text-transform: uppercase;
        letter-spacing: 0.03em;
      }

      /* ----- ACTION BAR (Export only) ----- */
      .action-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
        justify-content: flex-start;
      }
      .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.7rem 1.8rem;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 2px solid var(--border);
        background: var(--bg-panel);
        color: var(--text-color);
        cursor: pointer;
      }
      .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      }
      .action-btn.primary-btn {
        background: var(--accent-color);
        border-color: var(--accent-color);
        color: #1a1a1a;
      }
      .action-btn.primary-btn:hover {
        box-shadow: 0 4px 12px rgba(61, 220, 132, 0.4);
      }
      .action-btn i {
        font-size: 1.1rem;
      }

      /* ----- FILTERS ----- */
      .filters-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin: 1.5rem 0 1rem;
        padding: 0.75rem 1rem;
        background: var(--bg-panel);
        border-radius: var(--border-radius);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border);
      }
      .filters-container .filter-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
      }
      .filters-container .filter-group label {
        font-size: 0.8rem;
        font-weight: 600;
        opacity: 0.7;
        white-space: nowrap;
      }
      .filters-container .filter-group select {
        padding: 0.4rem 0.75rem;
        border-radius: var(--border-radius);
        border: 1px solid var(--border);
        background: var(--bg-color);
        color: var(--text-color);
        font-size: 0.85rem;
        cursor: pointer;
        outline: none;
        min-width: 120px;
      }
      .filters-container .filter-group select:focus {
        border-color: var(--accent-color);
      }
      .filters-container .filter-group input {
        padding: 0.4rem 0.75rem;
        border-radius: var(--border-radius);
        border: 1px solid var(--border);
        background: var(--bg-color);
        color: var(--text-color);
        font-size: 0.85rem;
        outline: none;
        min-width: 140px;
      }
      .filters-container .filter-group input:focus {
        border-color: var(--accent-color);
      }
      .filters-container .filter-group input::placeholder {
        opacity: 0.4;
      }
      .clear-filters-btn {
        padding: 0.4rem 1rem;
        border-radius: var(--border-radius);
        border: 1px solid var(--border);
        background: var(--bg-color);
        color: var(--text-color);
        font-size: 0.8rem;
        cursor: pointer;
        font-weight: 600;
        opacity: 0.7;
        transition: all 0.2s;
      }
      .clear-filters-btn:hover {
        opacity: 1;
        background: var(--card-bg);
      }

      /* ----- TABLE ----- */
      .table-wrapper {
        border-radius: var(--border-radius);
        padding: 0.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
        margin-top: 0.5rem;
        background: var(--bg-panel);
      }
      table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
        border: 1px solid var(--border);
      }
      thead {
        background: var(--bg-color);
      }
      th {
        padding: 0.9rem 1rem;
        text-align: left;
        font-weight: 600;
        opacity: 0.8;
        border: 1px solid var(--border);
      }
      td {
        padding: 0.8rem 1rem;
        border: 1px solid var(--border);
        opacity: 0.9;
        vertical-align: middle;
      }
      tr:last-child td {
        border-bottom: 1px solid var(--border);
      }

      .action-badge {
        display: inline-block;
        padding: 0.15rem 0.7rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        background: var(--bg-color);
      }
      .action-create {
        color: var(--audit-create);
      }
      .action-update {
        color: var(--audit-update);
      }
      .action-delete {
        color: var(--audit-delete);
      }
      .action-login {
        color: var(--audit-login);
      }
      .action-logout {
        color: var(--audit-logout);
      }

      .status-badge {
        display: inline-block;
        padding: 0.15rem 0.7rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        background: var(--bg-color);
      }
      .status-success {
        color: var(--accent-color);
      }
      .status-failure {
        color: var(--expenses);
      }

      .empty-state {
        text-align: center;
        padding: 2rem;
        opacity: 0.5;
      }

      /* ----- PAGINATION ----- */
      .pagination-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-top: 1rem;
        padding: 0.75rem 0;
      }
      .pagination-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
      }
      .pagination-controls button {
        padding: 0.4rem 0.8rem;
        border-radius: var(--border-radius);
        border: 1px solid var(--border);
        background: var(--bg-color);
        color: var(--text-color);
        cursor: pointer;
        font-size: 0.85rem;
        transition: all 0.2s;
        opacity: 0.7;
      }
      .pagination-controls button:hover:not(:disabled) {
        opacity: 1;
        background: var(--card-bg);
      }
      .pagination-controls button:disabled {
        opacity: 0.3;
        cursor: not-allowed;
      }
      .pagination-controls .page-info {
        font-size: 0.85rem;
        opacity: 0.7;
        padding: 0 0.5rem;
      }
      .rows-per-page {
        display: flex;
        align-items: center;
        gap: 0.5rem;
      }
      .rows-per-page label {
        font-size: 0.8rem;
        opacity: 0.7;
        font-weight: 600;
      }
      .rows-per-page select {
        padding: 0.4rem 0.75rem;
        border-radius: var(--border-radius);
        border: 1px solid var(--border);
        background: var(--bg-color);
        color: var(--text-color);
        font-size: 0.85rem;
        cursor: pointer;
        outline: none;
      }

      /* ----- RESPONSIVE ----- */
      @media (max-width: 1024px) {
        .stats-mini {
          grid-template-columns: repeat(3, 1fr);
        }
      }

      @media (max-width: 768px) {
        .app-layout {
          flex-direction: column;
        }
        .sidebar {
          width: 100%;
          height: auto;
          position: relative;
          border-right: none;
          border-bottom: 1px solid var(--border);
          padding: 1rem;
        }
        .main-content {
          padding: 1rem;
        }
        .main-content .content-wrapper {
          max-width: 100%;
        }
        .welcome-card {
          flex-direction: column;
          align-items: stretch;
          text-align: center;
        }
        .welcome-card .welcome-left {
          text-align: center;
        }
        .stats-mini {
          grid-template-columns: 1fr 1fr;
        }
        .action-bar {
          justify-content: center;
        }
        .filters-container {
          flex-direction: column;
          align-items: stretch;
        }
        .filters-container .filter-group {
          justify-content: space-between;
        }
        .pagination-container {
          flex-direction: column;
          align-items: stretch;
          text-align: center;
        }
        .pagination-controls {
          justify-content: center;
        }
        .rows-per-page {
          justify-content: center;
        }
      }
      @media (max-width: 480px) {
        .stats-mini {
          grid-template-columns: 1fr;
        }
        .action-btn {
          justify-content: center;
        }
      }
    </style>
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
          <a href="manage.php" data-page="admins"
            ><i class="fas fa-user-cog"></i> Manage Admins</a
          >
          <a href="roles.php" data-page="roles"
            ><i class="fas fa-user-tag"></i> Manage Roles</a
          >
          <a href="audit.php" data-page="audit" class="active-link"
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
            <a href="dashboard.php" class="back-btn"
              ><i class="fas fa-arrow-left"></i> Back to Dashboard</a
            >
          </div> -->

          <!-- WELCOME CARD -->
          <div class="panel-card welcome-card">
            <div class="welcome-left">
              <h2>
                <i class="fas fa-clipboard-list"></i>
                Audit Log
              </h2>
            </div>
          </div>

          <!-- STATS MINI -->
          <div class="stats-mini">
            <div class="stat-mini">
              <div class="stat-number" id="statTotal">0</div>
              <div class="stat-label">Total Events</div>
            </div>
            <div class="stat-mini">
              <div class="stat-number" id="statToday">0</div>
              <div class="stat-label">Today</div>
            </div>
            <div class="stat-mini">
              <div class="stat-number" id="statCreate">0</div>
              <div class="stat-label">Creates</div>
            </div>
            <div class="stat-mini">
              <div class="stat-number" id="statUpdate">0</div>
              <div class="stat-label">Updates</div>
            </div>
            <div class="stat-mini">
              <div class="stat-number" id="statDelete">0</div>
              <div class="stat-label">Deletes</div>
            </div>
          </div>

          <!-- ACTION BAR (Export only) -->
          <div class="action-bar">
            <button class="action-btn primary-btn" id="exportBtn">
              <i class="fas fa-file-pdf"></i> Export PDF
            </button>
          </div>

          <!-- FILTERS -->
          <div class="filters-container">
            <div class="filter-group">
              <label for="filterUser">User</label>
              <input type="text" id="filterUser" placeholder="Search user..." />
            </div>
            <div class="filter-group">
              <label for="filterAction">Action</label>
              <select id="filterAction">
                <option value="all">All Actions</option>
                <option value="create">Create</option>
                <option value="update">Update</option>
                <option value="delete">Delete</option>
                <option value="login">Login</option>
                <option value="logout">Logout</option>
              </select>
            </div>
            <div class="filter-group">
              <label for="filterStatus">Status</label>
              <select id="filterStatus">
                <option value="all">All Status</option>
                <option value="success">Success</option>
                <option value="failure">Failure</option>
              </select>
            </div>
            <div class="filter-group">
              <label for="filterDate">Date</label>
              <input type="date" id="filterDate" />
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
                  <th>User</th>
                  <th>Action</th>
                  <th>Target</th>
                  <th>Details</th>
                  <th>Status</th>
                  <th>Timestamp</th>
                </tr>
              </thead>
              <tbody id="tableBody"></tbody>
            </table>
            <div id="emptyState" class="empty-state" style="display: none">
              No audit events found
            </div>
          </div>

          <!-- PAGINATION -->
          <div class="pagination-container">
            <div class="rows-per-page">
              <label for="rowsPerPage">Rows per page:</label>
              <select id="rowsPerPage">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
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

        // ----- SAMPLE AUDIT DATA (IP address removed) -----
        const auditEvents = [
          {
            id: 1,
            user: "Alice Mwale",
            action: "login",
            target: "System",
            details: "Successful login from Chrome on Windows",
            status: "success",
            timestamp: "2026-08-06 08:15:23",
          },
          {
            id: 2,
            user: "Bob Phiri",
            action: "create",
            target: "Admin Account",
            details: "Created new admin account: Carol Banda",
            status: "success",
            timestamp: "2026-08-06 09:30:45",
          },
          {
            id: 3,
            user: "Carol Banda",
            action: "update",
            target: "Admin Account",
            details: "Updated role for David Zulu from Cashier to Accountant",
            status: "success",
            timestamp: "2026-08-06 10:45:12",
          },
          {
            id: 4,
            user: "David Zulu",
            action: "delete",
            target: "Admin Account",
            details: "Deleted inactive admin account: Frank Kamanga",
            status: "success",
            timestamp: "2026-08-06 11:20:33",
          },
          {
            id: 5,
            user: "Ester Tembo",
            action: "login",
            target: "System",
            details: "Failed login attempt - incorrect password",
            status: "failure",
            timestamp: "2026-08-06 12:05:17",
          },
          {
            id: 6,
            user: "Ester Tembo",
            action: "login",
            target: "System",
            details: "Successful login from Firefox on Mac",
            status: "success",
            timestamp: "2026-08-06 12:06:01",
          },
          {
            id: 7,
            user: "Grace Banda",
            action: "update",
            target: "Admin Account",
            details: "Updated 2FA settings for Henry Moyo",
            status: "success",
            timestamp: "2026-08-06 13:15:44",
          },
          {
            id: 8,
            user: "Henry Moyo",
            action: "logout",
            target: "System",
            details: "User logged out",
            status: "success",
            timestamp: "2026-08-06 14:30:22",
          },
          {
            id: 9,
            user: "Ivy Nkhoma",
            action: "create",
            target: "Admin Account",
            details: "Created new admin account: John Doe",
            status: "success",
            timestamp: "2026-08-05 16:45:55",
          },
          {
            id: 10,
            user: "Alice Mwale",
            action: "update",
            target: "Admin Account",
            details: "Updated status for Carol Banda from Inactive to Active",
            status: "success",
            timestamp: "2026-08-05 14:20:11",
          },
          {
            id: 11,
            user: "Bob Phiri",
            action: "delete",
            target: "Admin Account",
            details: "Deleted admin account: John Doe (inactive)",
            status: "success",
            timestamp: "2026-08-05 11:30:08",
          },
          {
            id: 12,
            user: "Carol Banda",
            action: "login",
            target: "System",
            details: "Successful login from Safari on iPhone",
            status: "success",
            timestamp: "2026-08-04 09:00:33",
          },
          {
            id: 13,
            user: "David Zulu",
            action: "update",
            target: "System Settings",
            details: "Updated system notification preferences",
            status: "success",
            timestamp: "2026-08-04 10:15:19",
          },
          {
            id: 14,
            user: "Ester Tembo",
            action: "logout",
            target: "System",
            details: "User logged out (session timeout)",
            status: "success",
            timestamp: "2026-08-04 17:00:00",
          },
          {
            id: 15,
            user: "Frank Kamanga",
            action: "login",
            target: "System",
            details: "Failed login attempt - account locked",
            status: "failure",
            timestamp: "2026-08-03 08:30:45",
          },
          {
            id: 16,
            user: "Grace Banda",
            action: "create",
            target: "Admin Account",
            details: "Created new admin account: Sarah Mwale",
            status: "success",
            timestamp: "2026-08-03 13:45:22",
          },
          {
            id: 17,
            user: "Henry Moyo",
            action: "update",
            target: "Admin Account",
            details:
              "Changed role for Sarah Mwale from Cashier to Admin Manager",
            status: "success",
            timestamp: "2026-08-03 14:20:11",
          },
          {
            id: 18,
            user: "Ivy Nkhoma",
            action: "delete",
            target: "Admin Account",
            details: "Deleted admin account: Sarah Mwale (duplicate)",
            status: "success",
            timestamp: "2026-08-03 15:30:55",
          },
          {
            id: 19,
            user: "Alice Mwale",
            action: "login",
            target: "System",
            details: "Successful login from Edge on Windows",
            status: "success",
            timestamp: "2026-08-02 07:45:12",
          },
          {
            id: 20,
            user: "Bob Phiri",
            action: "update",
            target: "System Settings",
            details:
              "Updated security policy - password expiration set to 90 days",
            status: "success",
            timestamp: "2026-08-02 11:00:33",
          },
        ];

        // ----- STATE -----
        let currentPage = 1;
        let rowsPerPage = 10;
        let filteredData = [];

        // ----- HELPERS -----
        function todayStr() {
          return new Date().toISOString().slice(0, 10);
        }

        // ----- UPDATE STATS -----
        function updateStats() {
          const total = auditEvents.length;
          const today = todayStr();
          const todayEvents = auditEvents.filter((e) =>
            e.timestamp.startsWith(today),
          ).length;
          const creates = auditEvents.filter(
            (e) => e.action === "create",
          ).length;
          const updates = auditEvents.filter(
            (e) => e.action === "update",
          ).length;
          const deletes = auditEvents.filter(
            (e) => e.action === "delete",
          ).length;

          document.getElementById("statTotal").textContent = total;
          document.getElementById("statToday").textContent = todayEvents;
          document.getElementById("statCreate").textContent = creates;
          document.getElementById("statUpdate").textContent = updates;
          document.getElementById("statDelete").textContent = deletes;
        }

        // ----- GET FILTERED DATA -----
        function getFilteredData() {
          const userFilter = document
            .getElementById("filterUser")
            .value.toLowerCase()
            .trim();
          const actionFilter = document.getElementById("filterAction").value;
          const statusFilter = document.getElementById("filterStatus").value;
          const dateFilter = document.getElementById("filterDate").value;

          let filtered = auditEvents.filter((e) => {
            const matchUser = e.user.toLowerCase().includes(userFilter);
            const matchAction =
              actionFilter === "all" || e.action === actionFilter;
            const matchStatus =
              statusFilter === "all" || e.status === statusFilter;
            const matchDate = !dateFilter || e.timestamp.startsWith(dateFilter);
            return matchUser && matchAction && matchStatus && matchDate;
          });

          return filtered.sort(
            (a, b) => new Date(b.timestamp) - new Date(a.timestamp),
          );
        }

        // ----- RENDER TABLE -----
        function renderTable() {
          const filtered = getFilteredData();
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

          const actionLabels = {
            create: "Create",
            update: "Update",
            delete: "Delete",
            login: "Login",
            logout: "Logout",
          };
          const actionClasses = {
            create: "action-create",
            update: "action-update",
            delete: "action-delete",
            login: "action-login",
            logout: "action-logout",
          };
          const statusLabels = { success: "Success", failure: "Failure" };
          const statusClasses = {
            success: "status-success",
            failure: "status-failure",
          };

          let html = "";
          pageData.forEach((e, idx) => {
            const rowNum = startIndex + idx + 1;
            html += `<tr>
              <td style="text-align:center;opacity:0.5;">${rowNum}</td>
              <td><strong>${e.user}</strong></td>
              <td><span class="action-badge ${actionClasses[e.action]}">${actionLabels[e.action]}</span></td>
              <td>${e.target}</td>
              <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="${e.details}">${e.details}</td>
              <td><span class="status-badge ${statusClasses[e.status]}">${statusLabels[e.status]}</span></td>
              <td style="font-size:0.85rem;">${e.timestamp}</td>
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

        // ----- EXPORT PDF -----
        function exportPDF() {
          const { jsPDF } = window.jspdf;
          const doc = new jsPDF("landscape", "mm", "a4");

          // Get the current filtered data (all rows, not just paginated)
          const exportData = getFilteredData();

          if (exportData.length === 0) {
            alert("No data to export. Please adjust your filters.");
            return;
          }

          // Add title
          doc.setFontSize(16);
          doc.setTextColor(40, 40, 40);
          doc.text("Audit Log Report", 14, 15);

          // Add subtitle with date
          doc.setFontSize(10);
          doc.setTextColor(100, 100, 100);
          const now = new Date();
          const dateStr = now.toLocaleString("en-US", {
            year: "numeric",
            month: "long",
            day: "numeric",
            hour: "2-digit",
            minute: "2-digit",
          });
          doc.text(
            `Generated: ${dateStr} | Total Events: ${exportData.length}`,
            14,
            22,
          );

          // Prepare table data (IP address removed)
          const tableData = exportData.map((e, idx) => [
            idx + 1,
            e.user,
            e.action.charAt(0).toUpperCase() + e.action.slice(1),
            e.target,
            e.details,
            e.status.charAt(0).toUpperCase() + e.status.slice(1),
            e.timestamp,
          ]);

          // Generate table
          doc.autoTable({
            startY: 28,
            head: [
              [
                "#",
                "User",
                "Action",
                "Target",
                "Details",
                "Status",
                "Timestamp",
              ],
            ],
            body: tableData,
            theme: "striped",
            headStyles: {
              fillColor: [61, 220, 132],
              textColor: [0, 0, 0],
              fontSize: 9,
              fontStyle: "bold",
            },
            bodyStyles: {
              fontSize: 8,
              textColor: [40, 40, 40],
            },
            columnStyles: {
              0: { cellWidth: 10, halign: "center" },
              1: { cellWidth: 30 },
              2: { cellWidth: 25 },
              3: { cellWidth: 35 },
              4: { cellWidth: 55 },
              5: { cellWidth: 20, halign: "center" },
              6: { cellWidth: 35 },
            },
            margin: { left: 10, right: 10 },
            pageBreak: "auto",
          });

          // Add footer with page numbers
          const totalPages = doc.internal.getNumberOfPages();
          for (let i = 1; i <= totalPages; i++) {
            doc.setPage(i);
            doc.setFontSize(8);
            doc.setTextColor(150, 150, 150);
            doc.text(
              `Page ${i} of ${totalPages}`,
              doc.internal.pageSize.getWidth() - 20,
              doc.internal.pageSize.getHeight() - 10,
            );
          }

          // Save the PDF
          doc.save("audit-log-report.pdf");
        }

        // ----- EVENT LISTENERS -----
        document
          .getElementById("filterUser")
          .addEventListener("input", function () {
            currentPage = 1;
            renderTable();
          });
        document
          .getElementById("filterAction")
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
          .getElementById("filterDate")
          .addEventListener("change", function () {
            currentPage = 1;
            renderTable();
          });

        document
          .getElementById("clearFilters")
          .addEventListener("click", function () {
            document.getElementById("filterUser").value = "";
            document.getElementById("filterAction").value = "all";
            document.getElementById("filterStatus").value = "all";
            document.getElementById("filterDate").value = "";
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

        // ----- EXPORT BUTTON -----
        document
          .getElementById("exportBtn")
          .addEventListener("click", exportPDF);

        // ----- INIT -----
        updateStats();
        renderTable();
        document.getElementById("sidebarUserName").textContent =
          "Admin Manager";
      })();
    </script>
  </body>
</html>
