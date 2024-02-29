<?php
// Aloitetaan sessio
session_start();
// Jos käyttäjä ei ole kirjautunut sisään, ohjataan kirjautumissivulle
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!-- Kirjautumisen jälkeen käyttäjä tulee tälle sivulle -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Bodybuilding and training programs. Membership, memberpage.">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="css/mainstyle.css" rel="stylesheet" type="text/css" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Bodybuilders | Memberpage</title>
    <style>
.headline {
    background-image: url(images/etusivu_isokuva.jpg);
}       
.headline2 {
    background-image: url(images/painot.jpg);
}
.headline3 {
    background-image: url(images/gym1.jpg);
}
.client {
    background-image: url(images/heart.jpg);
}  
.client2 {
    background-image: url(images/thumb.jpg);
}
footer {
    background-image: url(images/trainee.jpg);
}
.fa-star {
    display: none;
}
/* Näyttää tähden hiiren ollessa tekstin päällä */
.text:hover .fa-star {
    display: inline-block;
    color: gold;
}
    </style>
</head>
<body>
    <header>
        <a href="index.html"><h1>BODYBUILDERS</h1></a>
    </header>
    <div class="headline">
    <p>WELCOME,<br><?=$_SESSION['name']?>!</p>
    </div>
<!-- Linkit profiilitietoihin, uloskirjautumiseen ja muiden käyttäjien selaamiseen -->
  <div class="container">
          <nav class="navbar navbar-expand-xl navbar-dark bg-black">        
            <div class="container-fluid">
              <ul class="navbar-nav mr-auto">  
                <li class="nav-item active">
                  <a class="nav-link" href="profile.php" style="font-size: 19px; filter: brightness(95%);">PROFILE</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="otherusers.php" style="font-size: 19px; filter: brightness(95%);">OTHER USERS</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="logout.php" style="font-size: 19px; filter: brightness(85%); color: gold;">LOG OUT</a>
                </li>
              </ul>
            </div>
          </nav>   
  <main>
    <div class="headline2">
            <p><strong>IN THE SECTION BELOW YOU WILL FIND OUR PRODUCTS</strong></p>
    </div>
    <div class="section">
        <div class="row">
        <img class="img-responsive" src= "images/accessories1.jpg" alt="gym accessories">
        <div class="text-box"><a href="accessories.html">ACCESSORIES</a></div>
        <div class="text"><a href="accessories.html">ALL ACCESSORIES FOR THE GYM</a>
        </div>
        </div>
        <div class="row">
        <img class="img-responsive" src="images/creatine1.jpg" alt="creatine">
        <div class="text-box"><a href="supplements.html">SUPPLEMENTS</a></div>
        <div class="text"><a href="supplements.html">SUPPLEMENTS TO SUPPORT YOUR TRAINING</a>
        </div>
        </div>
        <div class="row">
        <img class="img-responsive" src="images/gymwear.jpg" alt="gymwear">
        <div class="text-box"><a href="gymwearmember.html">GYMWEAR</a></div>
        <div class="text"><a href="gymwearmember.html">THE LATEST FASHION FOR THE GYM</a>
        </div>
        </div>
    </div>
<div class="headline3">
        <p><strong>IN THE SECTION BELOW YOU WILL FIND OUR SERVICES</strong></p>
</div>
<div class="section">
    <div class="row">
    <img class="img-responsive" src= "images/programs1.jpg" alt="gym programs">
    <div class="text-box"><a href="programs.html">PROGRAMS</a></div>
    <div class="text"><a href="programs.html">WORKOUT PROGRAMS</a>
    </div>
    </div>
    <div class="row">
    <img class="img-responsive" src="images/coaching.jpg" alt="coaching">
    <div class="text-box"><a href="personal_training.html">APPLY FOR COACHING</a></div>
    <div class="text"><a href="personal_training.html">GET TO KNOW OUR COACHES</a>
    </div>
    </div>
    <div class="row">
    <img class="img-responsive" src="images/vip.jpg" alt="gym membership">
    <div class="text-box"><a href="gymwearmember.html">VIP TIP: CHECK OUT OUR GYMWEAR PAGE!</a></div>
    <div class="text"><a class="show-stars">YOU ARE <i class="fa-regular fa-star"></i> A STAR</a>
    </div>
    </div>
</div>
</main>
</div>
<footer>
    <address>BODYBUILDERS<br>Punttikuja 313<br>12345 PUNTTILA</address>
</footer>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</body>
</html>    