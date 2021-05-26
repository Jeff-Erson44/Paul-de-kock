<?php

date_default_timezone_set('Europe/Paris');

session_start();


function flash_in($type, $message)
{

    if (empty($_SESSION['message'])) $_SESSION['message'] = array();
    array_push($_SESSION['message'], array($type, $message));
}

function flash_out()
{
    $errors = array();
    $success = array();

    if(!empty($_SESSION['message'])){
       foreach($_SESSION['message'] as $message){
        if($message[0] == 'error') $errors[] = $message[1];
        if($message[0] == 'success') $success[] = $message[1];
       }       
    }
    $messages = '';
    if(!empty($errors)){
        $messages .= '<p class="alert alert-danger">'.(implode('<br>',$errors)).'</p>';
    }
    if(!empty($success)){
        $messages .= '<p class="alert alert-success">'.(implode('<br>',$success)).'</p>';
    }
    unset($_SESSION['message']); // On retire les messages qui étaient en attente d'affichage
    return $messages;
}

$_POST = array_map('trim', $_POST);

if (!empty($_POST)) {

    $errors = 0;

    if (empty($_POST['nom'])) {
        flash_in('error', 'Merci de renseigner votre nom');
        $errors++;
    }

    if (!empty($_POST['email'])) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            flash_in('error', 'Merci de renseigner une adresse email valide');
            $errors++;
        }
    }
    else {
        flash_in('error', 'Merci de renseigner une adresse email');
        $errors++;
    }
    if (empty($_POST['message'])) {
        flash_in('error', 'Merci de renseigner votre message');
        $errors++;
    }

    if ($errors == 0) {
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/html; charset=UTF-8";
        $headers[] = 'From: '. $_POST['prenom'] .' '. $_POST['nom'] . '<' . $_POST['email'] . '>';

        $mail = 'elisab.ngo@gmail.com';
        $sujet = '[' .$_POST['prenom']. ' ' .$_POST['nom']. ']';
        $message ='<p>De '.$_POST['nom'].' '.$_POST['prenom'].'<p>'.'</p>'.'<hr>'.'<p>Message : '.$_POST['message'] .'</p>'.'<br>';
        // str_replace(ce que je veux remplacer, par quoi, dans quelle chaine)
    
        mail($mail, $sujet, $message, implode(PHP_EOL, $headers) );
    
        // implode transforme un tableau en chaine caractères avec un séparateur entre chaque élément du tableau
        //   ligne 1 PHP_EOL ligne 2 PHP_EOL ligne 3
        // implode(séparateur, tableau)
    
        $chaine = "2021-02-15";
        $tab = explode('-',$chaine); // transforme une chaine en tableau en utilisant le séparateur spécifié entre chaque élément 
        // tab[0] => année
        // tab[1] => mois

        flash_in('success', 'Message envoyé');
    }
    
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Balise META -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="expires" content="43200"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"  content="Paul de Kock, Remorquage automobile. Intervention en urgence ou sur RDV, Paris et Ile-de-France. Remorquage tout type de véhicules, en sous-sol, brûlée, accidenté. Dépanneur professionnel, services efficace et rapide.">
    <meta name="robots" content="all"> 
    <title>R Paul de Kock</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Authenticité de la page -->
    <link rel="canonical" href="https://Paul-de-kock.fr" />
    <!-- RESET CSS -->
    <link rel="stylesheet" href="asset/css/reset.css">
    <!-- FONTAWESOME CSS -->
    <link rel="stylesheet" href="asset/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- LOCOMOTIVE SCROLL -->
    <link rel="stylesheet" href="../Paul-de-kock/asset/css/locomotive-scroll.css">
    <!-- LIGHTBOX CDN -->
    <link rel="stylesheet" href="asset/css/lightbox.min.css">
    <!-- FAVICON optimisé pour tout les devices-->
    <!-- MAP -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

   <script src='https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js'></script>
   <link href='https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css' rel='stylesheet' />

   



    
    

</head>
<body onload="init()">
    <header>
        <nav class="menu_desktop">
            <ul>
                <li><a href="#quisommesnous">Qui sommes-nous</a></li>
                <li><a href="#prestations">Nos prestations</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>

    </header>

