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
    <link rel="stylesheet" href="css/sales.css">
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
          <a href="sales.php" data-page="add-sale" class="active-link"
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
          <!-- WELCOME CARD -->
          <div class="panel-card welcome-card">
            <div class="welcome-left">
              <h2>Sales · <span id="dashUserName">Cashier</span></h2>
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
              <div class="stat-icon" style="color: var(--sales)">
                <i class="fas fa-coins"></i>
              </div>
              <div class="stat-value" id="dashTotalSales">0.00</div>
              <div class="stat-label">Today's Sales</div>
            </div>
            <div class="stat-card">
              <div class="stat-icon" style="color: var(--sales)">
                <i class="fas fa-chart-line"></i>
              </div>
              <div class="stat-value" id="dashTotalSalesAll">0.00</div>
              <div class="stat-label">All-time Sales</div>
            </div>
            <div class="stat-card">
              <div class="stat-icon" style="color: var(--sales)">
                <i class="fas fa-list-ul"></i>
              </div>
              <div class="stat-value" id="dashSalesCount">0</div>
              <div class="stat-label">Total Sales Entries</div>
            </div>
          </div>

          <!-- ADD SALE FORM (date + amount inputs removed) -->
          <div class="form-card">
            <div class="form-group" style="flex: 1">
              <label for="saleType">Type</label>
              <select id="saleType">
                <option value="mill">Milling</option>
                <option value="shell">Shelling</option>
              </select>
            </div>
            <div class="form-group" style="flex: 1">
              <label for="saleUnits">Units</label>
              <input
                type="number"
                id="saleUnits"
                placeholder="e.g. 2"
                value="1"
                min="0.5"
                step="0.5"
              />
            </div>
            <button class="btn-primary" id="addSaleBtn">
              <i class="fas fa-plus-circle"></i> Add Sale
            </button>
          </div>

          <!-- SALES TABLE -->
          <div class="table-wrapper">
            <table>
              <thead>
                <tr>
                  <th>Type</th>
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
              No sales recorded yet
            </div>
          </div>
        </div>
      </main>
    </div>

    <script>
      (function () {
        "use strict";

        // ----- PRICES -----
        const PRICES = {
          mill: 500, // MWK per unit (5L bucket)
          shell: 1000,
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

        // ----- DATA -----
        function todayStr() {
          return new Date().toISOString().slice(0, 10);
        }
        const today = todayStr();

        let salesRecords = [
          {
            id: 1,
            type: "mill",
            units: 2,
            amount: 1000,
            date: today,
            time: "12:30:15",
          },
          {
            id: 2,
            type: "shell",
            units: 1.5,
            amount: 1500,
            date: today,
            time: "13:45:22",
          },
          {
            id: 3,
            type: "mill",
            units: 3,
            amount: 1500,
            date: today,
            time: "15:10:00",
          },
          {
            id: 4,
            type: "shell",
            units: 2,
            amount: 2000,
            date: today,
            time: "11:20:10",
          },
        ];
        let nextId = 5;

        // ----- AUTO-CALCULATE AMOUNT (internal only, no display) -----
        function calculateAmount() {
          const type = document.getElementById("saleType").value;
          const units =
            parseFloat(document.getElementById("saleUnits").value) || 0;
          const price = PRICES[type] || 0;
          return units * price;
        }

        // ----- RENDER TABLE -----
        function renderSales() {
          const tbody = document.getElementById("tableBody");
          const empty = document.getElementById("emptyState");

          const sorted = [...salesRecords].sort((a, b) =>
            b.time.localeCompare(a.time),
          );

          if (sorted.length === 0) {
            tbody.innerHTML = "";
            empty.style.display = "block";
            return;
          }
          empty.style.display = "none";

          let html = "";
          const typeLabels = { mill: "Milling", shell: "Shelling" };
          const typeClasses = { mill: "mill", shell: "shell" };
          sorted.forEach((r) => {
            html += `<tr data-id="${r.id}">
              <td><span class="type-badge ${typeClasses[r.type]}">${typeLabels[r.type]}</span></td>
              <td>${r.units}</td>
              <td><strong>${r.amount.toFixed(2)}</strong></td>
              <td>${r.date}</td>
              <td>${r.time}</td>
              <td style="text-align:center;">
                <button class="btn-remove" data-id="${r.id}" title="Remove sale"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>`;
          });
          tbody.innerHTML = html;

          document.querySelectorAll(".btn-remove").forEach((btn) => {
            btn.addEventListener("click", function (e) {
              e.stopPropagation();
              const id = parseInt(this.dataset.id, 10);
              removeSaleById(id);
            });
          });
        }

        // ----- REMOVE -----
        function removeSaleById(id) {
          const index = salesRecords.findIndex((r) => r.id === id);
          if (index === -1) return;
          salesRecords.splice(index, 1);
          renderSales();
          updateStats();
        }

        // ----- UPDATE STATS -----
        function updateStats() {
          const today = todayStr();
          const todaySales = salesRecords
            .filter((r) => r.date === today)
            .reduce((sum, r) => sum + r.amount, 0);
          const allSales = salesRecords.reduce((sum, r) => sum + r.amount, 0);
          const count = salesRecords.length;

          document.getElementById("dashTotalSales").textContent =
            todaySales.toFixed(2);
          document.getElementById("dashTotalSalesAll").textContent =
            allSales.toFixed(2);
          document.getElementById("dashSalesCount").textContent = count;
        }

        // ----- ADD SALE (date + amount auto, no inputs) -----
        function addSale() {
          const type = document.getElementById("saleType").value;
          const unitsInput = document.getElementById("saleUnits");

          const units = parseFloat(unitsInput.value);
          if (isNaN(units) || units <= 0) {
            alert("Please enter a valid number of units (e.g. 1, 1.5, 2).");
            return;
          }

          // Calculate amount from price
          const price = PRICES[type];
          const amount = units * price;

          // Date is always today
          const date = todayStr();

          const now = new Date();
          const time = now.toTimeString().slice(0, 8);

          salesRecords.push({
            id: nextId++,
            type: type,
            units: units,
            amount: amount,
            date: date,
            time: time,
          });

          // Reset form: keep type, reset units to 1
          unitsInput.value = "1";

          renderSales();
          updateStats();
        }

        // ----- SETUP -----

        // ----- EVENT LISTENERS -----
        document
          .getElementById("addSaleBtn")
          .addEventListener("click", addSale);

        // Enter key on units triggers add
        document
          .getElementById("saleUnits")
          .addEventListener("keydown", (e) => {
            if (e.key === "Enter") addSale();
          });

        // ----- INIT -----
        renderSales();
        updateStats();

        document.getElementById("sidebarUserName").textContent = "Cashier";
        document.getElementById("dashUserName").textContent = "Cashier";
      })();
    </script>
  </body>
</html>
