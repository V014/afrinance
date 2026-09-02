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
    <style>
      /* ----- THEME INSPIRED FROM AFRINANCE ----- */
      :root {
        --bg-color: #e4e4e4;
        --bg-panel: #ffffff;
        --text-color: #1a1a1a;
        --card-bg: #f5f5f5;
        --accent-color: #3ddc84;
        --border: rgba(0, 0, 0, 0.07);
        --border-radius: 12px;
        --control-padding: 16px 20px;
        --sales: #f59e0b;
        --expenses: #e74c3c;
        /* debt variable kept for compatibility but not used */
        --debt: #3b82f6;
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
        /* background: var(--bg-panel); */
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

      .sidebar .nav-links {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
      }
      .sidebar .nav-links a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: var(--border-radius);
        color: var(--text-color);
        text-decoration: none;
        font-weight: 500;
        cursor: pointer;
        opacity: 0.7;
        font-size: 1rem;
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
        max-width: 1300px;
      }

      /* ----- PANEL CARD ----- */
      .panel-card {
        border-radius: var(--border-radius);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
      }

      /* ----- WELCOME CARD (flex layout: left, center, right) ----- */
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
      }
      .welcome-card .welcome-center {
        flex: 1;
        text-align: center;
        opacity: 0.8;
        font-size: 0.95rem;
      }
      .welcome-card .welcome-right {
        flex: 0 0 auto;
        text-align: right;
        opacity: 0.8;
        font-size: 0.95rem;
      }
      .welcome-card .welcome-center strong,
      .welcome-card .welcome-right strong {
        font-weight: 600;
      }

      /* ----- STATS CARDS - side by side ----- */
      .stats-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 0.5rem;
      }
      .stat-card {
        padding: 1.5rem;
        border-radius: var(--border-radius);
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        /* background: var(--bg-panel); */
      }
      .stat-card .stat-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
      }
      .stat-card .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
      }
      .stat-card .stat-label {
        font-size: 0.9rem;
        opacity: 0.6;
      }

      /* ----- TABS (filter) with color coding ----- */
      .tabs-container {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin: 1.5rem 0 1rem;
      }
      .tab-btn {
        padding: 0.6rem 1.8rem;
        border: 2px solid transparent;
        /* border-radius: 30px; */
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        background: var(--bg-color);
        color: var(--text-color);
        opacity: 0.6;
        transition: all 0.3s ease;
      }
      .tab-btn:hover {
        opacity: 0.9;
        transform: scale(1.02);
      }
      /* Default active state (All) */
      .tab-btn.active-tab {
        /* background: var(--accent-color); */
        color: var(--accent-color);
        opacity: 1;
        border-bottom: 1px solid var(--accent-color);
      }
      /* Sales filter active */
      .tab-btn.active-sales {
        /* background: var(--sales); */
        color: var(--sales);
        opacity: 1;
        border-bottom: 1px solid var(--sales);
      }
      /* Expenses filter active */
      .tab-btn.active-expenses {
        /* background: var(--expenses); */
        color: var(--expenses);
        opacity: 1;
        border-bottom: 1px solid var(--expenses);
      }

      /* ----- TABLE ----- */
      .table-wrapper {
        /* background: var(--bg-panel); */
        border-radius: var(--border-radius);
        padding: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
        margin-top: 0.5rem;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
      }
      thead {
        background: var(--bg-color);
        border-radius: var(--border-radius);
      }
      th {
        padding: 0.9rem 1rem;
        text-align: left;
        font-weight: 600;
        opacity: 0.8;
        border-bottom: 2px solid var(--border);
      }
      td {
        padding: 0.8rem 1rem;
        border-bottom: 1px solid var(--border);
        opacity: 0.9;
      }
      tr:last-child td {
        border-bottom: none;
      }
      .type-badge {
        display: inline-block;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
      }
      .type-sale {
        color: var(--sales);
      }
      .type-expense {
        color: var(--expenses);
      }

      .empty-state {
        text-align: center;
        padding: 2rem;
        opacity: 0.5;
      }

      /* ----- MOBILE ----- */
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
        .welcome-card .welcome-left,
        .welcome-card .welcome-center,
        .welcome-card .welcome-right {
          text-align: center;
          flex: 1 1 auto;
        }
        .tabs-container {
          flex-wrap: wrap;
        }
        .stats-row {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </head>
  <body>
    <div class="app-layout">
      <!-- SIDEBAR -->
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
            <span id="sidebarUserName">Cashier</span>
          </div>
        </div>

        <nav class="nav-links">
          <a href="dashboard.php" data-page="dashboard" class="active-link"
            ><i class="fas fa-th-large"></i> Dashboard</a
          >
          <a href="sales.php" data-page="add-sale"
            ><i class="fas fa-coins"></i> Sales</a
          >
          <a href="expenses.php" data-page="add-expense"
            ><i class="fas fa-receipt"></i> Expenses</a
          >
          <a href="reports.php" data-page="add-debt"
            ><i class="fas fa-file-alt"></i> Reports</a
          >
        </nav>

        <div class="logout-wrapper">
          <a href="login.php" data-page="logout"
            ><i class="fas fa-sign-out-alt"></i> Logout</a
          >
        </div>
      </aside>

      <!-- MAIN CONTENT -->
      <main class="main-content">
        <div class="content-wrapper">
          <!-- WELCOME CARD with live time (left, center, right) -->
          <div class="panel-card welcome-card">
            <div class="welcome-left">
              <h2>Welcome, <span id="dashUserName">Cashier</span></h2>
            </div>
            <div class="welcome-center">
              <strong>Time:</strong> <span id="liveTime">--:--:--</span>
            </div>
            <div class="welcome-right">
              <strong>Day:</strong> <span id="liveDay">----</span>
            </div>
          </div>

          <!-- STATS CARDS - side by side -->
          <div class="stats-row">
            <div class="stat-card">
              <div class="stat-icon" style="color: var(--sales)">
                <i class="fas fa-coins"></i>
              </div>
              <div class="stat-value" id="dashTotalSales">0.00</div>
              <div class="stat-label">Today's Sales</div>
            </div>
            <div class="stat-card">
              <div class="stat-icon" style="color: var(--expenses)">
                <i class="fas fa-receipt"></i>
              </div>
              <div class="stat-value" id="dashTotalExpenses">0.00</div>
              <div class="stat-label">Today's Expenses</div>
            </div>
          </div>

          <!-- TABS FILTER (Debt tab removed) -->
          <div class="tabs-container">
            <button class="tab-btn active-tab" data-filter="all">All</button>
            <button class="tab-btn" data-filter="sale">Sales</button>
            <button class="tab-btn" data-filter="expense">Expenses</button>
          </div>

          <!-- TABLE (description column removed) -->
          <div class="table-wrapper">
            <table>
              <thead>
                <tr>
                  <th>Type</th>
                  <th>Amount (MWK)</th>
                  <th>Date</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody id="tableBody">
                <!-- rows rendered by JS -->
              </tbody>
            </table>
            <div id="emptyState" class="empty-state" style="display: none">
              No records found
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
          const timeStr = now.toLocaleTimeString("en-US", { hour12: false });
          const dayStr = now.toLocaleDateString("en-US", {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
          });
          document.getElementById("liveTime").textContent = timeStr;
          document.getElementById("liveDay").textContent = dayStr;
        }
        updateClock();
        setInterval(updateClock, 1000);

        // ----- DATA (debt records removed) -----
        function todayStr() {
          return new Date().toISOString().slice(0, 10);
        }

        const today = todayStr();

        // Sample data without debt entries
        const allRecords = [
          {
            type: "sale",
            description: "Dine-in - Alice",
            amount: 120.5,
            date: today,
            time: "12:30:15",
          },
          {
            type: "sale",
            description: "Takeaway - Bob",
            amount: 45.0,
            date: today,
            time: "13:45:22",
          },
          {
            type: "expense",
            description: "Ingredients - veggies",
            amount: 30.0,
            date: today,
            time: "09:10:05",
          },
          {
            type: "expense",
            description: "Transport - delivery",
            amount: 15.0,
            date: today,
            time: "10:20:30",
          },
          {
            type: "sale",
            description: "Mobile Money - Carol",
            amount: 75.25,
            date: today,
            time: "15:10:00",
          },
          {
            type: "expense",
            description: "Salaries - weekly",
            amount: 200.0,
            date: today,
            time: "08:00:00",
          },
        ];

        // ----- RENDER TABLE (no description column) -----
        let currentFilter = "all";

        function renderTable(filter) {
          const tbody = document.getElementById("tableBody");
          const empty = document.getElementById("emptyState");

          let filtered =
            filter === "all"
              ? allRecords
              : allRecords.filter((r) => r.type === filter);

          // Sort by time (newest first)
          filtered = [...filtered].sort((a, b) => b.time.localeCompare(a.time));

          if (filtered.length === 0) {
            tbody.innerHTML = "";
            empty.style.display = "block";
            return;
          }
          empty.style.display = "none";

          let html = "";
          const typeLabels = { sale: "Sale", expense: "Expense" };
          const typeClasses = {
            sale: "type-sale",
            expense: "type-expense",
          };
          const iconMap = {
            sale: "",
            expense: "",
          };

          filtered.forEach((r) => {
            html += `<tr>
          <td><span class="type-badge ${typeClasses[r.type]}"><i class="fas ${iconMap[r.type]}"></i> ${typeLabels[r.type]}</span></td>
          <td><strong>${r.amount.toFixed(2)}</strong></td>
          <td>${r.date}</td>
          <td>${r.time}</td>
        </tr>`;
          });
          tbody.innerHTML = html;
        }

        // ----- UPDATE STATS (debt removed) -----
        function updateStats() {
          const today = todayStr();
          const salesToday = allRecords
            .filter((r) => r.type === "sale" && r.date === today)
            .reduce((sum, r) => sum + r.amount, 0);
          const expToday = allRecords
            .filter((r) => r.type === "expense" && r.date === today)
            .reduce((sum, r) => sum + r.amount, 0);

          document.getElementById("dashTotalSales").textContent =
            salesToday.toFixed(2);
          document.getElementById("dashTotalExpenses").textContent =
            expToday.toFixed(2);
        }

        // ----- TABS with color coding (debt tab removed) -----
        document.querySelectorAll(".tab-btn").forEach((btn) => {
          btn.addEventListener("click", function () {
            // Remove all active classes from all tabs
            document.querySelectorAll(".tab-btn").forEach((b) => {
              b.classList.remove(
                "active-tab",
                "active-sales",
                "active-expenses",
                "active-debts",
              );
            });

            const filter = this.dataset.filter;

            // Add the appropriate active class based on filter
            if (filter === "all") {
              this.classList.add("active-tab");
            } else if (filter === "sale") {
              this.classList.add("active-sales");
            } else if (filter === "expense") {
              this.classList.add("active-expenses");
            }

            currentFilter = filter;
            renderTable(currentFilter);
          });
        });

        // ----- INIT -----
        renderTable("all");
        updateStats();

        // Set user name
        document.getElementById("sidebarUserName").textContent = "Cashier";
        document.getElementById("dashUserName").textContent = "Cashier";
      })();
    </script>
  </body>
</html>
