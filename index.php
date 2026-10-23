<!DOCTYPE html>
<html>

<head>

    <title>
        Pharmacy Management Login
    </title>

    <link
    rel="stylesheet"
    href="css/style.css">

    <link rel="preconnect"
    href="https://fonts.googleapis.com">

    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
    rel="stylesheet">

</head>

<body class="login-page">

<div class="background-circle one"></div>
<div class="background-circle two"></div>

<div class="login-container">

    <div class="login-left">

        <h1>
        💊Sotota Pharmacy 
        </h1>

        <p>
            Smart Pharmacy Management Dashboard
        </p>

        <img
        src="https://cdn.creativefabrica.com/2020/02/11/Medicine-Logo-Graphics-1-2.jpg"
        width="200">

    </div>

    <div class="login-box">

        <h2>
            Welcome Back 👋
        </h2>

        <p>
            Login to continue
        </p>

        <form
        action="php/login.php"
        method="POST">

            <div class="input-group">

                <label>
                    Username
                </label>

                <input
                type="text"
                name="username"
                placeholder=" Enter username "
                required>

            </div>

            <div class="input-group">

                <label>
                    Password
                </label>

                <input
                type="password"
                name="password"
                placeholder="Enter password"
                required>

            </div>

            <button type="submit">

                Login

            </button>

        </form>

        <div class="login-footer">

            © Pharmacy Management System

        </div>

    </div>

</div>

</body>
</html>