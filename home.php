<?php
// Aloitetaan sessio
session_start();
// Jos käyttäjä ei ole kirjautunut sisään, ohjataan kirjautumissivulle
if (!isset($_SESSION['loggedin'])) {
	header('Location: membership.html');
	exit;
}
?>
<!-- Kirjautumisen jälkeen käyttäjä tulee tälle sivulle -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <link href="css/homestyle.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <title>Home Page</title>
	</head>
	<body>
	<header> <!-- Sivun yläosa (kuva ja musta tausta) -->
    	<img src="images/etusivu_isokuva.jpg" title="Some title" alt="Gym">
	</header>		
		<nav class="navtop">
			<div>
                <!-- Linkit profiilitietoihin, uloskirjautumiseen ja muiden käyttäjien selaamiseen -->
				<h1>Welcome, <?=$_SESSION['name']?>!</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a> 
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
				<a href="otherusers.php"><i class="fas fa-users"></i>Other users</a>
			</div>
		</nav>
		<div class="eka">
		<p>From the menu below, you can find our products and services</p>
			<ul>
			<li><a href="gymwear.html">Gymwear</a></li>
			<li><a href="accessories.html">Accessories</a></li>
			<li><a href="supplements.html">Supplements</a></li>
			<li><a href="programs.html">Programs</a></li>
			<li><a href="apply.html">Apply for coaching</a></li>
			<li><a href="membership.html">Membership</a></li>
			</ul>
		</div>
		<div class="container"> <!--Sisältö. Luokat "container", "row" ja "image" sisältävät omat css:t homestyle.css-tiedostossa-->
  <div class="row">
    <div class="text">All accessories for the gym. By clicking below the text, you can explore our selection.<br><br><strong><a href="accessories.html">Accessories</a></strong>
    </div>
    <img class="image" src="images/accessories.jpg" alt="Accessories">
  </div>
  <div class="row">
    <div class="text">Supplements to support your training. By clicking below the text, you can explore our selection.<br><br><strong><a href="supplements.html">Supplements</a></strong>
    </div>
    <img class="image" src="images/whey.jpg" alt="Creatine">
  </div>
  <div class="row">
    <div class="text">The latest fashion for the gym. By clicking below the text, you can explore our selection.<br><br><strong><a href="gymwear.html">Gymwear</a></strong>
    </div>
    <img class="image" src="images/RedShoes.jpg" alt="Grey Shoes">
  </div>
  <div class="row">
    <div class="text">Workout programs developed by professionals. By clicking below the text, you can explore our selection.<br><br><strong><a href="programs.html">Programs</a></strong>
    </div>
    <img class="image" src="images/programs.jpg" alt="Oversize shirt">
  </div>
  <div class="row">
    <div class="text">We have several coaches at our gym. By clicking below the text, you can get to know our coaches.<br><br><strong><a href="apply.html">Apply for coaching</a></strong>
    </div>
    <img class="image" src="images/valmennus.jpg" alt="OIP">
  </div>
  <div class="row">
    <div class="text">Join us as a loyal customer. By clicking below the text, you can explore the benefits of being a loyal customer.<br><br><strong><a href="membership.html">Membership</a></strong>
    </div>
    <img class="image" src="images/membership.jpg" alt="OIP">
  </div>
</div>
<footer> <!--Sivun alaosa -->
  <p>Bodybuilders @ 2024</p>
  <address><p>Pääskynpolku 313</p><br><p>12345 Pääskysaari</p><br><p>Puhelin: 010 010 010</p>
  </address>
</footer>
	</body>
</html>    