<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"">
    <!-- <link rel="stylesheet" href="css/index.css"> -->
    <link rel="stylesheet" href="css/all.min.css" />
    <script src="js/htmx.org@2.0.0"></script>
    <title>Afrinance Setup</title>
</head>
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
    --control-padding: 16px 20px;
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
    font-family: system-ui, -apple-system, sans-serif;
    min-height: 100vh;
    transition: background-img 0.2s, color 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* ----- PANEL CARD (reuse) ----- */

  /* ----- BUTTONS ----- */
  .btn-primary {
    background-color: var(--accent-color);
    color: #1a1a1a;
    font-weight: 600;
    border: none;
    padding: var(--control-padding);
    border-radius: var(--border-radius);
    width: 100%;
    cursor: pointer;
    font-size: 1.05rem;
    transition: filter 0.15s, transform 0.05s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
  }
  .btn-primary:hover {
    filter: brightness(1.05);
  }
  .btn-primary:active {
    transform: scale(0.97);
  }

  /* ----- FORM ELEMENTS ----- */
  input {
    background: var(--bg-color);
    color: var(--text-color);
    border: none;
    border-bottom: 1px solid var(--border);
    border-radius: var(--border-radius);
    /* */
    padding: var(--control-padding);
    width: 100%;
    font-size: 1rem;
    transition: border 0.2s;
  }
  input:focus {
    border-radius: var(--border-radius);
    outline: 2px solid var(--accent-color);
    outline-offset: 0px;
  }

  label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.4rem;
    font-size: 0.95rem;
    opacity: 0.8;
  }

  /* ----- LOGIN PAGE (isolated) ----- */
  .login-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    width: 100%;
    /* background: var(--bg-color); */
    padding: 1rem;
  }
  .login-panel {
    max-width: 420px;
    width: 100%;
    margin: 0 auto;
    padding: 2.5rem 2rem;
  }

  .text-center {
    text-align: center;
  }
  .mb-6 {
    margin-bottom: 1.5rem;
  }
  .space-y-5 > * + * {
    margin-top: 1.25rem;
  }
  .mt-2 {
    margin-top: 0.5rem;
  }

  /* small helper */
  .demo-hint {
    font-size: 0.75rem;
    opacity: 0.4;
    text-align: center;
    margin-top: 1rem;
  }

  /* error message */
  .error { color: red; margin-top: 10px; }

  /* ----- brand image (replaces icon) ----- */
  .brand-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    /* border-radius: 50%; */
    display: inline-block;
    /* box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); */
    /* background: var(--bg-panel);
    border: 2px solid var(--accent-color); */
    padding: 4px;
  }
  /* fallback if image fails */
  .brand-image[src=""] {
    display: none;
  }
  .brand-image-wrapper {
    display: flex;
    justify-content: center;
    margin-bottom: 0.5rem;
  }
</style>
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

        <form id="loginForm" class="space-y-5" hx-post="controls/create_user.php" hx-target="#error-container" hx-swap="innerHTML">
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
            <select id="Role" style="width: 100%; padding: var(--control-padding); border-radius: var(--border-radius); border: none; background: var(--bg-color); color: var(--text-color); font-size: 1rem;" name="role">
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