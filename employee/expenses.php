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
    <link rel="stylesheet" href="css/expenses.css">
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
          <a href="dashboard.php" data-page="dashboard"
            ><i class="fas fa-th-large"></i> Dashboard</a
          >
          <a href="sales.php" data-page="add-sale"
            ><i class="fas fa-coins"></i> Sales</a
          >
          <a href="#" data-page="add-expense" class="active-link"
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
          <!-- WELCOME CARD -->
          <div class="panel-card welcome-card">
            <div class="welcome-left">
              <h2>Expenses · <span id="dashUserName">Cashier</span></h2>
            </div>
            <div class="welcome-center">
              <strong>Time:</strong> <span id="liveTime">--:--:--</span>
            </div>
            <div class="welcome-right">
              <strong>Day:</strong> <span id="liveDay">----</span>
            </div>
          </div>

          <!-- STATS CARDS -->
          <div class="grid grid-cols-1 sm:grid-cols-3">
            <div class="stat-card">
              <div class="stat-icon" style="color: var(--expenses)">
                <i class="fas fa-receipt"></i>
              </div>
              <div class="stat-value" id="dashTotalExpensesToday">0.00</div>
              <div class="stat-label">Today's Expenses</div>
            </div>
            <div class="stat-card">
              <div class="stat-icon" style="color: var(--expenses)">
                <i class="fas fa-chart-line"></i>
              </div>
              <div class="stat-value" id="dashTotalExpensesAll">0.00</div>
              <div class="stat-label">All-time Expenses</div>
            </div>
            <div class="stat-card">
              <div class="stat-icon" style="color: var(--expenses)">
                <i class="fas fa-list-ul"></i>
              </div>
              <div class="stat-value" id="dashExpensesCount">0</div>
              <div class="stat-label">Total Entries</div>
            </div>
          </div>

          <!-- ADD EXPENSE FORM (dedicated categories with fixed prices) -->
          <div class="form-card">
            <div class="form-group" style="flex: 1.2">
              <label for="expenseCategory">Type</label>
              <select id="expenseCategory">
                <option value="bearings">Bearings</option>
                <option value="drivebelts">Drive Belts</option>
                <option value="screens">Screens</option>
                <option value="engines">Engines / Motors</option>
              </select>
            </div>
            <div class="form-group" style="flex: 0.8">
              <label for="expenseUnits">Units</label>
              <input
                type="number"
                id="expenseUnits"
                placeholder="e.g. 2"
                value="1"
                min="0.5"
                step="0.5"
              />
            </div>
            <button class="btn-primary" id="addExpenseBtn">
              <i class="fas fa-plus-circle"></i> Add Expense
            </button>
          </div>

          <!-- EXPENSES TABLE -->
          <div class="table-wrapper">
            <table>
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Units</th>
                  <th>Amount (MWK)</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th style="text-align: center; width: 60px">Remove</th>
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
        </div>
      </main>
    </div>

    <script>
      (function () {
        "use strict";

        // ----- PRICE PER UNIT (MWK) for each category -----
        const PRICE_MAP = {
          bearings: 3500,
          drivebelts: 2800,
          screens: 4200,
          engines: 15000,
        };

        // category display names
        const CATEGORY_LABELS = {
          bearings: "Bearings",
          drivebelts: "Drive Belts",
          screens: "Screens",
          engines: "Engines / Motors",
        };

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

        // ----- SAMPLE DATA (expenses) -----
        let expenseRecords = [
          {
            id: 1,
            category: "bearings",
            units: 2,
            amount: 7000,
            date: today,
            time: "09:15:30",
          },
          {
            id: 2,
            category: "drivebelts",
            units: 1.5,
            amount: 4200,
            date: today,
            time: "10:45:12",
          },
          {
            id: 3,
            category: "screens",
            units: 1,
            amount: 4200,
            date: today,
            time: "14:20:05",
          },
          {
            id: 4,
            category: "engines",
            units: 1,
            amount: 15000,
            date: today,
            time: "16:00:00",
          },
        ];
        let nextId = 5;

        // ----- RENDER TABLE -----
        function renderExpenses() {
          const tbody = document.getElementById("tableBody");
          const empty = document.getElementById("emptyState");

          const sorted = [...expenseRecords].sort((a, b) =>
            b.time.localeCompare(a.time),
          );

          if (sorted.length === 0) {
            tbody.innerHTML = "";
            empty.style.display = "block";
            return;
          }
          empty.style.display = "none";

          let html = "";
          sorted.forEach((r) => {
            const label = CATEGORY_LABELS[r.category] || r.category;
            html += `<tr data-id="${r.id}">
          <td><span class="type-badge">${label}</span></td>
          <td>${r.units}</td>
          <td><strong>${r.amount.toFixed(2)}</strong></td>
          <td>${r.date}</td>
          <td>${r.time}</td>
          <td style="text-align:center;">
            <button class="btn-remove" data-id="${r.id}" title="Remove expense"><i class="fas fa-trash-alt"></i></button>
          </td>
        </tr>`;
          });
          tbody.innerHTML = html;

          // attach remove events
          document.querySelectorAll(".btn-remove").forEach((btn) => {
            btn.addEventListener("click", function (e) {
              e.stopPropagation();
              const id = parseInt(this.dataset.id, 10);
              removeExpenseById(id);
            });
          });
        }

        // ----- REMOVE -----
        function removeExpenseById(id) {
          const idx = expenseRecords.findIndex((r) => r.id === id);
          if (idx === -1) return;
          expenseRecords.splice(idx, 1);
          renderExpenses();
          updateStats();
        }

        // ----- UPDATE STATS -----
        function updateStats() {
          const today = todayStr();
          const todayTotal = expenseRecords
            .filter((r) => r.date === today)
            .reduce((sum, r) => sum + r.amount, 0);
          const allTotal = expenseRecords.reduce((sum, r) => sum + r.amount, 0);
          const count = expenseRecords.length;

          document.getElementById("dashTotalExpensesToday").textContent =
            todayTotal.toFixed(2);
          document.getElementById("dashTotalExpensesAll").textContent =
            allTotal.toFixed(2);
          document.getElementById("dashExpensesCount").textContent = count;
        }

        // ----- ADD EXPENSE (amount auto-calculated from category price * units) -----
        function addExpense() {
          const category = document.getElementById("expenseCategory").value;
          const unitsInput = document.getElementById("expenseUnits");
          const units = parseFloat(unitsInput.value);

          if (isNaN(units) || units <= 0) {
            alert("Please enter a valid number of units (e.g. 1, 1.5, 2).");
            return;
          }

          const pricePerUnit = PRICE_MAP[category] || 0;
          if (pricePerUnit === 0) {
            alert("Price not defined for this category.");
            return;
          }

          const amount = units * pricePerUnit;
          const date = todayStr();
          const now = new Date();
          const time = now.toTimeString().slice(0, 8);

          expenseRecords.push({
            id: nextId++,
            category: category,
            units: units,
            amount: amount,
            date: date,
            time: time,
          });

          // reset units to 1, keep category as is
          unitsInput.value = "1";

          renderExpenses();
          updateStats();
        }

        // ----- EVENT LISTENERS -----
        document
          .getElementById("addExpenseBtn")
          .addEventListener("click", addExpense);
        document
          .getElementById("expenseUnits")
          .addEventListener("keydown", (e) => {
            if (e.key === "Enter") addExpense();
          });

        // ----- INIT -----
        renderExpenses();
        updateStats();

        document.getElementById("sidebarUserName").textContent = "Cashier";
        document.getElementById("dashUserName").textContent = "Cashier";
      })();
    </script>
  </body>
</html>
