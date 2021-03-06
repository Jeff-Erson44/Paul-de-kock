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

        $mail = 'pauldekock@free.fr';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"  content="Paul de Kock, Remorquage automobile. Intervention en urgence ou sur RDV, Paris et Ile-de-France. Remorquage tout type de véhicule. Dépanneur professionnel, services efficace et rapide.">,
    <meta name="robots" content="all"> 
    <!-- BALISE OG PARTAGE -->
    <meta property="og:image" content="https://pauldekock.fr/asset/img/image_share.webp"/>
    <meta property="og:type" content="website" />
    <meta property="og:description" content="R Paul de Kock"/>
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:title" content="Dépannage automobile - R Paul de Kock - Intervention en urgence ou sur RDV"/>
    <meta property="og:url" content="https://www.pauldekock.fr" />
    <title>R Paul de Kock</title>
    <!-- Font Awesome -->
    <!doctype html>
    <link rel="canonical" href="https://pauldekock.fr"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Authenticité de la page -->
    <link rel="canonical" href="https://Paul-de-kock.fr" />
    <!-- RESET CSS -->
    <link rel="stylesheet" href="asset/css/reset.css">
    <!-- FONTAWESOME CSS -->
    <link rel="stylesheet" href="asset/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- LIGHTBOX CDN -->
    <link rel="stylesheet" href="asset/css/lightbox.min.css">
    <!-- FAVICON optimisé pour tout les devices-->
    <link rel="apple-touch-icon" sizes="57x57" href="asset/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="asset/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="asset/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="asset/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="asset/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="asset/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="asset/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="asset/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="asset/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="asset/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="asset/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="asset/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="asset/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="asset/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="asset/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


</head>
<body onload="init()">
<header>
        <nav class="menu_desktop">
            <a href="index.php" class="logo">Paul de Kock</a>
            <input type="checkbox" id="check">
            <label for="check">
                <i class="fas fa-bars" id="btn"></i>
                <i class="fas fa-times" id="cancel"></i>
            </label>
            <ul class="nav-ul" id="nav-ul">
                <li><a  class="a-navigation" id="about-navigation" href="#quisommesnous" class="active">Qui sommes-nous</a></li>
                <li><a  class="a-navigation" id="presta-navigation" href="#prestations">Nos prestations</a></li>
                <li><a  class="a-navigation" href="#contact">Contact</a></li>
            </ul>
        </nav>
        <section class="section"></section>
    </header>

