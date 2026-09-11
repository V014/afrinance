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
      <!-- SIDEBAR (Accountant version) -->
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
          <a href="dashboard2.php" data-page="dashboard" class="active-link"><i class="fas fa-th-large"></i>
            Dashboard
          </a>
        </nav>

        <!-- BRANCHES -->
        <div class="nav-section">Branches</div>
        <nav class="nav-links">
          <a href="safalawo.php" data-page="safalawo"
            ><i class="fas fa-store-alt"></i> Safalawo</a
          >
          <a href="#" data-page="zambia"
            ><i class="fas fa-store-alt"></i> Zambia</a
          >
          <a href="#" data-page="makata"
            ><i class="fas fa-store-alt"></i> Makata</a
          >
        </nav>

        <!-- TOOLS -->
        <div class="nav-section">Tools</div>
        <nav class="nav-links">
          <a href="analytics.php" data-page="analytics"
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
          <!-- WELCOME CARD -->
          <div class="panel-card welcome-card">
            <div class="welcome-left">
              <h2>Accountant · <span id="dashUserName">Consolidated</span></h2>
            </div>
            <div class="welcome-center">
              <strong>Time:</strong> <span id="liveTime">--:--:--</span>
            </div>
            <div class="welcome-right">
              <strong>Day:</strong> <span id="liveDay">----</span>
            </div>
          </div>

          <!-- STATS CARDS -->
          <div class="stats-grid" id="statsGrid">
            <!-- Safalawo -->
            <div class="stat-card">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-store-alt"></i></span>
                <span class="stat-label">Safalawo</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Sales</span>
                <span class="detail-value" id="statSafalawoSales">0.00</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Expenses</span>
                <span class="detail-value" id="statSafalawoExpenses">0.00</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">This month's Net</span>
                <span class="detail-value" id="statSafalawo">0.00</span>
              </div>
            </div>

            <!-- Zambia -->
            <div class="stat-card">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-store-alt"></i></span>
                <span class="stat-label">Zambia</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Sales</span>
                <span class="detail-value" id="statZambiaSales">0.00</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Expenses</span>
                <span class="detail-value" id="statZambiaExpenses">0.00</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">This month's Net</span>
                <span class="detail-value" id="statZambia">0.00</span>
              </div>
            </div>

            <!-- Makata -->
            <div class="stat-card">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-store-alt"></i></span>
                <span class="stat-label">Makata</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Sales</span>
                <span class="detail-value" id="statMakataSales">0.00</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Expenses</span>
                <span class="detail-value" id="statMakataExpenses">0.00</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">This month's Net</span>
                <span class="detail-value" id="statMakata">0.00</span>
              </div>
            </div>

            <!-- Total Net -->
            <div class="stat-card branch-total">
              <div class="stat-header">
                <span class="stat-icon"><i class="fas fa-chart-pie"></i></span>
                <span class="stat-label">Total Net</span>
              </div>
              <div class="stat-detail">
                <span class="detail-label">Combined</span>
                <span class="detail-value" id="statTotal">0.00</span>
              </div>
              <div
                class="stat-detail"
                style="
                  border-bottom: none;
                  opacity: 0.5;
                  font-size: 0.65rem;
                  padding-top: 0.3rem;
                "
              >
                <span class="detail-label">Sales – Expenses</span>
                <span></span>
              </div>
            </div>
          </div>

          <!-- DROPDOWN FILTERS (centered) -->
          <div class="filters-container">
            <div class="filter-group">
              <label for="filterBranch">Branch</label>
              <select id="filterBranch">
                <option value="all">All Branches</option>
                <option value="safalawo">Safalawo</option>
                <option value="zambia">Zambia</option>
                <option value="makata">Makata</option>
              </select>
            </div>

            <div class="filter-group">
              <label for="filterType">Type</label>
              <select id="filterType">
                <option value="all">All Types</option>
                <option value="sale">Sale</option>
                <option value="expense">Expense</option>
              </select>
            </div>

            <div class="filter-group">
              <label for="filterCashier">Cashier</label>
              <select id="filterCashier">
                <option value="all">All Cashiers</option>
                <!-- populated by JS -->
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
                  <th>Branch</th>
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
              No records found
            </div>
          </div>

          <!-- PAGINATION CONTROLS -->
          <div class="pagination-container">
            <div class="rows-per-page">
              <label for="rowsPerPage">Rows per page:</label>
              <select id="rowsPerPage">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
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

        // ----- SAMPLE DATA -----
        // Generate more sample data for pagination testing
        const baseRecords = [
          // SAFALAWO
          {
            branch: "safalawo",
            type: "sale",
            cashier: "Grace Banda",
            amount: 1200,
            date: today,
            time: "09:15:00",
          },
          {
            branch: "safalawo",
            type: "sale",
            cashier: "Peter Mwale",
            amount: 800,
            date: today,
            time: "10:30:00",
          },
          {
            branch: "safalawo",
            type: "expense",
            cashier: "John Phiri",
            amount: 3500,
            date: today,
            time: "08:00:00",
          },
          {
            branch: "safalawo",
            type: "expense",
            cashier: "Mary Kachale",
            amount: 2800,
            date: today,
            time: "11:20:00",
          },
          // ZAMBIA
          {
            branch: "zambia",
            type: "sale",
            cashier: "David Zulu",
            amount: 1500,
            date: today,
            time: "09:45:00",
          },
          {
            branch: "zambia",
            type: "sale",
            cashier: "Sarah Lungu",
            amount: 2000,
            date: today,
            time: "14:10:00",
          },
          {
            branch: "zambia",
            type: "expense",
            cashier: "James Nyirenda",
            amount: 4200,
            date: today,
            time: "10:00:00",
          },
          {
            branch: "zambia",
            type: "expense",
            cashier: "Ester Tembo",
            amount: 15000,
            date: today,
            time: "13:30:00",
          },
          // MAKATA
          {
            branch: "makata",
            type: "sale",
            cashier: "Michael Banda",
            amount: 900,
            date: today,
            time: "11:00:00",
          },
          {
            branch: "makata",
            type: "sale",
            cashier: "Ruth Moyo",
            amount: 1100,
            date: today,
            time: "15:20:00",
          },
          {
            branch: "makata",
            type: "expense",
            cashier: "Joseph Kamanga",
            amount: 3500,
            date: today,
            time: "07:30:00",
          },
          {
            branch: "makata",
            type: "expense",
            cashier: "Linda Phakati",
            amount: 2800,
            date: today,
            time: "12:00:00",
          },
          // extra older
          {
            branch: "safalawo",
            type: "sale",
            cashier: "Grace Banda",
            amount: 600,
            date: "2026-07-30",
            time: "16:00:00",
          },
          {
            branch: "zambia",
            type: "expense",
            cashier: "James Nyirenda",
            amount: 4200,
            date: "2026-07-29",
            time: "09:00:00",
          },
          {
            branch: "makata",
            type: "sale",
            cashier: "Ruth Moyo",
            amount: 1300,
            date: "2026-07-28",
            time: "14:30:00",
          },
        ];

        // Add more records to test pagination
        const allRecords = [];
        for (let i = 0; i < 3; i++) {
          baseRecords.forEach((record) => {
            const newRecord = { ...record };
            if (i > 0) {
              const date = new Date();
              date.setDate(date.getDate() - i * 2);
              newRecord.date = date.toISOString().slice(0, 10);
              newRecord.time = `1${String(i).padStart(2, "0")}:30:00`;
              newRecord.amount = record.amount + i * 100;
            }
            allRecords.push(newRecord);
          });
        }

        // ----- POPULATE CASHIER DROPDOWN -----
        function populateCashierFilter() {
          const select = document.getElementById("filterCashier");
          const cashiers = [
            ...new Set(allRecords.map((r) => r.cashier)),
          ].sort();
          cashiers.forEach((cashier) => {
            const option = document.createElement("option");
            option.value = cashier;
            option.textContent = cashier;
            select.appendChild(option);
          });
        }
        populateCashierFilter();

        // ----- PAGINATION STATE -----
        let currentPage = 1;
        let rowsPerPage = 10;
        let filteredData = [];

        // ----- RENDER TABLE (with pagination) -----
        function renderTable() {
          const branchFilter = document.getElementById("filterBranch").value;
          const typeFilter = document.getElementById("filterType").value;
          const cashierFilter = document.getElementById("filterCashier").value;

          let filtered = allRecords;

          if (branchFilter !== "all") {
            filtered = filtered.filter((r) => r.branch === branchFilter);
          }
          if (typeFilter !== "all") {
            filtered = filtered.filter((r) => r.type === typeFilter);
          }
          if (cashierFilter !== "all") {
            filtered = filtered.filter((r) => r.cashier === cashierFilter);
          }

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
          const branchLabels = {
            safalawo: "Safalawo",
            zambia: "Zambia",
            makata: "Makata",
          };
          const branchClasses = {
            safalawo: "branch-safalawo",
            zambia: "branch-zambia",
            makata: "branch-makata",
          };

          let html = "";
          pageData.forEach((r, index) => {
            const rowNum = startIndex + index + 1;
            html += `<tr>
              <td class="row-number">${rowNum}</td>
              <td><span class="branch-badge ${branchClasses[r.branch]}">${branchLabels[r.branch]}</span></td>
              <td><span class="type-badge ${typeClasses[r.type]}">${typeLabels[r.type]}</span></td>
              <td>${r.cashier || "-"}</td>
              <td><strong>${r.amount.toFixed(2)}</strong></td>
              <td>${r.date}</td>
              <td>${r.time}</td>
            </tr>`;
          });
          tbody.innerHTML = html;
        }

        // ----- UPDATE STATS -----
        function updateStats() {
          const today = todayStr();
          const branches = ["safalawo", "zambia", "makata"];
          const branchData = {};

          branches.forEach((br) => {
            const sales = allRecords
              .filter(
                (r) => r.branch === br && r.type === "sale" && r.date === today,
              )
              .reduce((sum, r) => sum + r.amount, 0);
            const expenses = allRecords
              .filter(
                (r) =>
                  r.branch === br && r.type === "expense" && r.date === today,
              )
              .reduce((sum, r) => sum + r.amount, 0);
            branchData[br] = { sales, expenses, net: sales - expenses };
          });

          document.getElementById("statSafalawoSales").textContent =
            branchData.safalawo.sales.toFixed(2);
          document.getElementById("statSafalawoExpenses").textContent =
            branchData.safalawo.expenses.toFixed(2);
          document.getElementById("statSafalawo").textContent =
            branchData.safalawo.net.toFixed(2);

          document.getElementById("statZambiaSales").textContent =
            branchData.zambia.sales.toFixed(2);
          document.getElementById("statZambiaExpenses").textContent =
            branchData.zambia.expenses.toFixed(2);
          document.getElementById("statZambia").textContent =
            branchData.zambia.net.toFixed(2);

          document.getElementById("statMakataSales").textContent =
            branchData.makata.sales.toFixed(2);
          document.getElementById("statMakataExpenses").textContent =
            branchData.makata.expenses.toFixed(2);
          document.getElementById("statMakata").textContent =
            branchData.makata.net.toFixed(2);

          const totalNet =
            branchData.safalawo.net +
            branchData.zambia.net +
            branchData.makata.net;
          document.getElementById("statTotal").textContent =
            totalNet.toFixed(2);
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

        // ----- SETUP EVENT LISTENERS -----
        document
          .getElementById("filterBranch")
          .addEventListener("change", function () {
            currentPage = 1;
            renderTable();
          });
        document
          .getElementById("filterType")
          .addEventListener("change", function () {
            currentPage = 1;
            renderTable();
          });
        document
          .getElementById("filterCashier")
          .addEventListener("change", function () {
            currentPage = 1;
            renderTable();
          });

        document
          .getElementById("clearFilters")
          .addEventListener("click", function () {
            document.getElementById("filterBranch").value = "all";
            document.getElementById("filterType").value = "all";
            document.getElementById("filterCashier").value = "all";
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
        renderTable();
        updateStats();

        document.getElementById("sidebarUserName").textContent = "Accountant";
        document.getElementById("dashUserName").textContent = "Consolidated";
      })();
    </script>
  </body>
</html>
