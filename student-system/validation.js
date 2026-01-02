function validateForm() {
    // Get elements by ID
    let nameEl = document.getElementById('name');
    let emailEl = document.getElementById('email');
    let yearEl = document.getElementById('year');
    let passwordEl = document.getElementById('password'); // Added for User registration
    
    // Validate Name (Used in Students and Users)
    if (nameEl) {
        if (nameEl.value.trim() === "") {
            alert("Name/Username must not be empty");
            return false;
        }
    }

    // Validate Year Level (Only for Students)
    if (yearEl) {
        let yearVal = parseInt(yearEl.value);
        if (isNaN(yearVal) || yearVal < 1 || yearVal > 5) {
            alert("Year level must be a number between 1 and 5");
            return false;
        }
    }

    // Validate Email (Only for Students)
    if (emailEl) {
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!emailEl.value.match(emailPattern)) {
            alert("Please enter a valid email address");
            return false;
        }
    }

    // Validate Password (For add_user.php)
    if (passwordEl) {
        if (passwordEl.value.length < 6) {
            alert("Password must be at least 6 characters long");
            return false;
        }
    }

    return true; // Form is valid
}