<!---------->
<!-- MAIN -->
<!---------->
    <main>

        <!-- ACCUEIL -->
        <div id="accueil">
            <figure class="diapo">
                <img class="banniere" src="asset/img/IMG_3552.webp" alt="image d'accueil voiture">
                <img class="banniere2" src="asset/img/IMG_35599.webp" alt=" image d'accueil voiture au format mobile">
            </figure>
        </div>


        <div class="containeur-accueil">
            <h2>Interventions sur Paris et en Île-de-France</h2>
            <h1>Atelier de dépannage automobile</h1>
            <p>
                <a class=" primary bouton" href="#prestations">En savoir plus</a>
            </p>
        </div>
        <!-- ACCUEIL FIN -->

        <!-- QUI SOMMES NOUS -->
        <section id="quisommesnous">
            <h2 class="title title-about">Qui sommes-nous</h2>
            <div class="container-about">
                <div class="image-about">
                    <figure>
                        <img class="img-about" src="asset/img/paulfake.webp" alt="image d'illustration pour la présentation de l'entreprise">
                    </figure>
                </div>
                <div class="texte-about">
                    <h3 class="subtitle-about">R Paul de Kock</h3>
                    <p class="texte">R PAUL DE KOCK SARL créée en 2000 .Nous sommes des dépanneurs professionnels expérimentés. Nous opérons
                    de manières rapide et efficace sur Paris et dans le reste de l'Ile de France. Nous remorquons tout type de véhicule, en sous-sol, parking,
                    véhicule brulé, accidenté, épaves.
                    Nous avons pour objectif de répondre à vos besoins de remorquage avec un service de qualité et des experts qui vous garantirons un travail soigné.</p>
                    <p>
                        <button type="button" class="button-about primary">contactez-nous</button>
                    </p>
                </div>
            </div>
        </section>

        <section id="quisommesnous_mobile">
            <h2 class="title title-about">Qui sommes-nous</h2>
            <figure>
                <img class="img-about" src="asset/img/paulfake.webp" alt="image d'illustration pour la présentation de l'entreprise">
            </figure>
            
            <p class="texte">R PAUL DE KOCK SARL créée en 2000 .Nous sommes des dépanneurs professionnels expérimentés. Nous opérons
            de manières rapide et efficace sur Paris et dans le reste de l'Ile de France. Nous remorquons tout type de véhicule, en sous-sol, parking,
            véhicule brulé, accidenté, épaves.
            Nous avons pour objectif de répondre à vos besoins de remorquage avec un service de qualité et des experts qui vous garantirons un travail soigné.</p>

            <p>
                <a class="button-about primary">contactez-nous</a>
            </p>
        </section>
        <!-- QUI SOMMES NOUS FIN -->


        <!-- BANDEAU COMPTEURS -->
        <div class="bandeau">
            <ul class="ul-bandeau">
                <li class="li-bandeau">
                    <i class="fas fa-building"></i>
                    <div class="text-counter">Nous existons depuis </div>
                    <div class="counter number-counter"data-target="21"></div>
                    <div class="text-counter year-counter"> Ans </div>
                </li>
                <li class="li-bandeau">
                    <i class="fas fa-hands-helping"></i>
                    <div class="text-counter">Nous sommes partenaires avec plus de </div>
                    <div class="counter"data-target="8"></div>
                    <div class="text-counter"> entreprises </div>
                </li>
            </ul>
        </div>

       <!--BANDEAU COMPTEURS FIN  -->

        <!-- NOS PRESTATIONS -->
        <section id="prestations">
            <div class="image-presta">
                <figure>
                    <img class="img-presta" src="asset/img/presta-bg.webp" alt="Titre de la section nos prestations">
                </figure>
                <h2 class="title title-presta">Nos prestations</h2>
            </div>
            <div class="container-presta">
                <!--.box-presta*3>img+article-->
                <div class="box-presta">
                    <img src="asset/img/IMG_3554.webp" data-lightbox="mygallery" alt="Illustration dépannage sur place">
                    <article class="article-presta">
                        <h4>Dépannage sur place</h4>
                        <p>Nos dépanneurs-remorqueurs sont aptes à intervenir en sous-sol, en étage, en pleine rue et en fourrière.
                        dans des actions types: coup de batterie et roue crevée.</p>
                    </article>
                </div>
                <div class="box-presta">
                    <article class="article-presta">
                        <h4>Remorquage auto</h4>
                        <p> Nous remorquons tout type de voitures, des véhicules léger, des utilitaires avec ou sans clés.
                        pour tout type de vehicules (20m3, petit engins de chantier, carvanes ...)</p>
                    </article>
                    <img class="image-presta" src="asset/img/IMG_3568.webp" data-lightbox="mygallery" alt="Illustration remorquage auto">
                </div>
                <div class="box-presta">
                    <img class="image-presta" src="asset/img/IMG_3552.webp" data-lightbox="mygallery" alt="Illustration remorquage moto">
                    <article class="article-presta trois">
                        <h4>Remorquage moto</h4>
                        <p>Nous dépanneurs-remorqueurs sont aptes à intervenir sur tout type de moto, scooter cyclomoteurs.
                        Transporter sur un plateau adapté au deux roues vers un garagiste choisi par me client.</p>
                    </article>
                </div>
            </div>
        </section>
        <!-- NOS PRESTATIONS FIN -->

        

        <section id="prestations_mobile">
            
        <h2 class="title title-presta">Nos prestations</h2>
        
        <div class="container_prestations">
                <figure>
                    <img class="img_presta_mob" src="asset/img/IMG_3554.webp" data-lightbox="mygallery" alt="Illustration dépannage sur place">
                </figure>
                <article class="article-presta presta1">
                    <h4>Dépannage sur place</h4>
                    <p>Nos dépanneurs-remorqueurs sont aptes à intervenir en sous-sol, en étage, en pleine rue et en fourrière.
                    dans des actions types: coup de batterie et roue crevée.</p>
                </article>
            </div>
            <div class="container_prestations">
                <figure>
                    <img class="img_presta_mob" src="asset/img/IMG_3568.webp" data-lightbox="mygallery" alt="Illustration remorquage auto">
                </figure>
                <article class="article-presta presta2">
                    <h4>Remorquage auto</h4>
                    <p>Nous remorquons tout type de voiture, des véhicules léger, des utilitaires avec ou sans clés, pour tout type de vehicule (20m3, petit engins de chantier, caravanes ...).</p>
                </article>
            </div>
            <div class="container_prestations">
                <figure>
                    <img class="img_presta_mob" src="asset/img/IMG_3552.webp" data-lightbox="mygallery" alt="Illustration remorquage moto">
                </figure>
                <article class="article-presta presta3">
                    <h4>Remorquage moto</h4>
                    <p>Nous dépanneurs-remorqueurs sont aptes à intervenir sur tout type de moto, scooter cyclomoteurs.
                    Transporter sur un plateau adapté au deux roues vers un garagiste choisi par le client.</p>
                </article>
            </div>

        </section>

        <!-- NOS PARTENAIRES -->
        <section>
            <h2 class="title title-partenaires">Nos partenaires</h2>
            
                <div class="container-effet">
                    <div class="container-partenaires">
                        <figure>
                            <img alt="logo carrousel des partenaires de l'entrprise" class="logo_partenaires" src="asset/img/logo_renault.webp" >
                        </figure>
                        <figure>
                            <img alt="logo carrousel des partenaires de l'entrprise" class="logo_partenaires" src="asset/img/logo_bmw.webp">
                        </figure>
                        <figure>
                            <img alt="logo carrousel des partenaires de l'entrprise" class="logo_partenaires" src="asset/img/logo_citroen.webp">
                        </figure>
                        <figure>
                            <img alt="logo carrousel des partenaires de l'entrprise" class="logo_partenaires" src="asset/img/logo_peugeot.webp">
                        </figure>
                        <figure>
                            <img alt="logo carrousel des partenaires de l'entrprise" class="logo_partenaires" src="asset/img/logo_reservoir_auto.webp">
                        </figure>                       
                        <figure>
                            <img alt="logo carrousel des partenaires de l'entrprise" class="logo_partenaires" src="asset/img/logo_renault.webp">
                        </figure>
                        <figure>
                            <img alt="logo carrousel des partenaires de l'entrprise" class="logo_partenaires" src="asset/img/logo_bmw.webp">
                        </figure>
                        <figure>
                            <img alt="logo carrousel des partenaires de l'entrprise" class="logo_partenaires" src="asset/img/logo_citroen.webp">
                        </figure>
                        <figure>
                            <img alt="logo carrousel des partenaires de l'entrprise" class="logo_partenaires" src="asset/img/logo_peugeot.webp">
                        </figure>
                        <figure>
                            <img alt="logo carrousel des partenaires de l'entrprise" class="logo_partenaires" src="asset/img/logo_reservoir_auto.webp">
                        </figure>                       
                    </div>         
                </div>
        </section>
        <!-- NOS PARTENAIRES FIN -->


        <!-- CONTACT -->
        <section id="contact">
            <div class="container-contact">
                <div class="infos">
                    <svg class="logoContact" id="logoC" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.92 60.02"><defs><style>.cls-1{font-size:54.07px;fill:#ffffff;font-family:BrushScriptStd, Brush Script Std;}</style></defs><text class="cls-1" transform="translate(0 44.88)"><tspan xml:space="preserve">Paul de Kock </tspan></text></svg>
                    <p>2, rue des Carrières 93230 Romainville</p>
                    <p>Lundi-Vendredi / 8h-18h</p>
                    <p>pauldekock@free.fr</p>
                </div>
                <div class="formulaire">
                    <form method="POST">
                        <h2 class="title title-contact">Contact</h2>
                        <div class="nomPrenom">
                            <div class="user-box user-nom">
                                <input type="text" class="input-contact" id="nom" name="nom"> 
                                <label>Nom</label>
                            </div>
                            <div class="user-box user-prenom">
                                <input type="text" class="input-contact" id="prenom" name="prenom">
                                <label>Prénom</label>
                            </div>
                        </div>

                        <div class="user-box user-email">
                            <input type="email" class="input-contact" id="email" name="email">
                            <label>Email</label>
                        </div>

                        <div class="user-box user-message">
                            <textarea name="message" id="message" class="input-contact" maxlength = "1500"></textarea>
                            <label for="message">Message</label>
                        </div>

                        <small>(1500 caractères max.)</small>
                        <button type="submit" class="primary">Envoyer</button>
                        <?php echo flash_out() ?>
                    </form>
                </div>
        </section>
        <!-- CONTACT FIN -->


        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.2659528147583!2d2.4356062156306906!3d48.89126847929076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66d21d979b269%3A0xb9938b72c7e9dcb4!2s2%20Rue%20des%20Carri%C3%A8res%2C%2093230%20Romainville!5e0!3m2!1sfr!2sfr!4v1622582194451!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

    </main>
<!-------------->
<!-- MAIN FIN -->
<!-------------->


<!------------>
<!-- FOOTER -->
<!------------>
    
    <footer>
        <p>R Paul de Kock</p>
        <p>&copy; 2021 Copyright - Paul de Kock</p>
        <p><a href="mentions.html" title="Mentions légales" class="text-white">Mentions légales</a></p>
    </footer>
<!---------------->
<!-- FOOTER FIN -->
<!---------------->
 
 <!-- LIGHTBOX SCRIPT -->
<script src="asset/js/script.js"></script>
<script src="asset/js/lightbox-plus-jquery.min.js"></script>
</body>

<!-- cookies popup -->
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

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-EN56CX7TVL"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-EN56CX7TVL');
</script>


</html>
