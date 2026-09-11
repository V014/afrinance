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
    <link rel="stylesheet" href="css/safalao.css">
  </head>
  <body>
    <div class="app-layout">
      <!-- SIDEBAR (Accountant) -->
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
            <span id="sidebarUserName">Accountant</span>
            <br /><small>Wanga Kanjala</small>
          </div>
        </div>

        <!-- DASHBOARD -->
        <div class="nav-section">Dashboard</div>
        <nav class="nav-links">
          <a href="dashboard2.php" data-page="dashboard"
            ><i class="fas fa-th-large"></i> Dashboard</a
          >
        </nav>

        <!-- BRANCHES -->
        <div class="nav-section">Branches</div>
        <nav class="nav-links">
          <a href="safalawo.php" data-page="safalawo" class="active-link"
            ><i class="fas fa-store-alt"></i> Safalawo</a
          >
          <a href="#" data-page="zambia"
            ><i class="fas fa-store-alt"></i> Zambia</a
          >
          <a href="#" data-page="fargo"
            ><i class="fas fa-store-alt"></i> Fargo</a
          >
        </nav>

        <!-- TOOLS -->
        <div class="nav-section">Tools</div>
        <nav class="nav-links">
          <a href="analytics.php" data-page="audit"
            ><i class="fas fa-chart-line"></i> Analytics</a
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
          <!-- WELCOME CARD (Safalawo) -->
          <div class="panel-card welcome-card">
            <div class="welcome-left">
              <h2>
                <i class="fas fa-store-alt"></i>
                <span class="branch-name">Safalawo</span>
                <span style="opacity: 0.5; font-weight: 400"
                  >· Branch Report</span
                >
              </h2>
            </div>
            <div class="welcome-center">
              <strong>Time:</strong> <span id="liveTime">--:--:--</span>
            </div>
            <div class="welcome-right">
              <strong>Day:</strong> <span id="liveDay">----</span>
            </div>
          </div>

          <!-- NAVIGATION BUTTONS: Sales & Expenses Detail Pages -->
          <div class="nav-buttons">
            <a href="safalawosales.php" class="nav-btn sales-btn">
              <i class="fas fa-coins"></i> View Sales Details
            </a>
            <a href="safalawoexpenses.php" class="nav-btn expenses-btn">
              <i class="fas fa-receipt"></i> View Expenses Details
            </a>
          </div>

          <!-- STATS CARDS: Sales, Expenses, Net, Total Transactions -->
          <div class="stats-grid" id="statsGrid">
            <div class="stat-card">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-coins"></i></span>
                <span class="stat-label">Total Sales</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Today</span>
                <span class="detail-value" id="statSalesToday">0.00</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">All-time</span>
                <span class="detail-value" id="statSalesAll">0.00</span>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-receipt"></i></span>
                <span class="stat-label">Total Expenses</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Today</span>
                <span class="detail-value" id="statExpensesToday">0.00</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">All-time</span>
                <span class="detail-value" id="statExpensesAll">0.00</span>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-chart-pie"></i></span>
                <span class="stat-label">Net Profit</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Today</span>
                <span class="detail-value" id="statNetToday">0.00</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">All-time</span>
                <span class="detail-value" id="statNetAll">0.00</span>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-list-ul"></i></span>
                <span class="stat-label">Transactions</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Today</span>
                <span class="detail-value" id="statTxToday">0</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">All-time</span>
                <span class="detail-value" id="statTxAll">0</span>
              </div>
            </div>
          </div>

          <!-- EXTRA METRICS: average sale, average expense, highest, lowest -->
          <div class="metrics-grid">
            <div class="metric-card">
              <div class="metric-value" id="metricAvgSale">0.00</div>
              <div class="metric-label">Avg Sale</div>
            </div>
            <div class="metric-card">
              <div class="metric-value" id="metricAvgExpense">0.00</div>
              <div class="metric-label">Avg Expense</div>
            </div>
            <div class="metric-card">
              <div class="metric-value" id="metricHighest">0.00</div>
              <div class="metric-label">Highest Transaction</div>
            </div>
            <div class="metric-card">
              <div class="metric-value" id="metricLowest">0.00</div>
              <div class="metric-label">Lowest Transaction</div>
            </div>
          </div>

          <!-- TYPE FILTER TABS -->
          <div class="tabs-container">
            <button class="tab-btn active-tab" data-filter="all">All</button>
            <button class="tab-btn" data-filter="sale">Sales</button>
            <button class="tab-btn" data-filter="expense">Expenses</button>
          </div>

          <!-- TABLE (Safalawo only) -->
          <div class="table-wrapper">
            <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Type</th>
                  <th>Cashier</th>
                  <th>Amount (MWK)</th>
                  <th>Date</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody id="tableBody">
                <!-- rendered by JS -->
              </tbody>
            </table>
            <div id="emptyState" class="empty-state" style="display: none">
              No records found for Safalawo
            </div>
          </div>

          <!-- PAGINATION -->
          <div class="pagination-container">
            <div class="rows-per-page">
              <label for="rowsPerPage">Rows per page:</label>
              <select id="rowsPerPage">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
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

        // ----- HELPERS -----
        function todayStr() {
          return new Date().toISOString().slice(0, 10);
        }
        const today = todayStr();

        // ----- SAFALAWO ONLY DATA with Cashier names -----
        const safalawoRecords = [
          {
            type: "sale",
            cashier: "Grace Banda",
            amount: 1200,
            date: today,
            time: "09:15:00",
          },
          {
            type: "sale",
            cashier: "Peter Mwale",
            amount: 800,
            date: today,
            time: "10:30:00",
          },
          {
            type: "expense",
            cashier: "John Phiri",
            amount: 3500,
            date: today,
            time: "08:00:00",
          },
          {
            type: "expense",
            cashier: "Mary Kachale",
            amount: 2800,
            date: today,
            time: "11:20:00",
          },
          {
            type: "sale",
            cashier: "David Zulu",
            amount: 1500,
            date: today,
            time: "14:45:00",
          },
          {
            type: "sale",
            cashier: "Sarah Lungu",
            amount: 600,
            date: today,
            time: "16:10:00",
          },
          {
            type: "expense",
            cashier: "James Nyirenda",
            amount: 4200,
            date: "2026-07-30",
            time: "09:00:00",
          },
          {
            type: "sale",
            cashier: "Michael Banda",
            amount: 900,
            date: "2026-07-30",
            time: "11:30:00",
          },
          {
            type: "sale",
            cashier: "Ruth Moyo",
            amount: 1100,
            date: "2026-07-29",
            time: "10:00:00",
          },
          {
            type: "expense",
            cashier: "Joseph Kamanga",
            amount: 15000,
            date: "2026-07-28",
            time: "08:30:00",
          },
          {
            type: "sale",
            cashier: "Linda Phakati",
            amount: 700,
            date: "2026-07-28",
            time: "13:20:00",
          },
          {
            type: "expense",
            cashier: "Ester Tembo",
            amount: 2800,
            date: "2026-07-27",
            time: "09:45:00",
          },
        ];

        // ----- PAGINATION STATE -----
        let currentPage = 1;
        let rowsPerPage = 10;
        let filteredData = [];
        let currentFilter = "all";

        // ----- RENDER TABLE (filter by type) -----
        function renderTable() {
          const filter = currentFilter;

          let filtered =
            filter === "all"
              ? safalawoRecords
              : safalawoRecords.filter((r) => r.type === filter);

          filtered = [...filtered].sort(
            (a, b) => (a.date + a.time).localeCompare(b.date + b.time) * -1,
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

          // Calculate pagination
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

          // Update pagination controls
          document.getElementById("prevPage").disabled =
            currentPage === 1 || totalPages === 0;
          document.getElementById("nextPage").disabled =
            currentPage === totalPages || totalPages === 0;
          document.getElementById("pageInfo").textContent =
            `Page ${currentPage} of ${totalPages}`;

          const typeLabels = { sale: "Sale", expense: "Expense" };
          const typeClasses = { sale: "type-sale", expense: "type-expense" };

          let html = "";
          pageData.forEach((r, index) => {
            const rowNum = startIndex + index + 1;
            html += `<tr>
              <td style="opacity: 0.5; text-align: center;">${rowNum}</td>
              <td><span class="type-badge ${typeClasses[r.type]}">${typeLabels[r.type]}</span></td>
              <td>${r.cashier || "-"}</td>
              <td><strong>${r.amount.toFixed(2)}</strong></td>
              <td>${r.date}</td>
              <td>${r.time}</td>
            </tr>`;
          });
          tbody.innerHTML = html;
        }

        // ----- UPDATE STATS (Safalawo specific) -----
        function updateStats() {
          const today = todayStr();

          // Today's figures
          const todaySales = safalawoRecords
            .filter((r) => r.type === "sale" && r.date === today)
            .reduce((sum, r) => sum + r.amount, 0);
          const todayExpenses = safalawoRecords
            .filter((r) => r.type === "expense" && r.date === today)
            .reduce((sum, r) => sum + r.amount, 0);
          const todayNet = todaySales - todayExpenses;
          const todayTx = safalawoRecords.filter(
            (r) => r.date === today,
          ).length;

          // All-time figures
          const allSales = safalawoRecords
            .filter((r) => r.type === "sale")
            .reduce((sum, r) => sum + r.amount, 0);
          const allExpenses = safalawoRecords
            .filter((r) => r.type === "expense")
            .reduce((sum, r) => sum + r.amount, 0);
          const allNet = allSales - allExpenses;
          const allTx = safalawoRecords.length;

          // Update stat cards
          document.getElementById("statSalesToday").textContent =
            todaySales.toFixed(2);
          document.getElementById("statSalesAll").textContent =
            allSales.toFixed(2);
          document.getElementById("statExpensesToday").textContent =
            todayExpenses.toFixed(2);
          document.getElementById("statExpensesAll").textContent =
            allExpenses.toFixed(2);
          document.getElementById("statNetToday").textContent =
            todayNet.toFixed(2);
          document.getElementById("statNetAll").textContent = allNet.toFixed(2);
          document.getElementById("statTxToday").textContent = todayTx;
          document.getElementById("statTxAll").textContent = allTx;

          // Metrics: averages, highest, lowest
          const salesOnly = safalawoRecords.filter((r) => r.type === "sale");
          const expensesOnly = safalawoRecords.filter(
            (r) => r.type === "expense",
          );
          const avgSale =
            salesOnly.length > 0
              ? salesOnly.reduce((s, r) => s + r.amount, 0) / salesOnly.length
              : 0;
          const avgExpense =
            expensesOnly.length > 0
              ? expensesOnly.reduce((s, r) => s + r.amount, 0) /
                expensesOnly.length
              : 0;

          const allAmounts = safalawoRecords.map((r) => r.amount);
          const highest = allAmounts.length > 0 ? Math.max(...allAmounts) : 0;
          const lowest = allAmounts.length > 0 ? Math.min(...allAmounts) : 0;

          document.getElementById("metricAvgSale").textContent =
            avgSale.toFixed(2);
          document.getElementById("metricAvgExpense").textContent =
            avgExpense.toFixed(2);
          document.getElementById("metricHighest").textContent =
            highest.toFixed(2);
          document.getElementById("metricLowest").textContent =
            lowest.toFixed(2);
        }

        // ----- PAGINATION FUNCTIONS -----
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
          if (currentPage > 1) {
            goToPage(currentPage - 1);
          }
        }

        function nextPage() {
          const totalPages =
            rowsPerPage === "all"
              ? 1
              : Math.ceil(filteredData.length / rowsPerPage);
          if (currentPage < totalPages) {
            goToPage(currentPage + 1);
          }
        }

        // ----- TABS (type filter) -----
        document.querySelectorAll(".tab-btn").forEach((btn) => {
          btn.addEventListener("click", function () {
            document.querySelectorAll(".tab-btn").forEach((b) => {
              b.classList.remove("active-tab");
            });
            this.classList.add("active-tab");
            currentFilter = this.dataset.filter;
            currentPage = 1;
            renderTable();
          });
        });

        // ----- SETUP EVENT LISTENERS -----
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
        renderTable();
        updateStats();

        document.getElementById("sidebarUserName").textContent = "Accountant";
      })();
    </script>
  </body>
</html>
