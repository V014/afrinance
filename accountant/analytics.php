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
    <link rel="stylesheet" href="css/analytics.css">
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
          <a href="safalawo.php" data-page="safalawo"
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
          <a href="analytics.php" data-page="analytics" class="active-link"
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
              <h2>
                <i
                  class="fas fa-chart-line"
                  style="color: var(--accent-color)"
                ></i>
                Performance Analytics
                <span style="opacity: 0.5; font-weight: 400"
                  >· Insights & Intelligence</span
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

          <!-- DATE RANGE SELECTOR -->
          <div class="date-range-container">
            <div class="filter-group">
              <label for="dateRange">Period</label>
              <select id="dateRange">
                <option value="today">Today</option>
                <option value="week">This Week</option>
                <option value="month" selected>This Month</option>
                <option value="quarter">This Quarter</option>
                <option value="year">This Year</option>
                <option value="all">All Time</option>
              </select>
            </div>
          </div>

          <!-- EXECUTIVE SUMMARY CARDS -->
          <div class="summary-grid">
            <div class="summary-card revenue">
              <div class="summary-icon"><i class="fas fa-coins"></i></div>
              <div class="summary-value" id="summaryRevenue">0.00</div>
              <div class="summary-label">Total Revenue</div>
            </div>
            <div class="summary-card expenses">
              <div class="summary-icon"><i class="fas fa-receipt"></i></div>
              <div class="summary-value" id="summaryExpenses">0.00</div>
              <div class="summary-label">Total Expenses</div>
            </div>
            <div class="summary-card profit" id="profitCard">
              <div class="summary-icon"><i class="fas fa-chart-pie"></i></div>
              <div class="summary-value" id="summaryProfit">0.00</div>
              <div class="summary-label">Net Profit</div>
            </div>
            <div class="summary-card target">
              <div class="summary-icon"><i class="fas fa-bullseye"></i></div>
              <div class="summary-value" id="summaryTarget">0%</div>
              <div class="summary-label">Branches On Target</div>
              <div class="summary-sub" id="summaryTargetSub">
                0 of 0 branches
              </div>
            </div>
            <div
              class="summary-card"
              style="border-left: 3px solid var(--accent-color)"
            >
              <div class="summary-icon" style="color: var(--accent-color)">
                <i class="fas fa-exchange-alt"></i>
              </div>
              <div class="summary-value" id="summaryTransactions">0</div>
              <div class="summary-label">Total Transactions</div>
            </div>
          </div>

          <!-- BRANCH COMPARISON -->
          <div class="section-title">
            <i class="fas fa-store-alt"></i> Branch Performance Comparison
          </div>
          <div class="branch-comparison-grid" id="branchComparison">
            <!-- Rendered by JS -->
          </div>

          <!-- TOP PERFORMERS -->
          <div class="section-title">
            <i class="fas fa-trophy"></i> Top Performers
          </div>
          <div class="performers-grid">
            <div class="performer-card">
              <div class="performer-title">
                <i class="fas fa-store"></i> Top Branch
              </div>
              <div id="topBranch">
                <div class="performer-item">
                  <span class="name">Loading...</span>
                  <span class="value">--</span>
                </div>
              </div>
              <div class="performer-title" style="margin-top: 0.8rem">
                <i class="fas fa-store"></i> Bottom Branch
              </div>
              <div id="bottomBranch">
                <div class="performer-item">
                  <span class="name">Loading...</span>
                  <span class="value loss">--</span>
                </div>
              </div>
            </div>
            <div class="performer-card">
              <div class="performer-title">
                <i class="fas fa-user-tie"></i> Top Cashiers
              </div>
              <div id="topCashiers">
                <div class="performer-item">
                  <span class="name">Loading...</span>
                  <span class="value">--</span>
                </div>
              </div>
            </div>
          </div>

          <!-- ANALYSIS GRID -->
          <div class="section-title">
            <i class="fas fa-microscope"></i> Deep Analysis
          </div>
          <div class="analysis-grid">
            <!-- Service Type Analysis -->
            <div class="analysis-card">
              <div class="analysis-title">
                <i class="fas fa-industry"></i> Service Type Profitability
              </div>
              <div id="serviceTypeAnalysis">
                <div class="analysis-item">
                  <span class="label">Milling</span>
                  <span class="value" id="millingProfit">0.00</span>
                </div>
                <div class="analysis-item">
                  <span class="label">Shelling</span>
                  <span class="value" id="shellingProfit">0.00</span>
                </div>
                <div
                  class="analysis-item"
                  style="border-bottom: 2px solid var(--border)"
                >
                  <span class="label" style="font-weight: 600"
                    >Most Profitable</span
                  >
                  <span
                    class="value"
                    id="mostProfitableService"
                    style="color: var(--accent-color)"
                    >--</span
                  >
                </div>
                <div class="breakdown-bar">
                  <div
                    class="bar-segment"
                    id="millingBar"
                    style="width: 50%"
                  ></div>
                  <div
                    class="bar-segment"
                    id="shellingBar"
                    style="width: 50%"
                  ></div>
                </div>
              </div>
            </div>

            <!-- Expense Breakdown -->
            <div class="analysis-card">
              <div class="analysis-title">
                <i class="fas fa-tools"></i> Expense Breakdown (What Breaks
                Most)
              </div>
              <div id="expenseBreakdown">
                <div class="analysis-item">
                  <span class="label">Bearings</span>
                  <span class="value" id="expenseBearings">0</span>
                </div>
                <div class="analysis-item">
                  <span class="label">Drive Belts</span>
                  <span class="value" id="expenseDrivebelts">0</span>
                </div>
                <div class="analysis-item">
                  <span class="label">Screens</span>
                  <span class="value" id="expenseScreens">0</span>
                </div>
                <div class="analysis-item">
                  <span class="label">Engines / Motors</span>
                  <span class="value" id="expenseEngines">0</span>
                </div>
                <div
                  class="analysis-item"
                  style="border-bottom: 2px solid var(--border)"
                >
                  <span class="label" style="font-weight: 600"
                    >Most Frequent Issue</span
                  >
                  <span
                    class="value"
                    id="mostFrequentIssue"
                    style="color: var(--loss-red)"
                    >--</span
                  >
                </div>
              </div>
            </div>
          </div>

          <!-- BRANCH EXPENSE ISSUES -->
          <div class="section-title">
            <i class="fas fa-exclamation-triangle"></i> Branch-Specific Issues
          </div>
          <div class="analysis-grid" id="branchIssues">
            <!-- Rendered by JS -->
          </div>

          <!-- DETAILED TRANSACTION TABLE -->
          <div class="section-title">
            <i class="fas fa-table"></i> Detailed Transactions
          </div>

          <!-- FILTERS -->
          <div class="filters-container">
            <div class="filter-group">
              <label for="filterBranch">Branch</label>
              <select id="filterBranch">
                <option value="all">All Branches</option>
                <option value="safalawo">Safalawo</option>
                <option value="zambia">Zambia</option>
                <option value="fargo">Fargo</option>
              </select>
            </div>
            <div class="filter-group">
              <label for="filterType">Type</label>
              <select id="filterType">
                <option value="all">All Types</option>
                <option value="sale">Sales</option>
                <option value="expense">Expenses</option>
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

        // ----- BRANCH TARGETS -----
        const BRANCH_TARGETS = {
          safalawo: 500000,
          zambia: 400000,
          fargo: 350000,
        };

        // ----- COMBINED DATA (Sales + Expenses) -----
        const allRecords = [
          // SAFALAWO - SALES
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
            type: "sale",
            cashier: "Grace Banda",
            amount: 1500,
            date: today,
            time: "14:45:00",
          },
          {
            branch: "safalawo",
            type: "sale",
            cashier: "Sarah Lungu",
            amount: 600,
            date: today,
            time: "16:10:00",
          },
          {
            branch: "safalawo",
            type: "sale",
            cashier: "Michael Banda",
            amount: 900,
            date: "2026-07-30",
            time: "11:30:00",
          },
          {
            branch: "safalawo",
            type: "sale",
            cashier: "Grace Banda",
            amount: 700,
            date: "2026-07-28",
            time: "13:20:00",
          },
          {
            branch: "safalawo",
            type: "sale",
            cashier: "Peter Mwale",
            amount: 1100,
            date: "2026-07-29",
            time: "10:00:00",
          },

          // SAFALAWO - EXPENSES
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
          {
            branch: "safalawo",
            type: "expense",
            cashier: "James Nyirenda",
            amount: 4200,
            date: "2026-07-30",
            time: "09:00:00",
          },
          {
            branch: "safalawo",
            type: "expense",
            cashier: "Joseph Kamanga",
            amount: 15000,
            date: "2026-07-28",
            time: "08:30:00",
          },
          {
            branch: "safalawo",
            type: "expense",
            cashier: "Ester Tembo",
            amount: 2800,
            date: "2026-07-27",
            time: "09:45:00",
          },

          // ZAMBIA - SALES
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
            type: "sale",
            cashier: "Michael Banda",
            amount: 800,
            date: "2026-07-30",
            time: "10:00:00",
          },
          {
            branch: "zambia",
            type: "sale",
            cashier: "Ruth Moyo",
            amount: 1300,
            date: "2026-07-29",
            time: "11:00:00",
          },

          // ZAMBIA - EXPENSES
          {
            branch: "zambia",
            type: "expense",
            cashier: "John Phiri",
            amount: 4200,
            date: today,
            time: "10:00:00",
          },
          {
            branch: "zambia",
            type: "expense",
            cashier: "James Nyirenda",
            amount: 15000,
            date: today,
            time: "13:30:00",
          },
          {
            branch: "zambia",
            type: "expense",
            cashier: "Mary Kachale",
            amount: 2800,
            date: "2026-07-30",
            time: "14:00:00",
          },

          // FARGO - SALES
          {
            branch: "fargo",
            type: "sale",
            cashier: "Ruth Moyo",
            amount: 900,
            date: today,
            time: "11:00:00",
          },
          {
            branch: "fargo",
            type: "sale",
            cashier: "Michael Banda",
            amount: 1100,
            date: today,
            time: "15:20:00",
          },
          {
            branch: "fargo",
            type: "sale",
            cashier: "Linda Phakati",
            amount: 600,
            date: "2026-07-30",
            time: "12:00:00",
          },
          {
            branch: "fargo",
            type: "sale",
            cashier: "Grace Banda",
            amount: 800,
            date: "2026-07-29",
            time: "09:30:00",
          },

          // FARGO - EXPENSES
          {
            branch: "fargo",
            type: "expense",
            cashier: "Ester Tembo",
            amount: 3500,
            date: today,
            time: "07:30:00",
          },
          {
            branch: "fargo",
            type: "expense",
            cashier: "Joseph Kamanga",
            amount: 2800,
            date: today,
            time: "12:00:00",
          },
          {
            branch: "fargo",
            type: "expense",
            cashier: "Linda Phakati",
            amount: 4200,
            date: "2026-07-28",
            time: "10:00:00",
          },
        ];

        // ----- CATEGORY MAPPING FOR EXPENSES -----
        const expenseCategories = {
          Bearings: 3500,
          "Drive Belts": 2800,
          Screens: 4200,
          "Engines / Motors": 15000,
        };

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

        // ----- GET DATE RANGE -----
        function getDateRange(range) {
          const today = new Date();
          let start = new Date(today);
          let end = new Date(today);

          switch (range) {
            case "today":
              start = new Date(today);
              end = new Date(today);
              break;
            case "week":
              start = new Date(today);
              start.setDate(today.getDate() - 7);
              end = new Date(today);
              break;
            case "month":
              start = new Date(today.getFullYear(), today.getMonth(), 1);
              end = new Date(today);
              break;
            case "quarter":
              const quarter = Math.floor(today.getMonth() / 3);
              start = new Date(today.getFullYear(), quarter * 3, 1);
              end = new Date(today);
              break;
            case "year":
              start = new Date(today.getFullYear(), 0, 1);
              end = new Date(today);
              break;
            case "all":
              start = new Date(2020, 0, 1);
              end = new Date(today);
              break;
            default:
              start = new Date(today.getFullYear(), today.getMonth(), 1);
              end = new Date(today);
          }

          return {
            start: start.toISOString().slice(0, 10),
            end: end.toISOString().slice(0, 10),
          };
        }

        // ----- FILTER DATA BY DATE RANGE -----
        function filterByDateRange(records, range) {
          const { start, end } = getDateRange(range);
          return records.filter((r) => r.date >= start && r.date <= end);
        }

        // ----- UPDATE ALL ANALYTICS -----
        function updateAnalytics() {
          const dateRange = document.getElementById("dateRange").value;
          const filtered = filterByDateRange(allRecords, dateRange);

          // Branch summaries
          const branches = ["safalawo", "zambia", "fargo"];
          const branchData = {};

          branches.forEach((br) => {
            const sales = filtered
              .filter((r) => r.branch === br && r.type === "sale")
              .reduce((sum, r) => sum + r.amount, 0);
            const expenses = filtered
              .filter((r) => r.branch === br && r.type === "expense")
              .reduce((sum, r) => sum + r.amount, 0);
            const profit = sales - expenses;
            const transactions = filtered.filter((r) => r.branch === br).length;
            const target = BRANCH_TARGETS[br] || 500000;
            const targetPercent = Math.min((sales / target) * 100, 100);
            const onTarget = sales >= target;

            branchData[br] = {
              sales,
              expenses,
              profit,
              transactions,
              target,
              targetPercent,
              onTarget,
            };
          });

          // Summary totals
          const totalRevenue = Object.values(branchData).reduce(
            (sum, b) => sum + b.sales,
            0,
          );
          const totalExpenses = Object.values(branchData).reduce(
            (sum, b) => sum + b.expenses,
            0,
          );
          const totalProfit = totalRevenue - totalExpenses;
          const totalTransactions = filtered.length;
          const branchesOnTarget = Object.values(branchData).filter(
            (b) => b.onTarget,
          ).length;
          const targetPercent = (branchesOnTarget / branches.length) * 100;

          // Update summary cards
          document.getElementById("summaryRevenue").textContent =
            totalRevenue.toFixed(2);
          document.getElementById("summaryExpenses").textContent =
            totalExpenses.toFixed(2);

          const profitEl = document.getElementById("summaryProfit");
          profitEl.textContent = totalProfit.toFixed(2);
          const profitCard = document.getElementById("profitCard");
          if (totalProfit < 0) {
            profitCard.classList.add("loss");
          } else {
            profitCard.classList.remove("loss");
          }

          document.getElementById("summaryTarget").textContent =
            targetPercent.toFixed(0) + "%";
          document.getElementById("summaryTargetSub").textContent =
            `${branchesOnTarget} of ${branches.length} branches`;
          document.getElementById("summaryTransactions").textContent =
            totalTransactions;

          // Render branch comparison
          renderBranchComparison(branchData);

          // Top performers
          renderTopPerformers(branchData, filtered);

          // Service type analysis
          renderServiceAnalysis(filtered);

          // Expense breakdown
          renderExpenseBreakdown(filtered);

          // Branch-specific issues
          renderBranchIssues(filtered);
        }

        // ----- RENDER BRANCH COMPARISON -----
        function renderBranchComparison(branchData) {
          const container = document.getElementById("branchComparison");
          const branchColors = {
            safalawo: "branch-safalawo",
            zambia: "branch-zambia",
            fargo: "branch-fargo",
          };
          const branchLabels = {
            safalawo: "Safalawo",
            zambia: "Zambia",
            fargo: "Fargo",
          };
          const branchIcons = {
            safalawo: "fa-store-alt",
            zambia: "fa-store-alt",
            fargo: "fa-store-alt",
          };

          let html = "";
          Object.keys(branchData).forEach((key) => {
            const b = branchData[key];
            const statusClass = b.profit >= 0 ? "profit" : "loss";
            const statusText = b.profit >= 0 ? "Profitable" : "Loss Making";
            const progressClass =
              b.targetPercent >= 100
                ? "high"
                : b.targetPercent >= 50
                  ? "medium"
                  : "low";

            html += `
              <div class="branch-compare-card ${branchColors[key]}">
                <div class="branch-name">
                  <i class="fas ${branchIcons[key]}"></i> ${branchLabels[key]}
                  <span style="font-size:0.7rem; opacity:0.5; font-weight:400; margin-left:auto;">
                    ${b.transactions} txns
                  </span>
                </div>
                <div class="branch-metrics">
                  <div class="metric-item">
                    <span class="metric-label">Revenue</span>
                    <span class="metric-value" style="color: var(--sales);">${b.sales.toFixed(2)}</span>
                  </div>
                  <div class="metric-item">
                    <span class="metric-label">Expenses</span>
                    <span class="metric-value" style="color: var(--expenses);">${b.expenses.toFixed(2)}</span>
                  </div>
                  <div class="metric-item">
                    <span class="metric-label">Profit</span>
                    <span class="metric-value" style="color: ${b.profit >= 0 ? "var(--profit-green)" : "var(--loss-red)"};">
                      ${b.profit.toFixed(2)}
                    </span>
                  </div>
                  <div class="metric-item">
                    <span class="metric-label">Target Progress</span>
                    <span class="metric-value">${b.targetPercent.toFixed(0)}%</span>
                  </div>
                </div>
                <div class="progress-bar">
                  <div class="progress-fill ${progressClass}" style="width: ${b.targetPercent}%;"></div>
                </div>
                <div class="branch-status">
                  <span class="status-badge ${statusClass}">${statusText}</span>
                  <span style="font-size:0.7rem; opacity:0.5;">Target: ${b.target.toLocaleString()}</span>
                </div>
              </div>
            `;
          });
          container.innerHTML = html;
        }

        // ----- RENDER TOP PERFORMERS -----
        function renderTopPerformers(branchData, filtered) {
          // Top branch by profit
          const sortedBranches = Object.keys(branchData).sort(
            (a, b) => branchData[b].profit - branchData[a].profit,
          );
          const topBranch = sortedBranches[0];
          const bottomBranch = sortedBranches[sortedBranches.length - 1];
          const branchLabels = {
            safalawo: "Safalawo",
            zambia: "Zambia",
            fargo: "Fargo",
          };

          document.getElementById("topBranch").innerHTML = `
            <div class="performer-item">
              <span class="name"><span class="performer-rank gold">1</span> ${branchLabels[topBranch]}</span>
              <span class="value">${branchData[topBranch].profit.toFixed(2)}</span>
            </div>
          `;

          document.getElementById("bottomBranch").innerHTML = `
            <div class="performer-item">
              <span class="name"><span class="performer-rank">${sortedBranches.length}</span> ${branchLabels[bottomBranch]}</span>
              <span class="value loss">${branchData[bottomBranch].profit.toFixed(2)}</span>
            </div>
          `;

          // Top cashiers by sales
          const cashierSales = {};
          filtered
            .filter((r) => r.type === "sale")
            .forEach((r) => {
              cashierSales[r.cashier] =
                (cashierSales[r.cashier] || 0) + r.amount;
            });
          const sortedCashiers = Object.keys(cashierSales).sort(
            (a, b) => cashierSales[b] - cashierSales[a],
          );
          const top3 = sortedCashiers.slice(0, 3);
          const ranks = ["gold", "silver", "bronze"];

          let html = "";
          top3.forEach((cashier, index) => {
            html += `
              <div class="performer-item">
                <span class="name"><span class="performer-rank ${ranks[index] || ""}">${index + 1}</span> ${cashier}</span>
                <span class="value">${cashierSales[cashier].toFixed(2)}</span>
              </div>
            `;
          });
          if (top3.length === 0) {
            html = `<div class="performer-item"><span class="name">No sales recorded</span></div>`;
          }
          document.getElementById("topCashiers").innerHTML = html;
        }

        // ----- RENDER SERVICE ANALYSIS -----
        function renderServiceAnalysis(filtered) {
          // For sales, we need to know if it's milling or shelling
          // We'll simulate this based on cashier or description
          // For demo, we'll split sales by amount patterns
          const sales = filtered.filter((r) => r.type === "sale");
          let millingTotal = 0;
          let shellingTotal = 0;
          let millingCount = 0;
          let shellingCount = 0;

          sales.forEach((r) => {
            // Simulate: even amounts > 1000 are milling, others shelling
            if (
              r.amount > 1000 ||
              r.cashier === "Grace Banda" ||
              r.cashier === "David Zulu" ||
              r.cashier === "Michael Banda"
            ) {
              millingTotal += r.amount;
              millingCount++;
            } else {
              shellingTotal += r.amount;
              shellingCount++;
            }
          });

          const millingAvg = millingCount > 0 ? millingTotal / millingCount : 0;
          const shellingAvg =
            shellingCount > 0 ? shellingTotal / shellingCount : 0;
          const totalAvg = millingTotal + shellingTotal;

          document.getElementById("millingProfit").textContent =
            millingTotal.toFixed(2);
          document.getElementById("millingProfit").className = "value positive";
          document.getElementById("shellingProfit").textContent =
            shellingTotal.toFixed(2);
          document.getElementById("shellingProfit").className =
            "value " + (shellingTotal > 0 ? "positive" : "");

          const mostProfitable =
            millingTotal > shellingTotal ? "Milling" : "Shelling";
          document.getElementById("mostProfitableService").textContent =
            mostProfitable;

          // Bars
          const total = millingTotal + shellingTotal || 1;
          document.getElementById("millingBar").style.width =
            `${(millingTotal / total) * 100}%`;
          document.getElementById("shellingBar").style.width =
            `${(shellingTotal / total) * 100}%`;
        }

        // ----- RENDER EXPENSE BREAKDOWN -----
        function renderExpenseBreakdown(filtered) {
          const expenses = filtered.filter((r) => r.type === "expense");
          const categories = {
            bearings: { count: 0, label: "Bearings" },
            drivebelts: { count: 0, label: "Drive Belts" },
            screens: { count: 0, label: "Screens" },
            engines: { count: 0, label: "Engines / Motors" },
          };

          expenses.forEach((r) => {
            // Map cashier/amount to category for demo
            if (r.amount === 3500 || r.amount === 7000)
              categories.bearings.count++;
            else if (
              r.amount === 2800 ||
              (r.amount === 4200 && r.cashier !== "James Nyirenda")
            )
              categories.drivebelts.count++;
            else if (r.amount === 4200 && r.cashier === "James Nyirenda")
              categories.screens.count++;
            else if (r.amount === 15000) categories.engines.count++;
            else {
              // Fallback
              if (r.amount > 10000) categories.engines.count++;
              else categories.bearings.count++;
            }
          });

          document.getElementById("expenseBearings").textContent =
            categories.bearings.count;
          document.getElementById("expenseDrivebelts").textContent =
            categories.drivebelts.count;
          document.getElementById("expenseScreens").textContent =
            categories.screens.count;
          document.getElementById("expenseEngines").textContent =
            categories.engines.count;

          const mostFrequent = Object.keys(categories).reduce((a, b) =>
            categories[a].count > categories[b].count ? a : b,
          );
          document.getElementById("mostFrequentIssue").textContent =
            categories[mostFrequent]?.label || "None";
        }

        // ----- RENDER BRANCH ISSUES -----
        function renderBranchIssues(filtered) {
          const container = document.getElementById("branchIssues");
          const branches = ["safalawo", "zambia", "fargo"];
          const branchLabels = {
            safalawo: "Safalawo",
            zambia: "Zambia",
            fargo: "Fargo",
          };

          let html = "";
          branches.forEach((br) => {
            const brExpenses = filtered.filter(
              (r) => r.branch === br && r.type === "expense",
            );
            const totalExpense = brExpenses.reduce(
              (sum, r) => sum + r.amount,
              0,
            );
            const count = brExpenses.length;

            // Find most common issue for this branch
            const issueCounts = {};
            brExpenses.forEach((r) => {
              let category = "Other";
              if (r.amount === 3500 || r.amount === 7000) category = "Bearings";
              else if (r.amount === 2800) category = "Drive Belts";
              else if (r.amount === 4200) category = "Screens";
              else if (r.amount === 15000) category = "Engines";
              issueCounts[category] = (issueCounts[category] || 0) + 1;
            });

            const topIssue = Object.keys(issueCounts).reduce(
              (a, b) => (issueCounts[a] > issueCounts[b] ? a : b),
              "None",
            );
            const topIssueCount = issueCounts[topIssue] || 0;

            html += `
              <div class="analysis-card" >
                <div class="analysis-title"><i class="fas fa-store-alt"></i> ${branchLabels[br]}</div>
                <div class="analysis-item">
                  <span class="label">Total Expenses</span>
                  <span class="value negative">${totalExpense.toFixed(2)}</span>
                </div>
                <div class="analysis-item">
                  <span class="label">Number of Issues</span>
                  <span class="value">${count}</span>
                </div>
                <div class="analysis-item" style="border-bottom: none;">
                  <span class="label">Top Issue</span>
                  <span class="value" style="color: var(--loss-red);">${topIssue} (${topIssueCount}x)</span>
                </div>
              </div>
            `;
          });
          container.innerHTML = html;
        }

        // ----- RENDER TABLE -----
        function renderTable() {
          const branchFilter = document.getElementById("filterBranch").value;
          const typeFilter = document.getElementById("filterType").value;
          const cashierFilter = document.getElementById("filterCashier").value;
          const dateRange = document.getElementById("dateRange").value;

          let filtered = filterByDateRange(allRecords, dateRange);

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

          const branchLabels = {
            safalawo: "Safalawo",
            zambia: "Zambia",
            fargo: "Fargo",
          };
          const typeLabels = { sale: "Sale", expense: "Expense" };
          const typeClasses = { sale: "type-sale", expense: "type-expense" };

          let html = "";
          pageData.forEach((r, index) => {
            const rowNum = startIndex + index + 1;
            html += `<tr>
              <td style="text-align: center; opacity: 0.5;">${rowNum}</td>
              <td>${branchLabels[r.branch] || r.branch}</td>
              <td><span class="type-badge ${typeClasses[r.type]}">${typeLabels[r.type]}</span></td>
              <td>${r.cashier || "-"}</td>
              <td><strong>${r.amount.toFixed(2)}</strong></td>
              <td>${r.date}</td>
              <td>${r.time}</td>
            </tr>`;
          });
          tbody.innerHTML = html;
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
          .getElementById("dateRange")
          .addEventListener("change", function () {
            currentPage = 1;
            updateAnalytics();
            renderTable();
          });

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
        updateAnalytics();
        renderTable();

        document.getElementById("sidebarUserName").textContent = "Accountant";
      })();
    </script>
  </body>
</html>
