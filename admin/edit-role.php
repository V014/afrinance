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
    <link rel="stylesheet" href="css/edit-role.css">
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
