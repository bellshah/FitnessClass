function validateForm() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const passwordError = document.getElementById('passwordError');

    if (password !== confirmPassword) {
        passwordError.textContent = 'Passwords do not match';
        return false;
    }

    // Add your registration logic here
    // You would typically send this data to your backend server
    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        password: password
    };

    console.log('Registration data:', formData);
    return false; // Prevent form submission for now
}

function handleLogin(event) {
    event.preventDefault();

    const formData = {
        email: document.getElementById('email').value,
        password: document.getElementById('password').value
    };

    // Add your login logic here
    // You would typically send this data to your backend server
    console.log('Login data:', formData);
    return false;
} 