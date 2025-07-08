document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");
  const responseMsg = document.getElementById("responseMsg");

  // Clear old messages
  emailError.innerText = "";
  passwordError.innerText = "";
  responseMsg.innerText = "";

  let hasError = false;

  if (!email) {
    emailError.innerText = "Email is required";
    hasError = true;
  }

  if (!password) {
    passwordError.innerText = "Password is required";
    hasError = true;
  }

  if (hasError) return;

  // AJAX login request
  fetch("php/login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
  })
    .then(res => {
      if (!res.ok) throw new Error(`HTTP error ${res.status}`);
      return res.json();
    })
    .then(data => {
      console.log("✅ Server response:", data);

      if (data.success) {
        // Save email in localStorage
        localStorage.setItem("loggedInUser", email);
        console.log("📥 Stored email in localStorage:", email);

        // Success message
        responseMsg.innerText = "Login successful! Redirecting...";

        // Redirect after short delay
        setTimeout(() => {
          window.location.href = "profile.html";
        }, 1500);
      } else {
        // Show error from backend
        responseMsg.innerText = data.message || "Invalid email or password";
      }
    })
    .catch(err => {
      console.error("❌ Fetch error:", err);
      responseMsg.innerText = "Server error. Please try again later.";
    });
});

// Toggle password visibility
document.getElementById("togglePassword").addEventListener("click", function () {
  const passwordInput = document.getElementById("password");
  const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);

  // Optional: toggle icon style
  this.classList.toggle("fa-eye-slash");
});
