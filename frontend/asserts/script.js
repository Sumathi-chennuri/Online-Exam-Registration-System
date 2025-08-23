document.addEventListener("DOMContentLoaded", function () {
    console.log("Script loaded successfully!"); // Debugging check

    // ========== INDEX PAGE ==========
    if (window.location.pathname.includes("index.html")) {
        console.log("Index page detected!"); // Debugging check

        const registerButton = document.getElementById("Register");
        const loginButton = document.getElementById("login");

        if (registerButton) {
            registerButton.addEventListener("click", function () {
                console.log("Navigating to Register Page");
                window.location.href = "register.html";
            });
        }

        if (loginButton) {
            loginButton.addEventListener("click", function () {
                console.log("Navigating to Login Page");
                window.location.href = "login.html";
            });
        }
    }
    // ========== REGISTRATION ==========
    if (window.location.pathname.includes("register.html")) {
        const registerForm = document.getElementById("registerForm");

        if (registerForm) {
            registerForm.addEventListener("submit", function (e) {
                e.preventDefault();

                let email = document.getElementById("email").value;
                let password = document.getElementById("password").value;

                if (email && password) {
                    localStorage.setItem("registeredEmail", email);
                    localStorage.setItem("registeredPassword", password);
                    alert("Registration successful! Please login.");
                    window.location.href = "login.html";
                } else {
                    alert("Please enter a valid email and password.");
                }
            });
        }
    }

    // ========== LOGIN ==========
    if (window.location.pathname.includes("login.html")) {
        const loginForm = document.getElementById("loginForm");

        if (loginForm) {
            loginForm.addEventListener("submit", function (e) {
                e.preventDefault();

                let email = document.getElementById("email").value;
                let password = document.getElementById("password").value;

                let storedEmail = localStorage.getItem("registeredEmail");
                let storedPassword = localStorage.getItem("registeredPassword");

                if (email === storedEmail && password === storedPassword) {
                    localStorage.setItem("loggedIn", "true");
                    alert("Login successful!");
                    window.location.href = "dashboard.html";
                } else {
                    document.getElementById("error-message").textContent = "Incorrect email or password!";
                    document.getElementById("error-message").style.display = "block";
                }
            });
        }
    }
// ========== DASHBOARD (Restrict Access) ==========
if (window.location.pathname.includes("dashboard.html")) {
    if (localStorage.getItem("loggedIn") !== "true") {
        window.location.href = "login.html"; // Redirect to login if not logged in
    }

    // Logout Button - Clears session and redirects to Login
    const logoutButton = document.getElementById("logoutButton");
    if (logoutButton) {
        logoutButton.addEventListener("click", function () {
            localStorage.clear(); // Clears all stored data
            alert("Logged out successfully!");
            window.location.href = "login.html"; // Redirect to login page
        });
    }

    // Exam List Button - Redirects to Exam List Page
    const examListButton = document.getElementById("examListButton");
    if (examListButton) {
        examListButton.addEventListener("click", function () {
            window.location.href = "examlist.html"; // Redirect to exam list
        });
    }
}
    // ========== EXAM LIST ==========
    if (window.location.pathname.includes("examlist.html")) {
        const examButtons = document.querySelectorAll(".exam-btn");

        if (examButtons.length === 0) {
            console.error("No exam buttons found! Check your HTML structure.");
        }

        examButtons.forEach(button => {
            button.addEventListener("click", function () {
                const subject = this.getAttribute("data-subject");
                const cost = this.getAttribute("data-cost");

                console.log(`Selected Exam: ${subject} | Cost: $${cost}`);

                localStorage.setItem("selectedExam", subject);
                localStorage.setItem("examCost", cost);

                window.location.href = "payment.html"; // Redirect to Payment Page
            });
        });
    }



    // ========== PAYMENT ==========
    if (window.location.pathname.includes("payment.html")) {
        console.log("Payment page detected!"); // Debugging check

        const selectedExam = localStorage.getItem("selectedExam") || "No exam selected";
        const examCost = localStorage.getItem("examCost") || "0";

        document.getElementById("selectedExam").textContent = selectedExam;
        document.getElementById("examCost").textContent = `$${examCost}`;

        const payButton = document.getElementById("payButton");
        if (payButton) {
            payButton.addEventListener("click", function () {
                const paymentMethod = document.getElementById("paymentMethod").value;

                if (paymentMethod) {
                    console.log("Payment method selected:", paymentMethod);

                    // Store payment method in localStorage
                    localStorage.setItem("paymentMethod", paymentMethod);
                    alert("Payment Successful!");

                    //  Redirect to confirmation page
                    window.location.href = "confirmation.html";
                } else {
                    alert("Please select a payment method.");
                }
            });
        }
    }

if (window.location.pathname.includes("confirmation.html")) {
        console.log("Confirmation page detected!"); // Debugging check

        const selectedExam = localStorage.getItem("selectedExam") || "No exam selected";
        const examCost = localStorage.getItem("examCost") || "0";
        const paymentMethod = localStorage.getItem("paymentMethod") || "Not selected";

        document.getElementById("confirmExam").textContent = selectedExam;
        document.getElementById("confirmCost").textContent = `$${examCost}`;
        document.getElementById("confirmPaymentMethod").textContent = paymentMethod;

        // Logout Button - Redirects to Login Page
        document.getElementById("logoutButton").addEventListener("click", function () {
            localStorage.clear(); // Clears all stored data
            alert("Logged out successfully. Redirecting to login page.");
            window.location.href = "login.html"; // Redirect to login page
        });

        // Home Button - Redirects to Index Page
        document.getElementById("homeButton").addEventListener("click", function () {
            alert("Redirecting to home page.");
            window.location.href = "index.html"; // Redirect to home page
        });
    }

});