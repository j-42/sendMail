<!DOCTYPE html>
<html >
  <head>
  	<meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Titre de la page</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
       function onSubmit(token) {
         document.getElementById("demo-form").submit();

       }
     </script>
  </head>
  <body class="body">
    <div class="div">
  <form method="post" action="<?php echo strip_tags($_SERVER['REQUEST_URI']); ?>" id="demo-form">
  <p class="z-mail">
    <label> FROM Adresse Email  </label><input type="text" name="senderemail" class="mail" />
  </p>
 

  <p class="z-mail">
    <label> Adresse Email  </label><input type="text" name="email" class="mail" />
  </p>
  
    <p class="z-textarea">
    <label>Objet</label><textarea rows="5" class="textarea" type="text" name="objet"></textarea>
  </p>

  <p class="z-textarea">
    <label>Votre Message</label><textarea rows="5" class="textarea" type="text" name="body"></textarea>
  </p>

  <button class="g-recaptcha" data-sitekey="6LcJpzwUAAAAAFBO3t4c7gJoT_Ex5YrFSCXzuIY6" data-callback='onSubmit'>Envoyer</button>

  </form>
</div>
  </body>
</html>
<?php
 
$mail = $_POST['email']; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
{
    $passage_ligne = "\r\n";
}
else
{
    $passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_html = $_POST['body'];
//==========


//=====Création de la boundary.
$boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());
//==========
  
//=====Définition du sujet.
$sujet = $_POST['objet'];
//=========



$senderemail = $_POST['senderemail'];

//=====Création du header de l'e-mail.

$header = "From:".$senderemail.$passage_ligne;
$header.= "Reply-to: $mailSig".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
  
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
  
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
  
//=====Ajout du message au format HTML.
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
  
//=====On ferme la boundary alternative.
$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
//==========
  
  
$message.= $passage_ligne."--".$boundary.$passage_ligne;
 
 
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
  
//==========
 
 if($_POST['submit']== true) {
  
}
?>















































