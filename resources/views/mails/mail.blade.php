<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Nouveau mot de passe Email</title>
    <style>
      body {
        background-color: #f5eaea;
        font-family: Arial, sans-serif;
        font-size: 16px;
        color: #333;
        line-height: 1.5;
      }
      h1 {
        color: #ff0000;
        font-size: 24px;
        margin-bottom: 20px;
      }
      p {
        margin-bottom: 20px;
      }
      .password:hover {
        background-color: #ffe7f4;
      }
      .password {
        background-color: #f2f2f2;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        font-size: 20px;
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <h1>Votre nouveau mot de passe</h1>
    <p>Cher {{$name}},</p>
    <p>
      Votre nouveau mot de passe est : <span class="password">{{$password}}</span>
    </p>
    <p>
      Veuillez utiliser ce mot de passe pour vous connecter à votre compte. Nous vous recommandons de changer votre mot de passe après vous être connecté(e) à des fins de sécurité.
    </p>
    <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>
    <p>Merci,</p>
    <p><strong>FSSM-Support</strong></p>
  </body>
</html>
