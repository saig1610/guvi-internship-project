document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");
  const responseMsg = document.getElementById("responseMsg");

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
        // ✅ Set localStorage before redirecting
        localStorage.setItem("loggedInUser", email);
        console.log("📥 Stored email in localStorage:", email);

        // ✅ Show success message first
        responseMsg.style.color = "lightgreen";
        responseMsg.innerText = "Login successful! Redirecting...";

        // ✅ Delay redirect
        setTimeout(() => {
          window.location.href = "profile.html";
        }, 1500);
      } else {
        responseMsg.style.color = "red";
        responseMsg.innerText = data.message || "Invalid email or password";
      }
    })
    .catch(err => {
      console.error("❌ Fetch error:", err);
      responseMsg.style.color = "red";
      responseMsg.innerText = "Server error. Please try again later.";
    });
});

document.getElementById("togglePassword").addEventListener("change", function () {
  const passwordInput = document.getElementById("password");
  passwordInput.type = this.checked ? "text" : "password";
});
