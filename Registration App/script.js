document.addEventListener("DOMContentLoaded", () => {             // This waits until the whole HTML document is fully loaded.
  const registerForm = document.getElementById("registerForm");   // Checks if the register form exists on the current page.
  const loginForm = document.getElementById("loginForm");

  // Helper: show message
  function showMessage(elem, text, type = "error") {
    elem.innerText = text;
    elem.classList.remove("ok", "error");
    elem.classList.add(type === "ok" ? "ok" : "error");
  }

  // Strict email regex (matches server)
  const emailRegex = /^[A-Za-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[A-Za-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:(?:[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?\.)+[A-Za-z]{2,63})$/;

  // Password rule: min 8 chars, at least one lowercase, one uppercase, one digit, one special (@$!%*?&)
  const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

  // Registration
  if (registerForm) {
    registerForm.addEventListener("submit", (e) => {
      e.preventDefault();       // stops the form from reloading the page (handled manually with AJAX).

      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value;
      const confirm = document.getElementById("confirm_password").value;
      const message = document.getElementById("message");

      if (!name || !email || !password || !confirm) {
        showMessage(message, "All fields are required.");
        return;
      }

      if (!emailRegex.test(email)) {
        showMessage(message, "Invalid email format.");
        return;
      }

      if (!passwordPattern.test(password)) {
        showMessage(
          message,
          "Password must be at least 8 characters and include: one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&)."
        );
        return;
      }

      if (password !== confirm) {
        showMessage(message, "Passwords do not match.");
        return;
      }

      // Send data via AJAX
      fetch("register.php", {             // Sends data to register.php without reloading the page.
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}&confirm_password=${encodeURIComponent(confirm)}`,
      })            // encodeURIComponent() safely encodes user input for URLs.
        .then((res) => res.text())      // res = response & res.text() reads the body of that response as plain text (not JSON).
        .then((data) => {
          if (data.startsWith("SUCCESS|")) {
            const msg = data.split("|")[1] || "Welcome!";
            showMessage(message, msg, "ok");
            // brief delay to let user see message then redirect
            setTimeout(() => {
              window.location = "welcome.php";
            }, 700);            // wait for 700 milliseconds (0.7 seconds)
          } else {
            showMessage(message, data);
          }
        })
        .catch(() => showMessage(message, "Error submitting form."));
    });
  }

  // Login
  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      e.preventDefault();

      const email = document.getElementById("login_email").value.trim();
      const password = document.getElementById("login_password").value;
      const loginMsg = document.getElementById("login_message");

      if (!email || !password) {
        showMessage(loginMsg, "Email and password required.");
        return;
      }

      if (!emailRegex.test(email)) {
        showMessage(loginMsg, "Invalid email format.");
        return;
      }

      // If you have existing users with weaker passwords, consider removing this check.
      if (!passwordPattern.test(password)) {
        showMessage(
          loginMsg,
          "Password must be at least 8 characters and include: one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&)."
        );
        return;
      }

      fetch("login.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`,
      })
        .then((res) => res.text())
        .then((data) => {
          if (data.startsWith("SUCCESS|")) {
            const msg = data.split("|")[1] || "Welcome!";
            showMessage(loginMsg, msg, "ok");
            setTimeout(() => {
              window.location = "welcome.php";
            }, 700);
          } else {
            showMessage(loginMsg, data);
          }
        })
        .catch(() => showMessage(loginMsg, "Error submitting form."));
    });
  }
});