<!---------->
<!-- MAIN -->
<!---------->
    <main>

        <!-- ACCUEIL -->
        <i class="fas fa-chevron-left"></i>
        <i class="fas fa-chevron-right"></i>
        
        <div class="logo">
            <svg class="theLogo" id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.92 60.02"><defs><style>.cls-1{font-size:54.07px;fill:#ffffff;font-family:BrushScriptStd, Brush Script Std;}</style></defs><text class="cls-1" transform="translate(0 44.88)"><tspan xml:space="preserve">Paul de Kock </tspan></text></svg>
        </div>

        <figure class="diapo">
            <img class="banniere" src="asset/img/203.jpg" alt=" image diapo">
            <img class="banniere2" src="asset/img/203-mobile.jpg" alt=" image diapo responsive">
        </figure>

        <div class="containeur-accueil">
            <h2>Interventions sur Paris et en Île-de-France</h2>
            <h1>Atelier de dépannage automobile</h1>
            <p>
                <button type="button">En savoir plus</button>
            </p>
        </div>
        <!-- ACCUEIL FIN -->

        <!-- QUI SOMMES NOUS -->
        <section id="quisommesnous">
            <h2 class="title title-about">Qui sommes-nous</h2>
            <div class="container-about">
                <div class="image-about">
                    <figure>
                        <img class="img-about" src="asset/img/paulfake.jpg" alt="">
                    </figure>
                </div>
                <div class="texte-about">
                    <h3 class="subtitle-about">Paul de Kock</h3>
                    <p class="texte">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores sunt, excepturi perferendis harum illum recusandae laudantium voluptates maiores non eum possimus cum vel quibusdam soluta. Mollitia quam totam ullam perferendis!</p>
                    <p>
                        <button type="button" class="button-about primary">contactez-moi</button>
                    </p>
                </div>
            </div>
        </section>
        <!-- QUI SOMMES NOUS FIN -->


        <!-- BANDEAU COMPTEURS -->
        <div class="bandeau">
            <ul class="ul-bandeau">
                <li class="li-bandeau">
                    <i class="fas fa-building"></i>
                    <div class="text-counter">Nous existons depuis <div>
                    <div class="counter" data-target="21"></div>
                    <div class="text-counter"> Ans <div>
                </li>
                <li class="li-bandeau">
                    <i class="fas fa-hands-helping"></i>
                    <div class="text-counter">Nous avons plus de  <div>
                    <div class="counter" data-target="8"> Number </div>
                    <div class="text-counter"> Partenaires <div> 
                </li> <li class="li-bandeau">
                    <i class="fas fa-star"></i>
                    <div class="text-counter">Nous sommes né en <div>
                    <div class="counter" data-target="2000"> Number </div>
                </li>
            </ul>
        </div>

       <!--BANDEAU COMPTEURS FIN  -->

        <!-- NOS PRESTATIONS -->
        <section id="prestations">
            <div class="image-presta">
                <figure>
                    <img class="img-presta" src="asset/img/presta-bg.jpg" alt="nos prestations">
                </figure>
                <h2 class="title title-presta">Nos prestations</h2>
            </div>
            <div class="container-presta">
                <!--.box-presta*3>img+article-->
                <div class="box-presta">
                    <img src="asset/img/presta1.jpg" data-lightbox="mygallery" alt="prestation">
                    <article class="article-presta">
                        <h4>Paul de Kock</h4>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus dolor ea nulla? Dolor officia natus nostrum, ab voluptatum odit itaque maxime, veritatis similique animi voluptates perferendis nobis labore modi sapiente.</p>
                    </article>
                </div>
                <div class="box-presta">
                    <article class="article-presta">
                        <h4>Paul de Kock</h4>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus dolor ea nulla? Dolor officia natus nostrum, ab voluptatum odit itaque maxime, veritatis similique animi voluptates perferendis nobis labore modi sapiente.</p>
                    </article>
                    <img class="image-presta" src="asset/img/presta2.jpg" data-lightbox="mygallery" alt="prestation">
                </div>
                <div class="box-presta">
                    <img class="image-presta" src="asset/img/presta3.jpg" data-lightbox="mygallery" alt="prestation">
                    <article class="article-presta">
                        <h4>Paul de Kock</h4>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus dolor ea nulla? Dolor officia natus nostrum, ab voluptatum odit itaque maxime, veritatis similique animi voluptates perferendis nobis labore modi sapiente.</p>
                    </article>
                </div>
            </div>
        </section>
        <!-- NOS PRESTATIONS FIN -->

        <!-- NOS PARTENAIRES -->
        <section>
            <h2 class="title">Nos partenaires</h2>
            
                <div class="container-effet">
                    <div class="container-partenaires">
                        <figure>
                            <img class="logo_partenaires" src="asset/img/logo_renault.png">
                        </figure>
                        <figure>
                            <img class="logo_partenaires" src="asset/img/logo_bmw.png">
                        </figure>
                        <figure>
                            <img class="logo_partenaires" src="asset/img/logo_citroen.png">
                        </figure>
                        <figure>
                            <img class="logo_partenaires" src="asset/img/logo_peugeot.png">
                        </figure>
                        <figure>
                            <img class="logo_partenaires" src="asset/img/logo_reservoir_auto.png">
                        </figure>                       
                        <figure>
                            <img class="logo_partenaires" src="asset/img/logo_renault.png">
                        </figure>
                        <figure>
                            <img class="logo_partenaires" src="asset/img/logo_bmw.png">
                        </figure>
                        <figure>
                            <img class="logo_partenaires" src="asset/img/logo_citroen.png">
                        </figure>
                        <figure>
                            <img class="logo_partenaires" src="asset/img/logo_peugeot.png">
                        </figure>
                        <figure>
                            <img class="logo_partenaires" src="asset/img/logo_reservoir_auto.png">
                        </figure>                       
                    </div>         
                </div>
        </section>
        <!-- NOS PARTENAIRES FIN -->


        <!-- CONTACT -->
        <?php echo flash_out() ?>
        <section id="contact">
            <div class="container-contact">
                <div class="infos">
                    <svg class="logoContact" id="logoC" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.92 60.02"><defs><style>.cls-1{font-size:54.07px;fill:#ffffff;font-family:BrushScriptStd, Brush Script Std;}</style></defs><text class="cls-1" transform="translate(0 44.88)"><tspan xml:space="preserve">Paul de Kock </tspan></text></svg>
                    <p>2, rue des carrières 93230 Romainville</p>
                    <p>Lundi-Vendredi / 8h-18h</p>
                    <p>pauldekock@free.fr</p>
                </div>
                <div class="formulaire">
                    <form method="POST">
                        <h2 class="title title-contact">Contact</h2>

                        <div class="nomPrenom">
                            <input type="text" class="input-contact" id="nom" name="nom" placeholder="Nom"> 
                            <input type="text" class="input-contact" id="prenom" name="prenom" placeholder="Prénom">
                        </div>

                        <div>
                            <input type="email" class="input-contact" id="email" name="email" placeholder="Adresse email">
                        </div>

                        <div>
                            <label for="message"></label>
                            <textarea name="message" id="message" class="input-contact" placeholder="message"></textarea>
                        </div>

                        <small>(1500 caractères max.)</small>

                        <button type="submit" class="primary">Envoyer</button>
                    </form>
                </div>
        </section>
        <!-- CONTACT FIN -->

        <div id="mapid"></div>
       


    </main>
