<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <style>
        .form-widget {
            display: grid;
            grid-template-columns: 1fr 3fr;
            column-gap: 10px;
            margin-bottom: 10px;
        }

        .form-widget label {
            text-align: right;
        }

        #form {
            width: 50%;
            min-width: 500px;
            margin: 15px auto;
        }
    </style>
</head>
<body>
<div id="form">
    <div class="form-widget">
        <span></span>
        <h1>Inscription</h1>
    </div>
    <form method="post">
        <div class="form-widget">
            <label for="userName">login</label>
            <input type="text" id="userName" name="userName">
        </div>
        <div class="form-widget">
            <label for="userFullName">Nom</label>
            <input type="text" id="userfullName" name="userFullName">
        </div>
        <div class="form-widget">
            <label for="userPass">Mot de passe</label>
            <input type="password" id="userPass" name="userPass">
        </div>
        <div class="form-widget">
            <label for="userPassConfirm">Confirmation</label>
            <input type="password" id="userPassConfirm" name="userPassConfirm">
        </div>

        <div class="form-widget">
            <span></span>
            <button type="submit" name="submit">Valider</button>
        </div>
    </form>
    </div>
    
</body>
</html>