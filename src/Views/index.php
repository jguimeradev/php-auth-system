<?php include 'includes/header.php'; ?>
<style>
    body {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .auth-container {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 60px 50px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        text-align: center;
        max-width: 500px;
        width: 90%;
        animation: fadeIn 0.6s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    h1 {
        color: #667eea;
        font-weight: 700;
        margin-bottom: 20px;
        font-size: 2.5rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .subtitle {
        color: #6c757d;
        margin-bottom: 40px;
        font-size: 1.1rem;
    }

    .btn-custom {
        padding: 15px 50px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        border: none;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 10px;
        min-width: 200px;
    }

    .btn-login {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-signup {
        background: white;
        color: #667eea;
        border: 3px solid #667eea;
    }

    .btn-signup:hover {
        background: #667eea;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .icon {
        font-size: 4rem;
        color: #667eea;
        margin-bottom: 20px;
    }

    .buttons-container {
        margin-top: 30px;
    }
</style>

<body>
    <div class="auth-container">
        <div class="icon">🔐</div>
        <h1>PHP Auth System</h1>
        <p class="subtitle">Secure User Management Platform</p>

        <div class="buttons-container">
            <a href="login.php" class="btn btn-login btn-custom">Log In</a>
            <a href="/register" class="btn btn-signup btn-custom">Sign Up</a>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>