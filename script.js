// Login buttons
document.querySelectorAll('.login-btn').forEach(button => {
    button.addEventListener('click', function() {
        const userType = this.closest('.card').classList.contains('members-card') ? 'member' : 'instructor';
        handleLogin(userType);
    });
});

// Register buttons
document.querySelectorAll('.register-btn').forEach(button => {
    button.addEventListener('click', function() {
        const userType = this.closest('.card').classList.contains('members-card') ? 'member' : 'instructor';
        handleRegister(userType);
    });
});

function handleLogin(userType) {
    if (userType === 'member') {
        window.location.href = '/member-login'; // Replace with your actual member login URL
    } else {
        window.location.href = '/instructor-login'; // Replace with your actual instructor login URL
    }
}

function handleRegister(userType) {
    if (userType === 'member') {
        window.location.href = '/member-register'; // Replace with your actual member registration URL
    } else {
        window.location.href = '/instructor-register'; // Replace with your actual instructor registration URL
    }
} 