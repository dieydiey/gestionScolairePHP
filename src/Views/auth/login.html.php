<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to right, #FDF6EC, #FFF1E0);
        color: #5E2C2C;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background-color: #ffffff;
        padding: 40px 30px;
        border-radius: 20px;
        box-shadow: 0 12px 30px rgba(94, 44, 44, 0.2);
        width: 100%;
        max-width: 500px;
        text-align: center;
    }

    .login-container h2 {
        margin-bottom: 30px;
        font-size: 1.8rem;
        color: #5E2C2C;
    }

    .input-group {
        margin-bottom: 20px;
        text-align: left;
        width: 80%;
    }

    .input-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #5E2C2C;
    }

    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #C56F4B;
    }

    .input-icon input {
        width: 100%;
        padding: 12px 12px 12px 40px;
        border: 1px solid #D9CFC1;
        border-radius: 10px;
        font-size: 1rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .input-icon input:focus {
        border-color: #F4A261;
        box-shadow: 0 0 6px #f4a26166;
        outline: none;
    }

    .btn-login {
        width: 100%;
        padding: 14px;
        background: linear-gradient(to right, #F4A261, #D37676);
        color: white;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .btn-login:hover {
        transform: scale(1.03);
        background: #C56F4B;
    }

    .error {
        background-color: #FCEAE8;
        color: #882828;
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 20px;
        border-left: 5px solid #D37676;
        text-align: center;
        font-weight: 600;
    }

    .forgot-password {
        text-align: right;
        margin-top: -10px;
        margin-bottom: 20px;
    }

    .forgot-password a {
        color: #A35442;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .forgot-password a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-container">
    <h2>Connexion</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="/gestionScolairePHP/public/index.php?controller=security&page=login" method="POST">

        <div class="input-group">
            <label for="login">Login</label>
            <div class="input-icon">
                <i class="fas fa-user"></i>
                <input type="text" name="login" id="login" required placeholder="Votre identifiant">
            </div>
        </div>

        <div class="input-group">
            <label for="mot_de_passe">Mot de passe</label>
            <div class="input-icon">
                <i class="fas fa-lock"></i>
                <input type="password" name="mot_de_passe" id="mot_de_passe" required placeholder="********">
            </div>
        </div>

        <div class="forgot-password">
            <a href="#">Mot de passe oublié ?</a>
        </div>

        <button type="submit" name="btn_connexion" class="btn-login">Se connecter</button>
    </form>
</div>

</body>
</html>
