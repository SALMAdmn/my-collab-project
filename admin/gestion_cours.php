<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'nom_de_ta_base');
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Ajouter un cours si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $niveau = $_POST['niveau'];
    
    // Gérer l'upload de l'image
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    
    // Gérer l'upload du fichier PDF
    $fichier_pdf = $_FILES['fichier_pdf']['name'];
    move_uploaded_file($_FILES['fichier_pdf']['tmp_name'], "pdf/" . $fichier_pdf);

    // Requête pour insérer le cours
    $sql = "INSERT INTO cours (titre, description, niveau, image, fichier_pdf) 
            VALUES ('$titre', '$description', '$niveau', '$image', '$fichier_pdf')";

    if ($conn->query($sql) === TRUE) {
        echo "Cours ajouté avec succès.";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Récupérer les cours de la base de données
$sql = "SELECT * FROM cours";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Cours</title>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f4;
    }
    img{
      width: 200px;
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

    /* Cartes de prix */
    .pricing-container {
      margin-top: 30px;
      background: white;
      border-radius: 15px;
      padding: 30px;
      display: flex;
      gap: 20px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      flex-wrap: wrap;
      justify-content: center;
    }

    .card {
      background: white;
      border-radius: 10px;
      padding: 20px;
      text-align: center;
      flex: 1 1 250px;
      min-width: 250px;
    }

    .card img {
      width: 100px;
      height: auto;
      margin-bottom: 15px;
    }

    .card h2 {
      color: #555;
      margin: 10px 0;
    }

    .feature {
      color: #007bff;
      margin: 5px 0;
    }

    button {
      padding: 10px 20px;
      border: 1px solid #007bff;
      background: white;
      color: #007bff;
      border-radius: 5px;
      cursor: pointer;
    }

    button.filled {
      background: #007bff;
      color: white;
    }

    button:hover {
      opacity: 0.9;
    }

    @media (max-width: 768px) {
      .pricing-container {
        flex-direction: column;
        align-items: center;
      }

      .card {
        width: 90%;
      }

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
      <li><a href="cours.php">Cours</a></li>
      <li><a href="contact.html">Contact</a></li>
    </ul>
  </nav>

  <!-- Section Cours -->
  <section>
    <h2>Cours</h2>
    <p>Découvrez nos différentes formules de cours en technologies web, adaptées à vos besoins et à votre rythme d'apprentissage :</p>

    <div class="pricing-container">
      <?php
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo '<div class="card">';
          echo '<img src="uploads/' . $row['image'] . '" alt="' . $row['titre'] . '">';
          echo '<h2>' . $row['titre'] . '</h2>';
          echo '<p class="feature">' . $row['description'] . '</p>';
          echo '<a href="pdf/' . $row['fichier_pdf'] . '" download>';
          echo '<button>Télécharger</button>';
          echo '</a>';
          echo '</div>';
        }
      } else {
        echo "Aucun cours trouvé.";
      }
      ?>
    </div>

    <!-- Formulaire d'ajout de cours -->
    <h3>Ajouter un Cours</h3>
    <form action="cours.php" method="POST" enctype="multipart/form-data">
      <label for="titre">Titre :</label>
      <input type="text" name="titre" id="titre" required>

      <label for="description">Description :</label>
      <textarea name="description" id="description" required></textarea>

      <label for="niveau">Niveau :</label>
      <select name="niveau" id="niveau" required>
        <option value="Débutant">Débutant</option>
        <option value="Intermédiaire">Intermédiaire</option>
        <option value="Avancé">Avancé</option>
      </select>

      <label for="image">Image :</label>
      <input type="file" name="image" id="image" accept="image/*">

      <label for="fichier_pdf">Fichier PDF :</label>
      <input type="file" name="fichier_pdf" id="fichier_pdf" accept=".pdf" required>

      <button type="submit">Ajouter Cours</button>
    </form>
  </section>

</body>
</html>

<?php
$conn->close();
?>
