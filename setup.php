<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"">
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/setup.css" />
    <script src="js/htmx.org@2.0.0.js"></script>
    <title>Afrinance Setup</title>
</head>
<body>
    <!-- ========== SETUP PAGE (standalone) ========== -->
    <div class="login-wrapper">
      <div class="login-panel panel-card">
        <div class="text-center mb-6">
          <!-- IMAGE REPLACES THE ICON -->
          <div class="brand-image-wrapper">
            <img class="brand-image" src="views/brand/logo-green.png" alt="Afrinance" onerror="this.style.display = 'none'"/>
          </div>
          <h1 style="font-size: 1.8rem; font-weight: 700; margin-top: 0.25rem">
            Afrinance Setup
          </h1>
          <p style="opacity: 0.6; font-size: 0.95rem; margin-top: 0.25rem">
            Create your first user
          </p>
        </div>

        <!-- Error messages from PHP render here -->
        <div id="error-container" class="error"></div>

        <form id="loginForm" class="space-y-5" hx-post="controls/initial_setup.php" hx-target="#error-container" hx-swap="innerHTML">
          <div>
            <!-- <label for="loginUsername">Username</label> -->
            <input
              id="loginUsername"
              type="text"
              placeholder="Enter username"
              required
              name="username"
              value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
            />
          </div>
          <div>
            <!-- <label for="loginPassword">Password</label> -->
            <input
              id="loginPassword"
              type="password"
              placeholder="Enter password"
              required
              name="password"
            />
          </div>
          <div>
            <!-- <label for="loginPassword">Confirm Password</label> -->
            <input
              id="loginConfirmPassword"
              type="password"
              placeholder="Confirm password"
              required
              name="confirm_password"
            />
          </div>
          <div>
            <!-- <label for="Role">Role</label> -->
            <select id="Role" name="role">
              <option value="" disabled selected>Select role</option>
              <option value="admin">Admin</option>
              <option value="accountant">Accountant</option>
              <option value="operator">Operator</option>
            </select>
          </div>
          <button type="submit" class="btn-primary">
            <i class="fas fa-sign-in-alt"></i> Create User
          </button>
        </form>

        <!-- <div class="demo-hint">demo: cashier1 / 1234</div> -->
      </div>
    </div>
    
</body>
</html>