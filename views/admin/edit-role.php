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
      /* ----- THEME (same as original) ----- */
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
        --admin-purple: #8b5cf6;
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
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
      }

      /* ----- MAIN CONTENT (full width, centered) ----- */
      .main-content {
        width: 100%;
        max-width: 820px;
        margin: 0 auto;
      }

      /* ----- BACK BUTTON ----- */
      .back-bar {
        margin-bottom: 1.5rem;
      }
      .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 1.5rem;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 2px solid var(--border);
        background: var(--bg-panel);
        color: var(--text-color);
        cursor: pointer;
      }
      .back-btn:hover {
        transform: translateX(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      }
      .back-btn i {
        font-size: 1rem;
      }

      /* ----- WELCOME CARD (no time/day) ----- */
      .welcome-card {
        margin-bottom: 1.5rem;
      }
      .welcome-card h2 {
        font-size: 1.25rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.75rem;
      }
      .welcome-card h2 i {
        color: var(--admin-purple);
      }
      .welcome-card .role-badge-display {
        font-size: 0.85rem;
        font-weight: 400;
        opacity: 0.6;
        margin-left: 0.5rem;
      }
      .welcome-card .role-badge-display strong {
        color: var(--text-color);
        opacity: 1;
      }

      /* ----- EDIT FORM ----- */
      .form-card {
        background: var(--bg-panel);
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border);
      }
      .form-card .form-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
      }
      .form-card .form-title i {
        color: var(--admin-purple);
      }
      .form-card .form-subtitle {
        font-size: 0.9rem;
        opacity: 0.6;
        margin-bottom: 1.5rem;
      }
      .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
      }
      .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
      }
      .form-group.full-width {
        grid-column: 1 / -1;
      }
      .form-group label {
        font-size: 0.8rem;
        font-weight: 600;
        opacity: 0.7;
        text-transform: uppercase;
        letter-spacing: 0.03em;
      }
      .form-group label .required {
        color: var(--expenses);
        margin-left: 0.2rem;
      }
      .form-group input,
      .form-group select,
      .form-group textarea {
        padding: 0.7rem 1rem;
        border-radius: var(--border-radius);
        border: 1px solid var(--border);
        background: var(--bg-color);
        color: var(--text-color);
        font-size: 0.95rem;
        outline: none;
        transition:
          border 0.2s,
          box-shadow 0.2s;
        font-family: inherit;
        width: 100%;
      }
      .form-group input:focus,
      .form-group select:focus,
      .form-group textarea:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(61, 220, 132, 0.15);
      }
      .form-group input::placeholder,
      .form-group textarea::placeholder {
        opacity: 0.4;
      }
      .form-group textarea {
        resize: vertical;
        min-height: 80px;
      }
      .form-group .helper-text {
        font-size: 0.75rem;
        opacity: 0.5;
        margin-top: 0.2rem;
      }

      /* ----- PERMISSIONS SECTION ----- */
      .permissions-section {
        grid-column: 1 / -1;
        margin-top: 0.5rem;
      }
      .permissions-section .section-label {
        font-size: 0.8rem;
        font-weight: 600;
        opacity: 0.7;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 0.8rem;
        display: block;
      }
      .permissions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.5rem;
        background: var(--bg-color);
        padding: 1rem;
        border-radius: var(--border-radius);
        border: 1px solid var(--border);
      }
      .permission-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.3rem 0.5rem;
        border-radius: 6px;
        transition: background 0.2s;
        cursor: pointer;
      }
      .permission-item:hover {
        background: var(--card-bg);
      }
      .permission-item input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--accent-color);
        cursor: pointer;
        flex-shrink: 0;
      }
      .permission-item label {
        font-size: 0.85rem;
        font-weight: 500;
        opacity: 0.8;
        text-transform: none;
        cursor: pointer;
      }

      /* checkbox / toggle */
      .toggle-group {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding-top: 0.4rem;
      }
      .toggle-group label {
        text-transform: none;
        opacity: 0.8;
        font-weight: 500;
        font-size: 0.9rem;
      }
      .toggle-switch {
        position: relative;
        width: 44px;
        height: 24px;
        flex-shrink: 0;
      }
      .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
      }
      .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--bg-color);
        border: 2px solid var(--border);
        border-radius: 24px;
        transition: 0.3s;
      }
      .toggle-slider::before {
        content: "";
        position: absolute;
        height: 16px;
        width: 16px;
        left: 2px;
        bottom: 2px;
        background: var(--text-color);
        border-radius: 50%;
        transition: 0.3s;
      }
      .toggle-switch input:checked + .toggle-slider {
        background: var(--accent-color);
        border-color: var(--accent-color);
      }
      .toggle-switch input:checked + .toggle-slider::before {
        transform: translateX(20px);
        background: #fff;
      }

      .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
        flex-wrap: wrap;
      }
      .btn-primary {
        padding: 0.7rem 2.5rem;
        border-radius: 30px;
        border: none;
        background: var(--accent-color);
        color: #1a1a1a;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
      }
      .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(61, 220, 132, 0.4);
      }
      .btn-secondary {
        padding: 0.7rem 2rem;
        border-radius: 30px;
        border: 2px solid var(--border);
        background: transparent;
        color: var(--text-color);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        text-decoration: none;
      }
      .btn-secondary:hover {
        background: var(--card-bg);
        transform: translateY(-2px);
      }
      .btn-danger {
        padding: 0.7rem 2rem;
        border-radius: 30px;
        border: 2px solid var(--expenses);
        background: transparent;
        color: var(--expenses);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
      }
      .btn-danger:hover {
        background: var(--expenses);
        color: #fff;
        transform: translateY(-2px);
      }

      .toast-message {
        margin-top: 1rem;
        padding: 0.8rem 1.2rem;
        border-radius: var(--border-radius);
        font-size: 0.95rem;
        font-weight: 500;
        display: none;
      }
      .toast-message.success {
        display: block;
        background: rgba(61, 220, 132, 0.15);
        color: var(--accent-color);
        border: 1px solid var(--accent-color);
      }
      .toast-message.error {
        display: block;
        background: rgba(231, 76, 60, 0.15);
        color: var(--expenses);
        border: 1px solid var(--expenses);
      }

      /* ----- RESPONSIVE ----- */
      @media (max-width: 768px) {
        body {
          padding: 1rem;
        }
        .form-grid {
          grid-template-columns: 1fr;
        }
        .permissions-grid {
          grid-template-columns: 1fr 1fr;
        }
        .form-actions {
          flex-direction: column;
        }
        .btn-primary,
        .btn-secondary,
        .btn-danger {
          justify-content: center;
          width: 100%;
        }
        .form-card {
          padding: 1.2rem;
        }
      }
      @media (max-width: 480px) {
        .permissions-grid {
          grid-template-columns: 1fr;
        }
        .toggle-group {
          flex-wrap: wrap;
        }
      }
    </style>
  </head>
  <body>
    <div class="main-content">
      <!-- BACK BUTTON -->
      <div class="back-bar">
        <a href="roles.php" class="back-btn"
          ><i class="fas fa-arrow-left"></i> Back
        </a>
      </div>

      <!-- WELCOME CARD (no time/day) -->
      <div class="welcome-card">
        <h2>
          <!-- <i class="fas fa-edit"></i> Edit Role -->
          <span class="role-badge-display"
            >Editing: <strong id="editRoleName">Role</strong></span
          >
        </h2>
      </div>

      <!-- EDIT FORM -->
      <div class="form-card">
        <div class="form-title">
          <i class="fas fa-user-tag"></i> Edit Role Details
        </div>
        <div class="form-subtitle">
          Update the role details below. Fields marked with
          <span style="color: var(--expenses)">*</span> are required.
        </div>

        <form id="editRoleForm">
          <div class="form-grid">
            <!-- Role ID (hidden) -->
            <input type="hidden" id="roleId" value="" />

            <!-- Role Name -->
            <div class="form-group">
              <label>Role Name <span class="required">*</span></label>
              <input
                type="text"
                id="roleName"
                placeholder="e.g. Inventory Manager"
                required
              />
              <div class="helper-text">
                Unique, descriptive name for the role
              </div>
            </div>

            <!-- Status -->
            <div class="form-group">
              <label>Status <span class="required">*</span></label>
              <select id="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
              <div class="helper-text">
                Active roles are available for assignment
              </div>
            </div>

            <!-- Description -->
            <div class="form-group full-width">
              <label>Description <span class="required">*</span></label>
              <textarea
                id="description"
                placeholder="Describe the purpose and responsibilities of this role..."
                required
              ></textarea>
              <div class="helper-text">
                Brief description of what this role can do
              </div>
            </div>

            <!-- Permissions -->
            <div class="permissions-section">
              <span class="section-label">
                <i class="fas fa-lock"></i> Permissions
                <span
                  style="
                    opacity: 0.4;
                    font-weight: 400;
                    text-transform: none;
                    font-size: 0.7rem;
                  "
                >
                  (Select all that apply)
                </span>
              </span>
              <div class="permissions-grid" id="permissionsGrid">
                <div class="permission-item">
                  <input type="checkbox" id="perm-view-dashboard" />
                  <label for="perm-view-dashboard">View Dashboard</label>
                </div>
                <div class="permission-item">
                  <input type="checkbox" id="perm-manage-users" />
                  <label for="perm-manage-users">Manage Users</label>
                </div>
                <div class="permission-item">
                  <input type="checkbox" id="perm-manage-roles" />
                  <label for="perm-manage-roles">Manage Roles</label>
                </div>
                <div class="permission-item">
                  <input type="checkbox" id="perm-view-audit" />
                  <label for="perm-view-audit">View Audit Log</label>
                </div>
                <div class="permission-item">
                  <input type="checkbox" id="perm-process-sales" />
                  <label for="perm-process-sales">Process Sales</label>
                </div>
                <div class="permission-item">
                  <input type="checkbox" id="perm-manage-finance" />
                  <label for="perm-manage-finance">Manage Finance</label>
                </div>
                <div class="permission-item">
                  <input type="checkbox" id="perm-manage-inventory" />
                  <label for="perm-manage-inventory">Manage Inventory</label>
                </div>
                <div class="permission-item">
                  <input type="checkbox" id="perm-view-reports" />
                  <label for="perm-view-reports">View Reports</label>
                </div>
                <div class="permission-item">
                  <input type="checkbox" id="perm-export-data" />
                  <label for="perm-export-data">Export Data</label>
                </div>
                <div class="permission-item">
                  <input type="checkbox" id="perm-system-settings" />
                  <label for="perm-system-settings">System Settings</label>
                </div>
              </div>
              <div class="helper-text" style="margin-top: 0.5rem">
                <i class="fas fa-info-circle"></i> Permissions control what
                users with this role can access
              </div>
            </div>

            <!-- Auto-assign toggle -->
            <div class="form-group full-width">
              <label>Auto-Assign Settings</label>
              <div class="toggle-group">
                <div class="toggle-switch">
                  <input type="checkbox" id="autoAssign" />
                  <span class="toggle-slider"></span>
                </div>
                <label for="autoAssign"
                  >Auto-assign this role to new users</label
                >
              </div>
              <div class="helper-text">
                New users will automatically receive this role upon creation
              </div>
            </div>
          </div>

          <!-- Toast message -->
          <div id="formToast" class="toast-message"></div>

          <!-- Form Actions -->
          <div class="form-actions">
            <button type="submit" class="btn-primary">
              <i class="fas fa-save"></i> Update Role
            </button>
            <!-- <a href="roles.php" class="btn-secondary"
              ><i class="fas fa-times"></i> Cancel</a
            > -->
            <button type="reset" class="btn-danger">
              <i class="fas fa-undo"></i> Reset Form
            </button>
          </div>
        </form>
      </div>
    </div>

    <script>
      (function () {
        "use strict";

        // ----- SAMPLE DATA (mirroring roles.php) -----
        const sampleRoles = [
          {
            id: 1,
            name: "Cashier",
            description: "Can process sales and handle customer transactions",
            status: "active",
            permissions: ["view-dashboard", "process-sales", "view-reports"],
            autoAssign: true,
          },
          {
            id: 2,
            name: "Accountant",
            description: "Can manage financial records and generate reports",
            status: "active",
            permissions: [
              "view-dashboard",
              "manage-finance",
              "view-reports",
              "export-data",
            ],
            autoAssign: false,
          },
          {
            id: 3,
            name: "Admin Manager",
            description: "Full system access with user and role management",
            status: "active",
            permissions: [
              "view-dashboard",
              "manage-users",
              "manage-roles",
              "view-audit",
              "manage-finance",
              "manage-inventory",
              "view-reports",
              "export-data",
              "system-settings",
            ],
            autoAssign: false,
          },
          {
            id: 4,
            name: "Viewer",
            description: "Read-only access to system data and reports",
            status: "inactive",
            permissions: ["view-dashboard", "view-reports"],
            autoAssign: false,
          },
          {
            id: 5,
            name: "Inventory Manager",
            description: "Can manage stock levels and inventory reports",
            status: "active",
            permissions: ["view-dashboard", "manage-inventory", "view-reports"],
            autoAssign: false,
          },
          {
            id: 6,
            name: "Branch Manager",
            description: "Oversee branch operations and staff",
            status: "active",
            permissions: [
              "view-dashboard",
              "manage-users",
              "view-reports",
              "process-sales",
            ],
            autoAssign: false,
          },
          {
            id: 7,
            name: "Support Agent",
            description: "Handle customer support tickets and inquiries",
            status: "inactive",
            permissions: ["view-dashboard"],
            autoAssign: false,
          },
        ];

        // ----- GET ROLE ID FROM URL -----
        function getRoleIdFromUrl() {
          const params = new URLSearchParams(window.location.search);
          return parseInt(params.get("id")) || null;
        }

        // ----- LOAD ROLE DATA -----
        function loadRoleData() {
          const roleId = getRoleIdFromUrl();
          if (!roleId) {
            document.getElementById("editRoleName").textContent =
              "Role not found";
            document.getElementById("formToast").className =
              "toast-message error";
            document.getElementById("formToast").textContent =
              "❌ No role ID provided. Please go back and try again.";
            return;
          }

          const role = sampleRoles.find((r) => r.id === roleId);
          if (!role) {
            document.getElementById("editRoleName").textContent =
              "Role not found";
            document.getElementById("formToast").className =
              "toast-message error";
            document.getElementById("formToast").textContent =
              `❌ Role with ID ${roleId} not found.`;
            return;
          }

          // Populate form with role data
          document.getElementById("roleId").value = role.id;
          document.getElementById("editRoleName").textContent = role.name;
          document.getElementById("roleName").value = role.name;
          document.getElementById("status").value = role.status;
          document.getElementById("description").value = role.description;
          document.getElementById("autoAssign").checked =
            role.autoAssign || false;

          // Set permissions
          const checkboxes = document.querySelectorAll(
            '#permissionsGrid input[type="checkbox"]',
          );
          checkboxes.forEach((cb) => {
            const permName = cb.id.replace("perm-", "");
            cb.checked = role.permissions.includes(permName);
          });

          // Clear any previous toast messages
          document.getElementById("formToast").className = "toast-message";
          document.getElementById("formToast").textContent = "";
        }

        // ----- FORM SUBMISSION -----
        document
          .getElementById("editRoleForm")
          .addEventListener("submit", function (e) {
            e.preventDefault();
            const toast = document.getElementById("formToast");

            const roleId = parseInt(document.getElementById("roleId").value);
            const roleName = document.getElementById("roleName").value.trim();
            const status = document.getElementById("status").value;
            const description = document
              .getElementById("description")
              .value.trim();
            const autoAssign = document.getElementById("autoAssign").checked;

            // Get selected permissions
            const permissionCheckboxes = document.querySelectorAll(
              '#permissionsGrid input[type="checkbox"]',
            );
            const selectedPermissions = [];
            permissionCheckboxes.forEach((cb) => {
              if (cb.checked) {
                selectedPermissions.push(cb.id.replace("perm-", ""));
              }
            });

            // Validation
            if (!roleName) {
              toast.className = "toast-message error";
              toast.textContent = "Please enter a role name.";
              return;
            }

            if (!description) {
              toast.className = "toast-message error";
              toast.textContent = "Please enter a role description.";
              return;
            }

            // Find and update the role in the sample data
            const roleIndex = sampleRoles.findIndex((r) => r.id === roleId);
            if (roleIndex === -1) {
              toast.className = "toast-message error";
              toast.textContent = "Role not found in database.";
              return;
            }

            // Update role data
            sampleRoles[roleIndex] = {
              ...sampleRoles[roleIndex],
              name: roleName,
              status: status,
              description: description,
              permissions: selectedPermissions,
              autoAssign: autoAssign,
            };

            // Show success message
            const permCount = selectedPermissions.length;
            toast.className = "toast-message success";
            toast.textContent = `✅ Role "${roleName}" updated successfully! (${permCount} permissions assigned)`;

            // Update the role name display
            document.getElementById("editRoleName").textContent = roleName;

            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML =
              '<i class="fas fa-spinner fa-spin"></i> Updating...';

            setTimeout(() => {
              submitBtn.disabled = false;
              submitBtn.innerHTML = '<i class="fas fa-save"></i> Update Role';

              setTimeout(() => {
                toast.className = "toast-message";
                toast.textContent = "";
              }, 5000);
            }, 1500);
          });

        // ----- DOUBLE-CLICK TO TOGGLE ALL PERMISSIONS -----
        const permGrid = document.getElementById("permissionsGrid");
        const checkboxes = permGrid.querySelectorAll('input[type="checkbox"]');
        const sectionLabel = document.querySelector(
          ".permissions-section .section-label",
        );
        if (sectionLabel) {
          sectionLabel.style.cursor = "pointer";
          sectionLabel.title = "Double-click to toggle all permissions";
          sectionLabel.addEventListener("dblclick", function () {
            const allChecked = Array.from(checkboxes).every((cb) => cb.checked);
            checkboxes.forEach((cb) => (cb.checked = !allChecked));
          });
        }

        // ----- INIT -----
        loadRoleData();
      })();
    </script>
  </body>
</html>
