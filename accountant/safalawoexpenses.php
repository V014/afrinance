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
    <link rel="stylesheet" href="css/safalawoexpenses.css">
  </head>
  <body>
    <!-- MAIN CONTENT (no sidebar) -->
    <main class="main-content">
      <div class="content-wrapper">
        <!-- BACK BUTTON -->
        <div class="back-button-container">
          <a href="safalawo.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Safalawo
          </a>
        </div>

        <!-- STATS CARDS -->
        <div class="stats-grid">
          <!-- Today's Expenses -->
          <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-receipt"></i></div>
            <div class="stat-value" id="statTodayExpenses">0.00</div>
            <div class="stat-label">Today's Expenses</div>
          </div>

          <!-- This Month's Expenses -->
          <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
            <div class="stat-value" id="statMonthExpenses">0.00</div>
            <div class="stat-label">This Month's Expenses</div>
          </div>

          <!-- % of Budget Used (Monthly Budget: MWK 300,000) -->
          <div class="stat-card budget-card">
            <div class="stat-icon"><i class="fas fa-chart-pie"></i></div>
            <div class="stat-value" id="statBudgetPercent">0%</div>
            <div class="stat-label">% of Budget Used</div>
            <div class="stat-sub">Monthly Budget: MWK 300,000</div>
            <div class="progress-bar">
              <div
                class="progress-fill"
                id="progressFill"
                style="width: 0%"
              ></div>
            </div>
          </div>
        </div>

        <!-- FILTERS -->
        <div class="filters-container">
          <div class="filter-group">
            <label for="filterCategory">Category</label>
            <select id="filterCategory">
              <option value="all">All Categories</option>
              <option value="bearings">Bearings</option>
              <option value="drivebelts">Drive Belts</option>
              <option value="screens">Screens</option>
              <option value="engines">Engines / Motors</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="filterCashier">Cashier</label>
            <select id="filterCashier">
              <option value="all">All Cashiers</option>
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
                <th>Category</th>
                <th>Cashier</th>
                <th>Units</th>
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
            No expenses recorded yet
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

    <script>
      (function () {
        "use strict";

        // ----- PRICES -----
        const PRICES = {
          bearings: 3500,
          drivebelts: 2800,
          screens: 4200,
          engines: 15000,
        };

        const CATEGORY_LABELS = {
          bearings: "Bearings",
          drivebelts: "Drive Belts",
          screens: "Screens",
          engines: "Engines / Motors",
        };

        // ----- HELPERS -----
        function todayStr() {
          return new Date().toISOString().slice(0, 10);
        }
        const today = todayStr();

        function getMonthStart() {
          const d = new Date();
          return new Date(d.getFullYear(), d.getMonth(), 1)
            .toISOString()
            .slice(0, 10);
        }

        function getMonthEnd() {
          const d = new Date();
          return new Date(d.getFullYear(), d.getMonth() + 1, 0)
            .toISOString()
            .slice(0, 10);
        }

        // ----- DATA -----
        let expenseRecords = [
          {
            id: 1,
            category: "bearings",
            cashier: "John Phiri",
            units: 2,
            amount: 7000,
            date: today,
            time: "08:00:00",
          },
          {
            id: 2,
            category: "drivebelts",
            cashier: "Mary Kachale",
            units: 1.5,
            amount: 4200,
            date: today,
            time: "11:20:00",
          },
          {
            id: 3,
            category: "screens",
            cashier: "James Nyirenda",
            units: 1,
            amount: 4200,
            date: today,
            time: "10:00:00",
          },
          {
            id: 4,
            category: "engines",
            cashier: "Joseph Kamanga",
            units: 1,
            amount: 15000,
            date: today,
            time: "13:30:00",
          },
          {
            id: 5,
            category: "bearings",
            cashier: "Ester Tembo",
            units: 1,
            amount: 3500,
            date: "2026-07-30",
            time: "09:00:00",
          },
          {
            id: 6,
            category: "drivebelts",
            cashier: "Linda Phakati",
            units: 1,
            amount: 2800,
            date: "2026-07-29",
            time: "14:30:00",
          },
          {
            id: 7,
            category: "screens",
            cashier: "Peter Mwale",
            units: 2,
            amount: 8400,
            date: "2026-07-25",
            time: "10:00:00",
          },
          {
            id: 8,
            category: "engines",
            cashier: "Grace Banda",
            units: 1,
            amount: 15000,
            date: "2026-07-20",
            time: "09:00:00",
          },
        ];

        // ----- POPULATE CASHIER DROPDOWN -----
        function populateCashierFilter() {
          const select = document.getElementById("filterCashier");
          const cashiers = [
            ...new Set(expenseRecords.map((r) => r.cashier)),
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

        // ----- RENDER TABLE -----
        function renderTable() {
          const categoryFilter =
            document.getElementById("filterCategory").value;
          const cashierFilter = document.getElementById("filterCashier").value;

          let filtered = expenseRecords;

          if (categoryFilter !== "all") {
            filtered = filtered.filter((r) => r.category === categoryFilter);
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

          let html = "";
          pageData.forEach((r, index) => {
            const rowNum = startIndex + index + 1;
            html += `<tr>
              <td style="text-align: center; opacity: 0.5;">${rowNum}</td>
              <td><span class="type-badge">${CATEGORY_LABELS[r.category]}</span></td>
              <td>${r.cashier || "-"}</td>
              <td>${r.units}</td>
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
          const monthStart = getMonthStart();
          const monthEnd = getMonthEnd();

          // Today's expenses
          const todayExpenses = expenseRecords
            .filter((r) => r.date === today)
            .reduce((sum, r) => sum + r.amount, 0);

          // This month's expenses
          const monthExpenses = expenseRecords
            .filter((r) => r.date >= monthStart && r.date <= monthEnd)
            .reduce((sum, r) => sum + r.amount, 0);

          // Budget percentage
          const budget = 300000;
          const percent = Math.min((monthExpenses / budget) * 100, 100);
          const percentDisplay = percent.toFixed(1);

          document.getElementById("statTodayExpenses").textContent =
            todayExpenses.toFixed(2);
          document.getElementById("statMonthExpenses").textContent =
            monthExpenses.toFixed(2);

          const budgetEl = document.getElementById("statBudgetPercent");
          budgetEl.textContent = percentDisplay + "%";
          budgetEl.className = "stat-value";
          if (percent >= 90) {
            budgetEl.classList.add("high");
          } else if (percent < 50) {
            budgetEl.classList.add("low");
          }

          document.getElementById("progressFill").style.width = percent + "%";
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
          .getElementById("filterCategory")
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
            document.getElementById("filterCategory").value = "all";
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
      })();
    </script>
  </body>
</html>
