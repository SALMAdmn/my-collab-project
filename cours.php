<?php
// Connexion à la base
$db = new PDO("mysql:host=localhost;dbname=project;charset=utf8", "root", "");
$sql = "SELECT * FROM cours";
$stmt = $db->query($sql);
$cours = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

/* Navbar (inchangée) */
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

/* Titre section cours */
h2 {
  text-align: center;
  margin: 40px 0 10px;
  font-size: 28px;
  color: #007bff;
}

p.description-text {
  text-align: center;
  max-width: 700px;
  margin: 0 auto 30px;
  color: #444;
}

/* Conteneur de cartes */
.card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center; /* centre les cartes */
  gap: 30px; /* espace entre les cartes */
  padding: 20px 40px;
}

/* Carte */
.card {
  background-color: #fff;
  width: 300px;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  padding: 20px;
  text-align: center;
  transition: transform 0.2s;
}

.card:hover {
  transform: translateY(-5px);
}

.card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 15px;
}

.card h2 {
  font-size: 20px;
  color: #007bff;
  margin-bottom: 10px;
}

.card p {
  font-size: 14px;
  color: #555;
  margin-bottom: 10px;
}

.card button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px 18px;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bold;
}

.card button:hover {
  background-color: #0056b3;
}

/* Responsive mobile */
@media (max-width: 768px) {
  .nav-links {
    flex-direction: column;
    gap: 10px;
  }

  .card-container {
    flex-direction: column;
    align-items: center;
  }

  .card {
    width: 90%;
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

  <!-- Section cours -->
  <section>
    <h2>Cours</h2>
    <p>Découvrez nos différentes formules de cours en technologies web, adaptées à vos besoins et à votre rythme d'apprentissage :</p>

    <?php foreach ($cours as $c): ?>
      <div class="card">
<img src="admin/<?= htmlspecialchars($c['image']) ?>" alt="Image du cours">
        <h2 class="niveau"><?= htmlspecialchars($c['niveau']) ?></h2>
        <p class="titre"><strong><?= htmlspecialchars($c['titre']) ?></strong></p>
        <p class="description"><?= htmlspecialchars($c['description']) ?></p>
<a href="admin/<?= htmlspecialchars($c['fichier_pdf']) ?>" download>
          <button>Télécharger</button>
        </a>
      </div>
    <?php endforeach; ?>

  </section>
  
</body>
</html>
