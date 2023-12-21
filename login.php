<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
        background-color: rgb(13, 110, 253);
    }

    .login-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 60px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .role-toggle {
        display: flex;
        justify-content: center;
    }

    .btn-role {
        position: relative;
        margin: 0 10px;
        font-size: 18px;
    }

    .btn-role input {
        display: none;
    }

    .btn-role label {
        cursor: pointer;
    }

    .btn-role .fa {
        font-size: 36px;
        display: block;
    }

    .btn-role.active .fa {
        color: #007bff;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .role-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 20px;
    }

    .role-box label {
        font-size: 14px;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="login-container">
            <h2 id="login-title">Students Login</h2>
            <div class="role-box">
                <label class="btn btn-role active" id="student-button">
                    <input type="radio" name="role" id="student" value="student" autocomplete="off" checked>
                    <i class="fa fa-user-graduate"></i> Student
                </label>
                <label class="btn btn-role" id="warden-button">
                    <input type="radio" name="role" id="warden" value="warden" autocomplete="off">
                    <i class="fa fa-user-shield"></i> Warden
                </label>
                <label class="btn btn-role" id="mess-secretary-button">
                    <input type="radio" name="role" id="ms" value="ms" autocomplete="off">
                    <i class="fa fa-utensils"></i> Mess Secretary
                </label>
                <label class="btn btn-role" id="hostel-secretary-button">
                    <input type="radio" name="role" id="hs" value="hs" autocomplete="off">
                    <i class="fa fa-user"></i> Hostel Secretary
                </label>
                <label class="btn btn-role" id="matron-button">
                    <input type="radio" name="role" id="matron" value="matron" autocomplete="off">
                    <i class="fa fa-user-nurse"></i> Matron
                </label>
                <label class="btn btn-role" id="staff-button">
                    <input type="radio" name="role" id="staff" value="staff" autocomplete="off">
                    <i class="fa fa-user"></i> Staff
                </label>
            </div>
            <form class="mt-3" onsubmit="return handleLogin()">
                <div class="form-group mt-4">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                        required>
                </div>
                <div class="form-group mt-4">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        required>
                </div>
                <input type="hidden" name="role" id="selectedRole" value="student"> <!-- Default role is student -->
                <button type="submit" class="btn btn-primary btn-block" onclick="setRole()">Login</button>
            </form>
            <div id="toast" class="toast-msg">Login failed. Please check your credentials.</div>
            <p class="mt-3"><a href="php/hoste_student_registration.php">Register here</a></p>
        </div>
    </div>

    <script>
    function showToast(message) {
        var toast = document.getElementById('toast');
        toast.innerHTML = message;
        toast.style.display = 'block';
        setTimeout(function() {
            toast.style.display = 'none';
        }, 2000);
    }

    // Add this PHP code snippet to display the toast on login failure
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $total == 0) {
            echo "showToast('Login failed. Please check your credentials.');";
        }
        ?>
    </script>

    <script>
    function setRole() {
        const activeButton = document.querySelector('.btn-role.active');
        const selectedRole = activeButton.querySelector('input').value;
        document.getElementById('selectedRole').value = selectedRole;
    }

    const roleButtons = document.querySelectorAll('.btn-role');
    const loginTitle = document.getElementById('login-title');

    roleButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            roleButtons.forEach(function(btn) {
                btn.classList.remove('active');
            });
            button.classList.add('active');
            loginTitle.innerHTML = button.innerText + ' Login';
        });
    });
    </script>
    <script>
    function handleLogin() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var role = document.querySelector('.btn-role.active input').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/login_process.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    if (xhr.responseText === 'success') {
                        switch (role) {
                            case 'student':
                                window.location.href = 'php/dashboard/studentDashboard/student_dashboard.php';
                                break;
                            case 'warden':
                                window.location.href = 'php/dashboard/wardenDashboard/warden_dashboard.php';
                                break;
                            case 'ms':
                                window.location.href = 'php/dashboard/msDashboard/mess_secretary_dashboard.php';
                                break;
                            case 'hs':
                                window.location.href = 'php/dashboard/hsDashboard/hostel_secretary_dashboard.php';
                                break;
                            case 'matron':
                                window.location.href = 'php/dashboard/matronDashboard/matron_dashboard.php';
                                break;
                            case 'staff':
                                window.location.href = 'php/dashboard/staffDashboard/staff_dashboard.php';
                                break;
                            default:
                                window.location.href = 'default_dashboard.php';
                                break;
                        }
                    } else {
                        showToast('Login failed. Please check your credentials.');
                    }
                } else {
                    // Handle other HTTP statuses if needed
                }
            }
        };

        var formData = 'username=' + username + '&password=' + password + '&role=' + role;
        xhr.send(formData);

        return false;
    }
    </script>

    <!-- Link to Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>