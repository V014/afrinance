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
