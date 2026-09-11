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
    <link rel="stylesheet" href="css/edit.css">
  </head>
  <body>
    <div class="main-content">
      <!-- BACK BUTTON -->
      <div class="back-bar">
        <a href="manage.php" class="back-btn"
          ><i class="fas fa-arrow-left"></i> Back
        </a>
      </div>

      <!-- WELCOME CARD (no time/day) -->
      <div class="welcome-card">
        <h2>
          <i class="fas fa-user-edit"></i> Edit Admin Account
          <span class="user-badge"
            >Editing: <strong id="editUserName">User</strong></span
          >
        </h2>
      </div>

      <!-- EDIT FORM -->
      <div class="form-card">
        <div class="form-title">
          <i class="fas fa-user-shield"></i> Edit Account Details
        </div>
        <div class="form-subtitle">
          Update the account information below. Fields marked with
          <span style="color: var(--expenses)">*</span> are required.
          <span
            style="
              display: block;
              margin-top: 0.3rem;
              opacity: 0.5;
              font-size: 0.8rem;
            "
          >
            <i class="fas fa-info-circle"></i> Leave password fields blank to
            keep current password.
          </span>
        </div>

        <form id="editAdminForm">
          <div class="form-grid">
            <!-- User ID (hidden) -->
            <input type="hidden" id="userId" value="" />

            <!-- Full Name -->
            <div class="form-group">
              <label>Full Name <span class="required">*</span></label>
              <input
                type="text"
                id="fullName"
                placeholder="e.g. Jane Doe"
                required
              />
            </div>

            <!-- Email -->
            <div class="form-group">
              <label>Email Address <span class="required">*</span></label>
              <input
                type="email"
                id="email"
                placeholder="jane@3maze.com"
                required
              />
            </div>

            <!-- Role -->
            <div class="form-group">
              <label>Role <span class="required">*</span></label>
              <select id="role" required>
                <option value="cashier">Cashier</option>
                <option value="accountant">Accountant</option>
                <option value="admin-manager">Admin Manager</option>
              </select>
            </div>

            <!-- Branch (visible only for Cashier) -->
            <div class="form-group branch-field" id="branchGroup">
              <label>Branch <span class="required">*</span></label>
              <select id="branch">
                <option value="safalawo">Safalawo</option>
                <option value="zambia">Zambia</option>
                <option value="fargo">Fargo</option>
              </select>
              <div class="helper-text">Required for Cashier role</div>
            </div>

            <!-- Status -->
            <div class="form-group">
              <label>Status <span class="required">*</span></label>
              <select id="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>

            <!-- New Password -->
            <div class="form-group">
              <label
                >New Password
                <span style="opacity: 0.4; font-weight: 400"
                  >(optional)</span
                ></label
              >
              <input
                type="password"
                id="password"
                placeholder="Leave blank to keep current"
                minlength="8"
              />
              <div class="helper-text">Min 8 characters (only if changing)</div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
              <label>Confirm New Password</label>
              <input
                type="password"
                id="confirmPassword"
                placeholder="Re-enter new password"
              />
            </div>

            <!-- 2FA Toggle -->
            <div class="form-group full-width">
              <label>Security Settings</label>
              <div class="toggle-group">
                <div class="toggle-switch">
                  <input type="checkbox" id="twoFA" />
                  <span class="toggle-slider"></span>
                </div>
                <label for="twoFA"
                  >Enable Two-Factor Authentication (2FA)</label
                >
              </div>
              <div class="helper-text">
                Recommended for enhanced account security
              </div>
            </div>

            <!-- Notes -->
            <div class="form-group full-width">
              <label>Notes (Optional)</label>
              <textarea
                id="notes"
                placeholder="Any additional information about this account..."
              ></textarea>
            </div>
          </div>

          <!-- Toast message -->
          <div id="formToast" class="toast-message"></div>

          <!-- Form Actions -->
          <div class="form-actions">
            <button type="submit" class="btn-primary">
              <i class="fas fa-save"></i> Update Account
            </button>
            <!-- <a href="manage.php" class="btn-secondary"
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

        // ----- SAMPLE DATA (mirroring manage.php) -----
        const sampleAdmins = [
          {
            id: 1,
            name: "Alice Mwale",
            email: "alice@3maze.com",
            role: "cashier",
            status: "active",
            lastLogin: "2026-08-05 14:23",
            twoFA: true,
            branch: "safalawo",
            notes: "Senior cashier at Safalawo branch",
          },
          {
            id: 2,
            name: "Bob Phiri",
            email: "bob@3maze.com",
            role: "accountant",
            status: "active",
            lastLogin: "2026-08-04 09:10",
            twoFA: false,
            branch: null,
            notes: "",
          },
          {
            id: 3,
            name: "Carol Banda",
            email: "carol@3maze.com",
            role: "admin-manager",
            status: "inactive",
            lastLogin: "2026-07-28 11:45",
            twoFA: false,
            branch: null,
            notes: "On leave",
          },
          {
            id: 4,
            name: "David Zulu",
            email: "david@3maze.com",
            role: "cashier",
            status: "active",
            lastLogin: "2026-08-06 08:00",
            twoFA: true,
            branch: "zambia",
            notes: "",
          },
          {
            id: 5,
            name: "Ester Tembo",
            email: "ester@3maze.com",
            role: "accountant",
            status: "active",
            lastLogin: "2026-08-03 16:20",
            twoFA: false,
            branch: null,
            notes: "",
          },
          {
            id: 6,
            name: "Frank Kamanga",
            email: "frank@3maze.com",
            role: "admin-manager",
            status: "inactive",
            lastLogin: "2026-07-25 13:00",
            twoFA: false,
            branch: null,
            notes: "Pending review",
          },
          {
            id: 7,
            name: "Grace Banda",
            email: "grace@3maze.com",
            role: "cashier",
            status: "active",
            lastLogin: "2026-08-06 07:30",
            twoFA: true,
            branch: "fargo",
            notes: "",
          },
          {
            id: 8,
            name: "Henry Moyo",
            email: "henry@3maze.com",
            role: "accountant",
            status: "active",
            lastLogin: "2026-08-02 10:00",
            twoFA: false,
            branch: null,
            notes: "",
          },
          {
            id: 9,
            name: "Ivy Nkhoma",
            email: "ivy@3maze.com",
            role: "admin-manager",
            status: "active",
            lastLogin: "2026-08-05 12:15",
            twoFA: true,
            branch: null,
            notes: "Team lead",
          },
        ];

        // ----- GET USER ID FROM URL -----
        function getUserIdFromUrl() {
          const params = new URLSearchParams(window.location.search);
          return parseInt(params.get("id")) || null;
        }

        // ----- LOAD USER DATA -----
        function loadUserData() {
          const userId = getUserIdFromUrl();
          if (!userId) {
            document.getElementById("editUserName").textContent =
              "User not found";
            document.getElementById("formToast").className =
              "toast-message error";
            document.getElementById("formToast").textContent =
              "❌ No user ID provided. Please go back and try again.";
            return;
          }

          const user = sampleAdmins.find((a) => a.id === userId);
          if (!user) {
            document.getElementById("editUserName").textContent =
              "User not found";
            document.getElementById("formToast").className =
              "toast-message error";
            document.getElementById("formToast").textContent =
              `❌ User with ID ${userId} not found.`;
            return;
          }

          // Populate form with user data
          document.getElementById("userId").value = user.id;
          document.getElementById("editUserName").textContent = user.name;
          document.getElementById("fullName").value = user.name;
          document.getElementById("email").value = user.email;
          document.getElementById("role").value = user.role;
          document.getElementById("status").value = user.status;
          document.getElementById("twoFA").checked = user.twoFA;
          document.getElementById("notes").value = user.notes || "";

          // Handle branch field for cashier
          const branchGroup = document.getElementById("branchGroup");
          const branchSelect = document.getElementById("branch");
          if (user.role === "cashier") {
            branchGroup.classList.add("visible");
            branchSelect.setAttribute("required", "required");
            if (user.branch) {
              branchSelect.value = user.branch;
            }
          } else {
            branchGroup.classList.remove("visible");
            branchSelect.removeAttribute("required");
          }

          // Clear any previous toast messages
          document.getElementById("formToast").className = "toast-message";
          document.getElementById("formToast").textContent = "";
        }

        // ----- TOGGLE BRANCH FIELD BASED ON ROLE -----
        const roleSelect = document.getElementById("role");
        const branchGroup = document.getElementById("branchGroup");
        const branchSelect = document.getElementById("branch");

        function toggleBranchField() {
          const selectedRole = roleSelect.value;
          if (selectedRole === "cashier") {
            branchGroup.classList.add("visible");
            branchSelect.setAttribute("required", "required");
          } else {
            branchGroup.classList.remove("visible");
            branchSelect.removeAttribute("required");
            branchSelect.value = "safalawo"; // reset to default
          }
        }

        roleSelect.addEventListener("change", toggleBranchField);

        // ----- FORM SUBMISSION -----
        document
          .getElementById("editAdminForm")
          .addEventListener("submit", function (e) {
            e.preventDefault();
            const toast = document.getElementById("formToast");

            const userId = parseInt(document.getElementById("userId").value);
            const fullName = document.getElementById("fullName").value.trim();
            const email = document.getElementById("email").value.trim();
            const role = document.getElementById("role").value;
            const branch = document.getElementById("branch").value;
            const status = document.getElementById("status").value;
            const password = document.getElementById("password").value;
            const confirmPassword =
              document.getElementById("confirmPassword").value;
            const twoFA = document.getElementById("twoFA").checked;
            const notes = document.getElementById("notes").value.trim();

            // Validation
            if (!fullName || !email || !role) {
              toast.className = "toast-message error";
              toast.textContent = "Please fill in all required fields.";
              return;
            }

            if (role === "cashier" && !branch) {
              toast.className = "toast-message error";
              toast.textContent =
                "Please select a branch for the Cashier role.";
              return;
            }

            // Password validation (only if both fields are filled)
            if (password || confirmPassword) {
              if (password !== confirmPassword) {
                toast.className = "toast-message error";
                toast.textContent = "Passwords do not match.";
                return;
              }
              if (password.length < 8) {
                toast.className = "toast-message error";
                toast.textContent = "Password must be at least 8 characters.";
                return;
              }
            }

            // Find and update the user in the sample data
            const userIndex = sampleAdmins.findIndex((a) => a.id === userId);
            if (userIndex === -1) {
              toast.className = "toast-message error";
              toast.textContent = "User not found in database.";
              return;
            }

            // Update user data
            sampleAdmins[userIndex] = {
              ...sampleAdmins[userIndex],
              name: fullName,
              email: email,
              role: role,
              status: status,
              twoFA: twoFA,
              branch: role === "cashier" ? branch : null,
              notes: notes,
              // Password would be updated in a real backend
            };

            // Show success message
            toast.className = "toast-message success";
            toast.textContent = `✅ Account for "${fullName}" updated successfully!`;

            // Update the user name display
            document.getElementById("editUserName").textContent = fullName;

            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML =
              '<i class="fas fa-spinner fa-spin"></i> Updating...';

            setTimeout(() => {
              submitBtn.disabled = false;
              submitBtn.innerHTML =
                '<i class="fas fa-save"></i> Update Account';

              // Clear password fields
              document.getElementById("password").value = "";
              document.getElementById("confirmPassword").value = "";

              setTimeout(() => {
                toast.className = "toast-message";
                toast.textContent = "";
              }, 5000);
            }, 1500);
          });

        // ----- INIT -----
        loadUserData();
      })();
    </script>
  </body>
</html>
