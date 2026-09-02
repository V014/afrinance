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
    <!-- html2pdf library for PDF generation -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
      integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <style>
      /* ----- THEME (same as dashboard) ----- */
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

      /* ----- SIDEBAR ----- */
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

      /* ----- WELCOME CARD ----- */
      .welcome-card {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        gap: 10px;
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

      /* ----- STAT CARDS (summary) ----- */
      .stat-card {
        padding: 1.5rem;
        border-radius: var(--border-radius);
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
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

      .grid {
        display: grid;
        gap: 1rem;
      }
      .grid-cols-1 {
        grid-template-columns: 1fr;
      }
      @media (min-width: 640px) {
        .sm\:grid-cols-3 {
          grid-template-columns: repeat(3, 1fr);
        }
      }

      /* ----- FILTER BAR ----- */
      .filter-bar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 1rem 1.5rem;
        margin: 1.5rem 0 1rem;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
      }
      .filter-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
      }
      .filter-group label {
        font-weight: 500;
        opacity: 0.7;
        font-size: 0.85rem;
      }
      .filter-group select,
      .filter-group input {
        background: var(--bg-color);
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 0.4rem 0.8rem;
        color: var(--text-color);
        font-size: 0.9rem;
      }
      .filter-group select:focus,
      .filter-group input:focus {
        outline: 2px solid var(--accent-color);
        outline-offset: 1px;
      }

      .btn-pdf {
        background: var(--accent-color);
        border: none;
        padding: 0.5rem 1.8rem;
        border-radius: 30px;
        font-weight: 700;
        color: #1a1a1a;
        cursor: pointer;
        font-size: 0.95rem;
        transition:
          transform 0.1s,
          box-shadow 0.1s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
      }
      .btn-pdf:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 12px rgba(61, 220, 132, 0.3);
      }
      .btn-pdf-secondary {
        background: var(--accent-color);
        color: #1a1a1a;
      }
      .btn-pdf-secondary:hover {
        box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
      }

      /* ----- TABLE (same style as other pages) ----- */
      .table-wrapper {
        /* border-radius: var(--border-radius); */
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
        /* border-radius: var(--border-radius); */
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
        vertical-align: middle;
      }
      tr:last-child td {
        border-bottom: none;
      }
      .empty-state {
        text-align: center;
        padding: 2rem;
        opacity: 0.5;
      }
      .type-badge {
        display: inline-block;
        padding: 0.15rem 0.7rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        background: var(--bg-color);
      }
      .type-sale {
        color: var(--sales);
      }
      .type-expense {
        color: var(--expenses);
      }

      /* mobile */
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
        .filter-bar {
          flex-direction: column;
          align-items: stretch;
        }
        .filter-group {
          justify-content: center;
        }
        .btn-pdf {
          justify-content: center;
        }
      }

      /* ----- PDF SPECIFIC STYLES (improved readability) ----- */
      #pdfContent {
        background: white;
        padding: 2rem 1.8rem;
        border-radius: 8px;
        font-family:
          "Inter",
          system-ui,
          -apple-system,
          sans-serif;
        color: #1a1a1a;
        line-height: 1.5;
      }
      #pdfContent h2 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #0a0a0a;
        letter-spacing: -0.02em;
      }
      #pdfContent .pdf-sub {
        margin-bottom: 1.5rem;
        opacity: 0.6;
        font-size: 0.9rem;
        border-bottom: 1px solid #eaeaea;
        padding-bottom: 0.5rem;
      }
      .pdf-stats {
        display: flex;
        gap: 2rem;
        margin-bottom: 1.8rem;
        flex-wrap: wrap;
        /* background: #f5f8f5; */
        padding: 0.8rem 1.5rem;
        border-radius: 10px;
        /* border-left: 4px solid #3ddc84; */
      }
      .pdf-stats div {
        font-size: 0.8rem;
        font-weight: 500;
      }
      .pdf-stats div span {
        font-weight: 700;
        color: #0f2b1a;
      }
      #pdfContent table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        border: 1px solid #d0d5d0;
      }
      #pdfContent th {
        background: #eaeaea;
        font-weight: 600;
        padding: 0.7rem 0.8rem;
        border: 1px solid #c0c5c0;
        color: #0a0a0a;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.03em;
      }
      #pdfContent td {
        padding: 0.6rem 0.8rem;
        border: 1px solid #d0d5d0;
        color: #1a1a1a;
        background: #fcfcfc;
      }
      #pdfContent tr:nth-child(even) td {
        background: #f6f8f6;
      }
      #pdfContent .pdf-footer {
        margin-top: 1.5rem;
        font-size: 0.75rem;
        opacity: 0.5;
        text-align: right;
        border-top: 1px solid #eaeaea;
        padding-top: 0.8rem;
      }
      /* ensure PDF container is hidden by default */
      #pdfContainer {
        display: none;
      }
    </style>
  </head>
  <body>
    <div class="app-layout">
      <!-- SIDEBAR (reports replaces debts) -->
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
          <a href="expenses.php" data-page="add-expense"
            ><i class="fas fa-receipt"></i> Expenses</a
          >
          <a href="reports.php" data-page="reports" class="active-link"
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
              <h2>Reports · <span id="dashUserName">Cashier</span></h2>
            </div>
            <div class="welcome-center">
              <strong>Time:</strong> <span id="liveTime">--:--:--</span>
            </div>
            <div class="welcome-right">
              <strong>Day:</strong> <span id="liveDay">----</span>
            </div>
          </div>

          <!-- SUMMARY STATS -->
          <div class="grid grid-cols-1 sm:grid-cols-3">
            <div class="stat-card">
              <div class="stat-icon" style="color: var(--sales)">
                <i class="fas fa-coins"></i>
              </div>
              <div class="stat-value" id="reportTotalSales">0.00</div>
              <div class="stat-label">Total Sales</div>
            </div>
            <div class="stat-card">
              <div class="stat-icon" style="color: var(--expenses)">
                <i class="fas fa-receipt"></i>
              </div>
              <div class="stat-value" id="reportTotalExpenses">0.00</div>
              <div class="stat-label">Total Expenses</div>
            </div>
            <div class="stat-card">
              <div class="stat-icon" style="color: var(--sales)">
                <i class="fas fa-chart-pie"></i>
              </div>
              <div class="stat-value" id="reportNetProfit">0.00</div>
              <div class="stat-label">Net (Sales - Expenses)</div>
            </div>
          </div>

          <!-- FILTER BAR (with PDF button) -->
          <div class="filter-bar">
            <div class="filter-group">
              <label for="filterType">Type</label>
              <select id="filterType">
                <option value="all">All</option>
                <option value="sale">Sales</option>
                <option value="expense">Expenses</option>
              </select>
            </div>
            <div class="filter-group">
              <label for="filterDateFrom">From</label>
              <input type="date" id="filterDateFrom" />
            </div>
            <div class="filter-group">
              <label for="filterDateTo">To</label>
              <input type="date" id="filterDateTo" />
            </div>
            <button class="btn-pdf" id="applyFilterBtn">Apply</button>
            <!-- Generate PDF button -->
            <button class="btn-pdf btn-pdf-secondary" id="generatePdfBtn">
              </i> Generate PDF
            </button>
          </div>

          <!-- TABLE -->
          <div class="table-wrapper" id="reportTableWrapper">
            <div id="reportContent">
              <h3 style="margin-bottom: 0.5rem; opacity: 0.7">
                Sales &amp; Expenses Report
              </h3>
              <table>
                <thead>
                  <tr>
                    <th>Type</th>
                    <th>Description</th>
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
                No records match the filter
              </div>
            </div>
          </div>

          <!-- hidden PDF container (used for export) -->
          <div id="pdfContainer">
            <div id="pdfContent">
              <h2>Afrinance – Report</h2>
              <div class="pdf-sub">
                Generated: <span id="pdfGenDate"></span>
              </div>
              <div class="pdf-stats" id="pdfStats">
                <div>Total Sales: <span id="pdfTotalSales">0.00</span> MWK</div>
                <div>
                  Total Expenses: <span id="pdfTotalExpenses">0.00</span> MWK
                </div>
                <div>Net: <span id="pdfNetProfit">0.00</span> MWK</div>
              </div>
              <table id="pdfTable">
                <thead>
                  <tr>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Units</th>
                    <th>Amount (MWK)</th>
                    <th>Date</th>
                    <th>Time</th>
                  </tr>
                </thead>
                <tbody id="pdfTableBody"></tbody>
              </table>
              <div class="pdf-footer">
                Report generated from filtered data
              </div>
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

        // ----- DATA (sales + expenses only, with units) -----
        function todayStr() {
          return new Date().toISOString().slice(0, 10);
        }
        const today = todayStr();

        // Sales records (with units and type detail)
        const salesRecords = [
          {
            type: "sale",
            description: "Milling - Alice",
            units: 2,
            amount: 1000,
            date: today,
            time: "12:30:15",
          },
          {
            type: "sale",
            description: "Shelling - Bob",
            units: 1.5,
            amount: 1500,
            date: today,
            time: "13:45:22",
          },
          {
            type: "sale",
            description: "Milling - Carol",
            units: 3,
            amount: 1500,
            date: today,
            time: "15:10:00",
          },
          {
            type: "sale",
            description: "Shelling - David",
            units: 2,
            amount: 2000,
            date: today,
            time: "11:20:10",
          },
          {
            type: "sale",
            description: "Milling - Eve",
            units: 1,
            amount: 500,
            date: "2026-08-01",
            time: "09:00:00",
          },
          {
            type: "sale",
            description: "Shelling - Frank",
            units: 2.5,
            amount: 2500,
            date: "2026-08-02",
            time: "14:30:00",
          },
        ];

        // Expense records (with units and category)
        const expenseRecords = [
          {
            type: "expense",
            description: "Bearings",
            units: 2,
            amount: 7000,
            date: today,
            time: "09:15:30",
          },
          {
            type: "expense",
            description: "Drive Belts",
            units: 1.5,
            amount: 4200,
            date: today,
            time: "10:45:12",
          },
          {
            type: "expense",
            description: "Screens",
            units: 1,
            amount: 4200,
            date: today,
            time: "14:20:05",
          },
          {
            type: "expense",
            description: "Engines / Motors",
            units: 1,
            amount: 15000,
            date: today,
            time: "16:00:00",
          },
          {
            type: "expense",
            description: "Bearings",
            units: 1,
            amount: 3500,
            date: "2026-08-01",
            time: "08:30:00",
          },
          {
            type: "expense",
            description: "Screens",
            units: 2,
            amount: 8400,
            date: "2026-08-02",
            time: "11:00:00",
          },
        ];

        // Combine all records
        let allRecords = [...salesRecords, ...expenseRecords];

        // ----- FILTER STATE -----
        let currentFilter = { type: "all", from: "", to: "" };
        let currentFilteredData = [];

        // ----- RENDER TABLE (also stores filtered data for PDF) -----
        function renderTable(filter) {
          const tbody = document.getElementById("tableBody");
          const empty = document.getElementById("emptyState");

          let filtered = [...allRecords];

          if (filter.type && filter.type !== "all") {
            filtered = filtered.filter((r) => r.type === filter.type);
          }
          if (filter.from) {
            filtered = filtered.filter((r) => r.date >= filter.from);
          }
          if (filter.to) {
            filtered = filtered.filter((r) => r.date <= filter.to);
          }

          filtered.sort(
            (a, b) => (a.date + a.time).localeCompare(b.date + b.time) * -1,
          );

          currentFilteredData = filtered; // store for PDF

          if (filtered.length === 0) {
            tbody.innerHTML = "";
            empty.style.display = "block";
            document.getElementById("reportTotalSales").textContent = "0.00";
            document.getElementById("reportTotalExpenses").textContent = "0.00";
            document.getElementById("reportNetProfit").textContent = "0.00";
            return;
          }
          empty.style.display = "none";

          const typeLabels = { sale: "Sale", expense: "Expense" };
          const typeClasses = { sale: "type-sale", expense: "type-expense" };

          let html = "";
          filtered.forEach((r) => {
            html += `<tr>
                        <td><span class="type-badge ${typeClasses[r.type]}">${typeLabels[r.type]}</span></td>
                        <td>${r.description || ""}</td>
                        <td>${r.units || "-"}</td>
                        <td><strong>${r.amount.toFixed(2)}</strong></td>
                        <td>${r.date}</td>
                        <td>${r.time}</td>
                    </tr>`;
          });
          tbody.innerHTML = html;

          const totalSales = filtered
            .filter((r) => r.type === "sale")
            .reduce((s, r) => s + r.amount, 0);
          const totalExpenses = filtered
            .filter((r) => r.type === "expense")
            .reduce((s, r) => s + r.amount, 0);
          const net = totalSales - totalExpenses;

          document.getElementById("reportTotalSales").textContent =
            totalSales.toFixed(2);
          document.getElementById("reportTotalExpenses").textContent =
            totalExpenses.toFixed(2);
          document.getElementById("reportNetProfit").textContent =
            net.toFixed(2);
        }

        // ----- APPLY FILTER (from UI) -----
        function applyFilter() {
          const type = document.getElementById("filterType").value;
          const from = document.getElementById("filterDateFrom").value;
          const to = document.getElementById("filterDateTo").value;
          currentFilter = { type, from, to };
          renderTable(currentFilter);
        }

        // ----- GENERATE PDF (using html2pdf) with improved styling -----
        function generatePDF() {
          if (currentFilteredData.length === 0) {
            alert("No data to export. Please adjust filters.");
            return;
          }

          // prepare PDF container with current data
          const pdfTableBody = document.getElementById("pdfTableBody");
          const pdfTotalSales = document.getElementById("pdfTotalSales");
          const pdfTotalExpenses = document.getElementById("pdfTotalExpenses");
          const pdfNetProfit = document.getElementById("pdfNetProfit");
          const pdfGenDate = document.getElementById("pdfGenDate");

          pdfTotalSales.textContent =
            document.getElementById("reportTotalSales").textContent;
          pdfTotalExpenses.textContent = document.getElementById(
            "reportTotalExpenses",
          ).textContent;
          pdfNetProfit.textContent =
            document.getElementById("reportNetProfit").textContent;
          pdfGenDate.textContent = new Date().toLocaleString();

          const typeLabels = { sale: "Sale", expense: "Expense" };
          let rows = "";
          currentFilteredData.forEach((r) => {
            rows += `<tr>
                        <td>${typeLabels[r.type] || r.type}</td>
                        <td>${r.description || ""}</td>
                        <td>${r.units ?? "-"}</td>
                        <td>${r.amount.toFixed(2)}</td>
                        <td>${r.date}</td>
                        <td>${r.time}</td>
                    </tr>`;
          });
          pdfTableBody.innerHTML = rows;

          // show container temporarily
          const container = document.getElementById("pdfContainer");
          container.style.display = "block";

          const element = document.getElementById("pdfContent");
          const opt = {
            margin: 0.6,
            filename: `report_${today}.pdf`,
            image: { type: "jpeg", quality: 0.98 },
            html2canvas: {
              scale: 2,
              letterRendering: true,
              useCORS: true,
              logging: false,
            },
            jsPDF: { unit: "in", format: "a4", orientation: "portrait" },
          };
          html2pdf()
            .set(opt)
            .from(element)
            .save()
            .then(() => {
              container.style.display = "none";
            })
            .catch((err) => {
              console.warn("PDF generation error:", err);
              alert("Could not generate PDF. Please try again.");
              container.style.display = "none";
            });
        }

        // ----- EVENT LISTENERS -----
        document
          .getElementById("applyFilterBtn")
          .addEventListener("click", applyFilter);
        document
          .getElementById("generatePdfBtn")
          .addEventListener("click", generatePDF);

        document
          .querySelectorAll("#filterDateFrom, #filterDateTo")
          .forEach((el) => {
            el.addEventListener("keydown", (e) => {
              if (e.key === "Enter") applyFilter();
            });
          });

        // ----- INIT -----
        document.getElementById("filterDateFrom").value = today;
        document.getElementById("filterDateTo").value = today;
        applyFilter();

        document.getElementById("sidebarUserName").textContent = "Cashier";
        document.getElementById("dashUserName").textContent = "Cashier";
      })();
    </script>
  </body>
</html>
