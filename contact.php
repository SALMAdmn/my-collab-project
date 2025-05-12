<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact</title>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f4;
    }

    .navbar {
      background-color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .logo {
      font-size: 22px;
      font-weight: bold;
      color: #007bff;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 25px;
      margin: 0;
      padding: 0;
    }

    .nav-links a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    .nav-links a:hover {
      color: #007bff;
    }

    section {
      padding: 60px 40px;
      background: #fff;
    }

    section h2 {
      color: #007bff;
    }

    form {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      padding: 10px 20px;
      border: 1px solid #007bff;
      background: #007bff;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      opacity: 0.9;
    }

    .message {
      max-width: 600px;
      margin: 20px auto;
      text-align: center;
      font-weight: bold;
      color: green;
    }

    @media (max-width: 768px) {
      .nav-links {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="logo">Mohamed Saad AZIZI</div>
  <ul class="nav-links">
    <li><a href="index.html">À propos</a></li>
    <li><a href="recherche.html">Recherche</a></li>
    <li><a href="publications.html">Publications</a></li>
    <li><a href="cours.html">Cours</a></li>
    <li><a href="contact.php">Contact</a></li>
  </ul>
</nav>

<!-- Section Contact -->
<section>
  <h2>Contact</h2>
  <p>Vous avez une question ou besoin de plus d'informations ? Envoyez-nous un message :</p>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $to = "salmadahmane970@gmail.com"; 
      $name = htmlspecialchars($_POST["name"]);
      $email = htmlspecialchars($_POST["email"]);
      $message = htmlspecialchars($_POST["message"]);

      $subject = "Nouveau message depuis le formulaire de contact";
      $body = "Nom: $name\nEmail: $email\n\nMessage:\n$message";
      $headers = "From: $email";

      if (mail($to, $subject, $body, $headers)) {
          echo "<div class='message'>Message envoyé avec succès.</div>";
      } else {
          echo "<div class='message' style='color:red;'>Échec de l'envoi du message.</div>";
      }
  }
  ?>

  <form id="contactForm" method="POST" action="">
    <label for="name">Nom :</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Message :</label>
    <textarea id="message" name="message" rows="5" required></textarea>

    <button type="submit">Envoyer</button>
  </form>
</section>

<!-- Validation JavaScript -->
<script>
document.getElementById("contactForm").addEventListener("submit", function(event) {
  const email = document.getElementById("email").value;
  const name = document.getElementById("name").value;
  const message = document.getElementById("message").value;

  if (!name || !email || !message) {
    alert("Veuillez remplir tous les champs.");
    event.preventDefault();
  } else if (!/\S+@\S+\.\S+/.test(email)) {
    alert("Adresse email invalide.");
    event.preventDefault();
  }
});
</script>

</body>
</html>