<!-------------->
<!-- MAIN FIN -->
<!-------------->


<!------------>
<!-- FOOTER -->
<!------------>
    
<footer>
        <svg class="logoFooter" id="logoF" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.92 60.02"><defs><style>.cls-1{font-size:54.07px;fill:#ffffff;font-family:BrushScriptStd, Brush Script Std;}</style></defs><text class="cls-1" transform="translate(0 44.88)"><tspan xml:space="preserve">Paul de Kock </tspan></text></svg>
        <p>&copy; 2021 Copyright - Paul de Kock</p>
        <p><a href="mentions.html" title="Mentions légales" class="text-white">Mentions légales</a></p>
        <!--
        <div class="container-social"> on le met en flex column et  c carré 
            <i class="icone-reseau fab fa-facebook-f"></i>
            <i class="icone-reseau fab fa-linkedin-in"></i>
        </div>
    -->
        
    </footer>
<!---------------->
<!-- FOOTER FIN -->
<!---------------->
 
 <!-- LIGHTBOX SCRIPT -->
<script src="asset/js/script.js"></script>
<script src="asset/js/lightbox-plus-jquery.min.js" charset="utf-8"></script>
</body>
<script type="text/javascript" src="https://cookieconsent.popupsmart.com/src/js/popper.js"></script><script> window.start.init({Palette:"palette6",Mode:"floating right",Theme:"classic",Message:" R Paul de Kock utilise des cookies, en poursuivant votre navigation, vous acceptez leur utilisations.",ButtonText:"Accepter",LinkText:"Voir plus",Time:"10",})</script>

<!-- Hotjar Tracking Code for pauldekock.fr -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2419966,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>


</html>
