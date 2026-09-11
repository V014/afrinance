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
    <link rel="stylesheet" href="css/safalawosales.css">
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
          <!-- Today's Sales -->
          <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-coins"></i></div>
            <div class="stat-value" id="statTodaySales">0.00</div>
            <div class="stat-label">Today's Sales</div>
          </div>

          <!-- This Month's Sales -->
          <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
            <div class="stat-value" id="statMonthSales">0.00</div>
            <div class="stat-label">This Month's Sales</div>
          </div>

          <!-- % of Target Reached (Monthly Target: MWK 500,000) -->
          <div class="stat-card target-card">
            <div class="stat-icon"><i class="fas fa-bullseye"></i></div>
            <div class="stat-value" id="statTargetPercent">0%</div>
            <div class="stat-label">% of Target Reached</div>
            <div class="stat-sub">Monthly Target: MWK 500,000</div>
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
            <label for="filterType">Type</label>
            <select id="filterType">
              <option value="all">All Types</option>
              <option value="milling">Milling</option>
              <option value="shelling">Shelling</option>
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
                <th>Type</th>
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
            No sales recorded yet
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
          milling: 500,
          shelling: 1000,
        };

        // ----- LIVE CLOCK -----
        function updateClock() {
          const now = new Date();
          // No clock display needed, but keeping for consistency
        }
        updateClock();
        setInterval(updateClock, 1000);

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
        let salesRecords = [
          {
            id: 1,
            type: "milling",
            cashier: "Grace Banda",
            units: 2,
            amount: 1000,
            date: today,
            time: "09:15:00",
          },
          {
            id: 2,
            type: "shelling",
            cashier: "Peter Mwale",
            units: 1.5,
            amount: 1500,
            date: today,
            time: "10:30:00",
          },
          {
            id: 3,
            type: "milling",
            cashier: "David Zulu",
            units: 3,
            amount: 1500,
            date: today,
            time: "14:45:00",
          },
          {
            id: 4,
            type: "shelling",
            cashier: "Sarah Lungu",
            units: 2,
            amount: 2000,
            date: today,
            time: "16:10:00",
          },
          {
            id: 5,
            type: "milling",
            cashier: "Grace Banda",
            units: 1,
            amount: 500,
            date: "2026-07-30",
            time: "11:30:00",
          },
          {
            id: 6,
            type: "shelling",
            cashier: "Ruth Moyo",
            units: 1,
            amount: 1000,
            date: "2026-07-29",
            time: "10:00:00",
          },
          {
            id: 7,
            type: "milling",
            cashier: "Michael Banda",
            units: 4,
            amount: 2000,
            date: "2026-07-25",
            time: "13:00:00",
          },
          {
            id: 8,
            type: "shelling",
            cashier: "Linda Phakati",
            units: 3,
            amount: 3000,
            date: "2026-07-20",
            time: "11:00:00",
          },
        ];

        // ----- POPULATE CASHIER DROPDOWN -----
        function populateCashierFilter() {
          const select = document.getElementById("filterCashier");
          const cashiers = [
            ...new Set(salesRecords.map((r) => r.cashier)),
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
          const typeFilter = document.getElementById("filterType").value;
          const cashierFilter = document.getElementById("filterCashier").value;

          let filtered = salesRecords;

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

          const typeLabels = { milling: "Milling", shelling: "Shelling" };

          let html = "";
          pageData.forEach((r, index) => {
            const rowNum = startIndex + index + 1;
            html += `<tr>
              <td style="text-align: center; opacity: 0.5;">${rowNum}</td>
              <td><span class="type-badge">${typeLabels[r.type]}</span></td>
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

          // Today's sales
          const todaySales = salesRecords
            .filter((r) => r.date === today)
            .reduce((sum, r) => sum + r.amount, 0);

          // This month's sales
          const monthSales = salesRecords
            .filter((r) => r.date >= monthStart && r.date <= monthEnd)
            .reduce((sum, r) => sum + r.amount, 0);

          // Target percentage
          const target = 500000;
          const percent = Math.min((monthSales / target) * 100, 100);
          const percentDisplay = percent.toFixed(1);

          document.getElementById("statTodaySales").textContent =
            todaySales.toFixed(2);
          document.getElementById("statMonthSales").textContent =
            monthSales.toFixed(2);

          const targetEl = document.getElementById("statTargetPercent");
          targetEl.textContent = percentDisplay + "%";
          targetEl.className = "stat-value";
          if (percent >= 100) {
            targetEl.classList.add("high");
          } else if (percent < 30) {
            targetEl.classList.add("low");
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
      })();
    </script>
  </body>
</html>
