<?php
ob_start(); 
session_start();
include './classes/dbConnect.php';

$db = new dbConnect;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Playfair+Display&display=swap" rel="stylesheet">
    

    <title>Document</title>
    
</head>
<body>

    <header class="panneauAdmin">
        <div class="H1Logo">
            <img  class="logo" id="animated-gif" src="img/logojessica.gif" alt="Animation GIF">       
            <h1 class="titre">Panneau Admin</h1>   
        </div>
        
<?php
            if (empty($_SESSION)) {
                echo'
                    <a href="https://www.google.fr/"><img class="SignOut" src="img/SignOut.png" alt=""></a>
                    ';
            }
            else { 
                echo'
                    <div class="bouton">
                        <li class="liHref"><a id="gestion1" class="allHref" href="index.php?page=gestionSite&gestion_site=695151535682000">Gestion du site</a></li>
                        <li class="liHref"><a id="gestion" class="allHref" href="index.php?page=gestionCompte&gestion_compte=912374562872000">Gestion du compte</a></li>
                        <li class="liHref"><a id="modal_pos1" class="allHref" href="#" data-bs-toggle="modal" data-bs-target="#modal1">Se deconnecter</a></li>
                        <a href="https://www.google.fr/"><img class="SignOut" src="img/SignOut.png" alt=""></a>

                        

                        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modalContainer modal-content text-center text-dark p-3 rounded-4">

                                    <button type="button" class="btn-close btn-close-dark ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>

                                    <section>
                                        <h2 class="modalDecoText">voulez vous vraiment vous deconnecter ?</h2>

                                        <form method="POST" class="">
                                            <input class="modalDecoSubmit" name="submit_deconnexion" type="submit" value="Se deconnecter">
                                        </form>
                                    </section> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="menu">
            
                        <div class="toggle_btn">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                    </div>

                    <div class="dropdown_menu">
                        <li class="burger"><a class="textBurger" href="index.php?page=gestionSite&gestion_site=695151535682000">Gestion du site</a></li>
                        
                        <li class="burger"><a id="textBurger2" class="textBurger" href="index.php?page=gestionCompte&gestion_compte=912374562872000">Gestion du compte</a></li>
                    
                        <li class="burger"><a  data-bs-toggle="modal" data-bs-target="#modal2" class="textBurger" href="index.php?page=gestionCompte&gestion_compte=912374562872000">Se deconnecter</a></li>


                    </div>

                    <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modalContainer modal-content text-center text-dark p-3 rounded-4">

                                <button type="button" class="btn-close btn-close-dark ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>

                                <section>
                                    <h2 class="modalDecoText">voulez vous vraiment vous deconnecter ?</h2>
                                    
                                    <form method="POST" class="">
                                        <input class="modalDecoSubmitBurger" name="submit_deconnexion" type="submit" value="Se deconnecter">
                                    </form>
                                    
                                </section> 
                            </div>
                        </div>
                    </div>
                    ';
            }
             
?>   
    </header>
<?php
            if (empty($_SESSION)) {
                echo'
                    <form method="POST" class="connexionAdmin">

                        <div class="titreConnexion">Connexion à votre site</div>
                    
                        <label class="connexionLabel">Adresse mail</label>
                        <input class="allInput" name="emailAdmin" type="mail" placeholder="votre adresse mail">
                
                        <label class="connexionLabel">Mot de passe</label>
                        <input class="allInput" name="mdp_admin" type="password" placeholder="votre mot de passe">
                
                        <div>
                            <input class="connexionSubmit" name="submitConnexion" type="submit" value="Se connecter">
                        </div>
                
                        <div>
                            <input class="connexionPassoublier" type="submit" value="Mot de passe oublié ?">
                        </div>
                    </form>
                    ';
                    
            }
            else {
                if (isset($_GET['page']) == "") {
                    echo '
                            <div class="connecter">
                                <p class="connecterP"> Bienvenue sur votre panneau d\'administration.</p>   
                                <p class="connecterP">ICI VOUS POUVEZ GERER VOTRE SITE ET VOS COMPTES</p>
                            </div>
                            ';
                }
            }
            if (isset($_POST['submitConnexion'])) {
                $emailAdmin = $_POST['emailAdmin'];
                $mdp_admin = $_POST['mdp_admin'];
                $user = $db->Connexion($emailAdmin, $mdp_admin);
        
                if ($user && password_verify($mdp_admin, $user['mdp_admin'])) {
                    header("location:index.php");
        
                    $db->setAdmin($user);
                } else {
                    echo 'Identifiants invalides';
                }
            } 



            if (!empty($_SESSION)) {
                if (isset($_GET['page']) && $_GET['page'] == "gestionCompte" && $_GET['gestion_compte'] == "912374562872000") {
?>

                    <script>
                        document.querySelector('#gestion').style.backgroundColor = ("white")
                        document.querySelector('#gestion').style.color = ("black")
                        document.querySelector('#gestion').style.borderRadius = ("10px")
                        document.querySelector('#gestion').style.padding = ("0px 3px 3px 3px")
                    </script>
                    
<?php
                    echo'
                        <div class="creationCompte">
                            <a href="index.php?page=creationCompte&creation=906207086952000"><img src="img/iconAjouterCompte.png" alt=""></a>        
                            <p>Création d\'un nouveau compte</p>                
                        </div>

                        <form method="POST" class="sectionContainerGestionCompte">
                            <div class="containerGestionCompte">
                                
                                <div class="titreGestionCompte">Modifier mon compte</div>
                        
                                <label class="LabelGestionCompte" for="">Adresse email</label>
                                <input class="allInput" name="email_admin" type="email">
                                
                                <label class="LabelGestionCompte" >Mot de passe</label>
                                <input class="allInput" name="new_password" type="password" required>
                                
                                <label  class="LabelGestionCompte" >Confirmer votre mot de passe</label>
                                <input class="allInput" name="confirmationMotDePasse" type="password" required>
                                
                                <input class="connexionSubmit2" name="modifCompte" type="submit" value="ENVOYER">
                                    
                             </div>
                            
                        </form>                    
                        ';

                        if (isset($_POST['modifCompte'])) {
                            $idAdmin = $_SESSION['id_admin'];
                            $email = $_POST['email_admin'];
                            $motDePasse = $_POST['new_password'];
                            $confirmationMotDePasse = $_POST['confirmationMotDePasse'];
            
                            if ($motDePasse === $confirmationMotDePasse) {
                                $db->modifCompte($idAdmin, $email, $motDePasse);
                                $_SESSION['id_admin'] = $idAdmin;
                                $_SESSION['email_admin'] = $email;
                                header('Location: ./index.php');
                            } else {
                                echo 'mot de passe et confirmation mot de passe différent ! Veuillez re-saisir les mots de passe';
                            }
                        }
                    }


                
                if (isset($_GET['page']) &&  $_GET['page'] == "creationCompte" && $_GET['creation'] == "906207086952000"){
?>
                    
                    <script>
                        document.querySelector('#gestion').style.backgroundColor = ("white")
                        document.querySelector('#gestion').style.color = ("black")
                        document.querySelector('#gestion').style.borderRadius = ("10px")
                        document.querySelector('#gestion').style.padding = ("0px 3px 3px 3px")
                    </script>
<?php
                        if (isset($_POST['submitCreation'])) {
                        $emailAdmin = $_POST['mail_creation'];
                        $mdp_admin = $_POST['mdp_creation'];
                        $db->creationCompte($emailAdmin, $mdp_admin);
                    }
                    
                    
                    
                    echo'
                        <form method="POST" class="sectionContainerCreationCompte">
                            
                            <div class="containerCreationCompte">
                                
                                <div class="titreGestionCompte">Création d\'un nouvelle utilisateur</div>
                        
                                <label class="LabelGestionCompte" for="">Adresse email</label>
                                <input class="allInput" name="mail_creation" type="email" required>
                                
                                <label class="LabelGestionCompte" >Mot de passe</label>
                                <input class="allInput" name="mdp_creation" type="password" required>
                                
                                <input class="connexionSubmit2" name="submitCreation" type="submit" value="ENVOYER">
                                
                            </div>
                            
                        </form>                    
                        ';
                }
                if (isset($_GET['page']) && $_GET['page'] == "gestionSite" && $_GET['gestion_site'] == "695151535682000" ){
?>   
            
                    <script>
                        document.querySelector('#gestion1').style.backgroundColor = ("white")
                        document.querySelector('#gestion1').style.color = ("black")
                        document.querySelector('#gestion1').style.borderRadius = ("10px")
                        document.querySelector('#gestion1').style.padding = ("0px 3px 3px 3px")
                    </script>
            
<?php



                    echo'
                        <section class="containerGestionSite">

                            <div class="elementGestionSite">
                                <p class="elementGestionSiteText">Gestion réalisations</p>
                                <a href="index.php?page=gestionRealisation&gestion_Realisation=5754165648612000"><img src="img/logoGestionRealisation.png" alt=""></a>
                            </div>    
                            <div class="elementGestionSite">   
                                <p class="elementGestionSiteText">Gestion partenaires</p>
                                <a href="index.php?page=gestionPartenaire"><img src="img/logoGestionPartenaire.png" alt=""></a>
                            </div>     
                            <div class="elementGestionSite">
                                <p class="elementGestionSiteText">Gestion entreprises</p>
                                <a href="index.php?page=gestionEntreprise"><img src="img/logoGestionEntreprise.png" alt=""></a>
                            </div>

                        </section>               
                        ';
                }
                if (isset($_GET['page']) && $_GET['page'] == "gestionRealisation" && $_GET['gestion_Realisation'] == "5754165648612000"){
                    echo'
                        <section class="containerGestionRealisation">

                            <div class="elementGestionRealisation">
                                <a href="index.php?page=affichage&modifieraffichage=54123687569842000&categorie=RenovMur"><img src="img/iconAjouterCompte.png" alt=""></a>        
                                <p class="textGestionRealisation">Modifier l\'affichage  </p>                
                            </div>
                            <div class="elementGestionRealisation">
                                <a href=""><img src="img/iconAjouterCompte.png" alt=""></a>        
                                <p class="textGestionRealisation">Ajouter un chantier</p>                
                            </div>
                            <div class="elementGestionRealisation2">
                                <a href="index.php?page=affichage&modifieraffichage=54123687569842000&categorie=All"><img src="img/iconAjouterCompte.png" alt=""></a>        
                                <p class="textGestionRealisation">Voir tous les chantiers</p>                
                            </div>

                        </section>               
                        ';
                }
                if (isset($_GET['page']) && $_GET['page'] == "affichage" && $_GET['modifieraffichage'] == "54123687569842000"){?>



<nav class='navUpdate'>
            <ul class='ulUpdate'>
                <a href="index.php?page=affichage&modifieraffichage=54123687569842000&categorie=RenovMur"><li id="liUpdate1">Rénovation des murs</li></a>
                <a href="index.php?page=affichage&modifieraffichage=54123687569842000&categorie=PeintureInt"><li id="liUpdate2">Peinture Intérieur</li></a>
                <a href="index.php?page=affichage&modifieraffichage=54123687569842000&categorie=RevetMur"><li id="liUpdate3">Revêtement des Murs</li></a>
                <a href="index.php?page=affichage&modifieraffichage=54123687569842000&categorie=RevetSol"><li id="liUpdate4">Revêtement des Sols</li></a>
            </ul>
        </nav>
        <a class="afficheAllLink" href="index.php?page=affichage&modifieraffichage=54123687569842000&categorie=All"><p class='afficher'>Afficher tout</p></a>
    <section class='mainUpdateAdmin'>
    <?php 


                                                    //RENOVATION DES MURS//

                                                    
    if (isset($_GET['page'], $_GET['modifieraffichage'], $_GET['categorie']) && $_GET['page']='affichage' && $_GET['modifieraffichage']='54123687569842000' && $_GET['categorie']=='RenovMur'){
        
        ?><script>
        document.querySelector('#liUpdate1').style.backgroundColor = ("#346077")
        document.querySelector('#liUpdate1').style.color = ("#ffffff")
        </script>
        <section class='chantierAfficheUpdate'>
            <p class='titleAffiche'>Chantier(s) Affiché(s):</p>
        <div class="slideChantierUpdate"><?php
        $all=$db->readAllSlideWhere(1);
        $resultAllChantier=$db->readAllSlideWhereAnd(1);
        $position1=$db->readAllSlideWherePosition(1,1);
        $position2=$db->readAllSlideWherePosition(1,2);
        $position3=$db->readAllSlideWherePosition(1,3);
        $position4=$db->readAllSlideWherePosition(1,4);
        $position5=$db->readAllSlideWherePosition(1,5);
        $position6=$db->readAllSlideWherePosition(1,6);
            if (empty($position1)){
                $db->insertUpdateParDefaut(1,1);
                header("Refresh:0");
            }
            if (empty($position2)){
                $db->insertUpdateParDefaut(2,1);
                header("Refresh:0");
            }
            if (empty($position3)){
                $db->insertUpdateParDefaut(3,1);
                header("Refresh:0");
            }
            if (empty($position4)){
                $db->insertUpdateParDefaut(4,1);
                header("Refresh:0");
            }
            if (empty($position5)){
                $db->insertUpdateParDefaut(5,1);
                header("Refresh:0");
            }
            if (empty($position6)){
                $db->insertUpdateParDefaut(6,1);
                header("Refresh:0");
            }
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select class="selectChantier" name="selectChantierUpdate' .htmlspecialchars($resultAllChantierKey['id_chantier']). '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.htmlspecialchars($allKey['id_chantier']).'">'.htmlspecialchars($allKey['nom_chantier']).'</option>';
                }
            
            echo '<input type="submit" name="submitPosition' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Valider">
                </div>
                <p>' .htmlspecialchars($resultAllChantierKey['nom_chantier']) .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '" alt="">
                        </div>
                    </div>
                </div>
                <p>' .htmlspecialchars($resultAllChantierKey['description_chantier']). '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Modifier">
                    <input type="submit" name="Supprimer' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Supprimer">
                    <input type="hidden" class="inputHidden" name="postSupprimer' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="' .$resultAllChantierKey['id_chantier']. '">
                    <input type="hidden" name="oldImageAv" value="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '">
                    <input type="hidden" name="oldImageAp" value="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '">';
                    if (isset($_POST['Supprimer' .$resultAllChantierKey['id_chantier']. ''])) {
                        $oldImageAvDelete=$_POST['oldImageAv'];
                        $oldImageApDelete=$_POST['oldImageAp'];
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition' .$resultAllChantierKey['id_chantier']. ''])){
                        
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultAllChantierKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        var_dump($idChantierToReplace2);
                        var_dump($idChantierToReplace1);
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1);
                            if ($db) {
                                $countParDefaut=$db->countParDefaut(1);
                                if ($countParDefaut!=0) {
                                    $db->deleteParDefaut(1);
                                }
                            }  
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }
        echo '</div></section>';
        ?>
        <section class='chantierAfficheUpdate2'>
            <p class='titleAffiche'>Chantier(s) disponible(s)</p>
        <div class="slideChantierUpdate"><?php
        $resultChantierDispo=$db->readAllSlideWhereAnd2(1);
        foreach ($resultChantierDispo as $resultChantierDispoKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select class="selectChantier" name="selectChantierUpdate' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.htmlspecialchars($allKey['id_chantier']).'">'.htmlspecialchars($allKey['nom_chantier']).'</option>';
                }
            
            echo '<input type="submit" name="submitPosition2' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Valider">
                </div>
                <p>' .htmlspecialchars($resultChantierDispoKey['nom_chantier']) .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '" alt="">
                        </div>
                    </div>
                </div>
                <p>' .htmlspecialchars($resultChantierDispoKey['description_chantier']). '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Modifier">
                    <input type="submit" name="Supprimer' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Supprimer">
                    <input type="hidden" class="inputHidden" name="postSupprimer' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="' .$resultChantierDispoKey['id_chantier']. '">
                    <input type="hidden" name="oldImageAv" value="' .htmlspecialchars($resultChantierDispoKey['photo_av_chantier']). '">
                    <input type="hidden" name="oldImageAp" value="' .htmlspecialchars($resultChantierDispoKey['photo_ap_chantier']). '">';
                    if (isset($_POST['Supprimer' .$resultChantierDispoKey['id_chantier']. ''])) {
                        $oldImageAvDelete=$_POST['oldImageAv'];
                        $oldImageApDelete=$_POST['oldImageAp'];
                        $idCardSelect=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition2' .$resultChantierDispoKey['id_chantier']. ''])){
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultChantierDispoKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1);
                            if ($db) {
                                $countParDefaut=$db->countParDefaut(1);
                                if ($countParDefaut!=0) {
                                    $db->deleteParDefaut(1);
                                }
                            } 
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultChantierDispoKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }

        echo '</div></section>';

        
    }


                                                    //RENOVATION DES MURS//


                                                    //PEINTURE INTERIEUR//


    if (isset($_GET['page'], $_GET['modifieraffichage'], $_GET['categorie']) && $_GET['page']='affichage' && $_GET['modifieraffichage']='54123687569842000' && $_GET['categorie']=='PeintureInt'){
        ?>
        <script>
            document.querySelector('#liUpdate2').style.backgroundColor = ("#346077")
            document.querySelector('#liUpdate2').style.color = ("#ffffff")
        </script><section class='chantierAfficheUpdate'>
            <p class='titleAffiche'>Chantier(s) Affiché(s):</p>
        <div class="slideChantierUpdate"><?php
        $all=$db->readAllSlideWhere(2);
        $resultAllChantier=$db->readAllSlideWhereAnd(2);
        $position1=$db->readAllSlideWherePosition(2,1);
        $position2=$db->readAllSlideWherePosition(2,2);
        $position3=$db->readAllSlideWherePosition(2,3);
        $position4=$db->readAllSlideWherePosition(2,4);
        $position5=$db->readAllSlideWherePosition(2,5);
        $position6=$db->readAllSlideWherePosition(2,6);
            if (empty($position1)){
                $db->insertUpdateParDefaut(1,2);
                header("Refresh:0");
            }
            if (empty($position2)){
                $db->insertUpdateParDefaut(2,2);
                header("Refresh:0");
            }
            if (empty($position3)){
                $db->insertUpdateParDefaut(3,2);
                header("Refresh:0");
            }
            if (empty($position4)){
                $db->insertUpdateParDefaut(4,2);
                header("Refresh:0");
            }
            if (empty($position5)){
                $db->insertUpdateParDefaut(5,2);
                header("Refresh:0");
            }
            if (empty($position6)){
                $db->insertUpdateParDefaut(6,2);
                header("Refresh:0");
            }
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select class="selectChantier" name="selectChantierUpdate' .htmlspecialchars($resultAllChantierKey['id_chantier']). '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.htmlspecialchars($allKey['id_chantier']).'">'.htmlspecialchars($allKey['nom_chantier']).'</option>';
                }
            
            echo '<input type="submit" name="submitPosition' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Valider">
                </div>
                <p>' .htmlspecialchars($resultAllChantierKey['nom_chantier']) .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '" alt="">
                        </div>
                    </div>
                </div>
                <p>' .htmlspecialchars($resultAllChantierKey['description_chantier']). '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Modifier">
                    <input type="submit" name="Supprimer' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Supprimer">
                    <input type="hidden" class="inputHidden" name="postSupprimer' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="' .$resultAllChantierKey['id_chantier']. '">
                    <input type="hidden" name="oldImageAv" value="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '">
                    <input type="hidden" name="oldImageAp" value="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '">';
                    if (isset($_POST['Supprimer' .$resultAllChantierKey['id_chantier']. ''])) {
                        $oldImageAvDelete=$_POST['oldImageAv'];
                        $oldImageApDelete=$_POST['oldImageAp'];
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition' .$resultAllChantierKey['id_chantier']. ''])){
                        
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultAllChantierKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        var_dump($idChantierToReplace2);
                        var_dump($idChantierToReplace1);
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1);
                            if ($db) {
                                $countParDefaut=$db->countParDefaut(2);
                                if ($countParDefaut!=0) {
                                    $db->deleteParDefaut(2);
                                }
                            }  
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }
        echo '</div></section>';
        ?><section class='chantierAfficheUpdate2'>
            <p class='titleAffiche'>Chantiers disponibles:</p>
        <div class="slideChantierUpdate"><?php
        $resultChantierDispo=$db->readAllSlideWhereAnd2(2);
        foreach ($resultChantierDispo as $resultChantierDispoKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select class="selectChantier" name="selectChantierUpdate' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.htmlspecialchars($allKey['id_chantier']).'">'.htmlspecialchars($allKey['nom_chantier']).'</option>';
                }
            
            echo '<input type="submit" name="submitPosition2' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Valider">
                </div>
                <p>' .htmlspecialchars($resultChantierDispoKey['nom_chantier']) .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '" alt="">
                        </div>
                    </div>
                </div>
                <p>' .htmlspecialchars($resultChantierDispoKey['description_chantier']). '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Modifier">
                    <input type="submit" name="Supprimer' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Supprimer">
                    <input type="hidden" class="inputHidden" name="postSupprimer' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="' .$resultChantierDispoKey['id_chantier']. '">
                    <input type="hidden" name="oldImageAv" value="' .htmlspecialchars($resultChantierDispoKey['photo_av_chantier']). '">
                    <input type="hidden" name="oldImageAp" value="' .htmlspecialchars($resultChantierDispoKey['photo_ap_chantier']). '">';
                    if (isset($_POST['Supprimer' .$resultChantierDispoKey['id_chantier']. ''])) {
                        $oldImageAvDelete=$_POST['oldImageAv'];
                        $oldImageApDelete=$_POST['oldImageAp'];
                        $idCardSelect=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition2' .$resultChantierDispoKey['id_chantier']. ''])){
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultChantierDispoKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1);
                            if ($db) {
                                $countParDefaut=$db->countParDefaut(2);
                                if ($countParDefaut!=0) {
                                    $db->deleteParDefaut(2);
                                }
                            } 
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultChantierDispoKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }

        echo '</div></section>';

        
    }

                                                //PEINTURE INTERIEUR//

                                                //RENOVATION DES MURS//


    if (isset($_GET['page'], $_GET['modifieraffichage'], $_GET['categorie']) && $_GET['page']='affichage' && $_GET['modifieraffichage']='54123687569842000' && $_GET['categorie']=='RevetMur'){
        ?>
        <script>
            document.querySelector('#liUpdate3').style.backgroundColor = ("#346077")
            document.querySelector('#liUpdate3').style.color = ("#ffffff")
        </script>
        <section class='chantierAfficheUpdate'>
            <p class='titleAffiche'>Chantier(s) Affiché(s):</p>
        <div class="slideChantierUpdate"><?php
        $all=$db->readAllSlideWhere(3);
        $resultAllChantier=$db->readAllSlideWhereAnd(3);
        $position1=$db->readAllSlideWherePosition(3,1);
        $position2=$db->readAllSlideWherePosition(3,2);
        $position3=$db->readAllSlideWherePosition(3,3);
        $position4=$db->readAllSlideWherePosition(3,4);
        $position5=$db->readAllSlideWherePosition(3,5);
        $position6=$db->readAllSlideWherePosition(3,6);
            if (empty($position1)){
                $db->insertUpdateParDefaut(1,3);
                header("Refresh:0");
            }
            if (empty($position2)){
                $db->insertUpdateParDefaut(2,3);
                header("Refresh:0");
            }
            if (empty($position3)){
                $db->insertUpdateParDefaut(3,3);
                header("Refresh:0");
            }
            if (empty($position4)){
                $db->insertUpdateParDefaut(4,3);
                header("Refresh:0");
            }
            if (empty($position5)){
                $db->insertUpdateParDefaut(5,3);
                header("Refresh:0");
            }
            if (empty($position6)){
                $db->insertUpdateParDefaut(6,3);
                header("Refresh:0");
            }
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select class="selectChantier" name="selectChantierUpdate' .htmlspecialchars($resultAllChantierKey['id_chantier']). '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.htmlspecialchars($allKey['id_chantier']).'">'.htmlspecialchars($allKey['nom_chantier']).'</option>';
                }
            
            echo '<input type="submit" name="submitPosition' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Valider">
                </div>
                <p>' .htmlspecialchars($resultAllChantierKey['nom_chantier']) .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '" alt="">
                        </div>
                    </div>
                </div>
                <p>' .htmlspecialchars($resultAllChantierKey['description_chantier']). '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Modifier">
                    <input type="submit" name="Supprimer' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Supprimer">
                    <input type="hidden" class="inputHidden" name="postSupprimer' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="' .$resultAllChantierKey['id_chantier']. '">
                    <input type="hidden" name="oldImageAv" value="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '">
                    <input type="hidden" name="oldImageAp" value="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '">';
                    if (isset($_POST['Supprimer' .$resultAllChantierKey['id_chantier']. ''])) {
                        $oldImageAvDelete=$_POST['oldImageAv'];
                        $oldImageApDelete=$_POST['oldImageAp'];
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition' .$resultAllChantierKey['id_chantier']. ''])){
                        
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultAllChantierKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        var_dump($idChantierToReplace2);
                        var_dump($idChantierToReplace1);
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1);
                            if ($db) {
                                $countParDefaut=$db->countParDefaut(3);
                                if ($countParDefaut!=0) {
                                    $db->deleteParDefaut(3);
                                }
                            }  
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }
        echo '</div></section>';
        ?><section class='chantierAfficheUpdate2'>
            <p class='titleAffiche'>Chantiers disponibles:</p>
        <div class="slideChantierUpdate"><?php
        $resultChantierDispo=$db->readAllSlideWhereAnd2(3);
        foreach ($resultChantierDispo as $resultChantierDispoKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select class="selectChantier" name="selectChantierUpdate' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.htmlspecialchars($allKey['id_chantier']).'">'.htmlspecialchars($allKey['nom_chantier']).'</option>';
                }
            
            echo '<input type="submit" name="submitPosition2' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Valider">
                </div>
                <p>' .htmlspecialchars($resultChantierDispoKey['nom_chantier']) .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '" alt="">
                        </div>
                    </div>
                </div>
                <p>' .htmlspecialchars($resultChantierDispoKey['description_chantier']). '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Modifier">
                    <input type="submit" name="Supprimer' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Supprimer">
                    <input type="hidden" class="inputHidden" name="postSupprimer' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="' .$resultChantierDispoKey['id_chantier']. '">
                    <input type="hidden" name="oldImageAv" value="' .htmlspecialchars($resultChantierDispoKey['photo_av_chantier']). '">
                    <input type="hidden" name="oldImageAp" value="' .htmlspecialchars($resultChantierDispoKey['photo_ap_chantier']). '">';
                    if (isset($_POST['Supprimer' .$resultChantierDispoKey['id_chantier']. ''])) {
                        $oldImageAvDelete=$_POST['oldImageAv'];
                        $oldImageApDelete=$_POST['oldImageAp'];
                        $idCardSelect=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition2' .$resultChantierDispoKey['id_chantier']. ''])){
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultChantierDispoKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1);
                            if ($db) {
                                $countParDefaut=$db->countParDefaut(3);
                                if ($countParDefaut!=0) {
                                    $db->deleteParDefaut(3);
                                }
                            } 
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultChantierDispoKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }

        echo '</div></section>';

        
    }

                                        //REVETEMENT DES MURS//


                                        //REVETEMENT DES SOLS//


    if (isset($_GET['page'], $_GET['modifieraffichage'], $_GET['categorie']) && $_GET['page']='affichage' && $_GET['modifieraffichage']='54123687569842000' && $_GET['categorie']=='RevetSol'){
        ?>
        <script>
            document.querySelector('#liUpdate4').style.backgroundColor = ("#346077")
            document.querySelector('#liUpdate4').style.color = ("#ffffff")
        </script>
        <section class='chantierAfficheUpdate'>
            <p class='titleAffiche'>Chantier(s) Affiché(s):</p>
        <div class="slideChantierUpdate"><?php
        $all=$db->readAllSlideWhere(4);
        $resultAllChantier=$db->readAllSlideWhereAnd(4);
        $position1=$db->readAllSlideWherePosition(4,1);
        $position2=$db->readAllSlideWherePosition(4,2);
        $position3=$db->readAllSlideWherePosition(4,3);
        $position4=$db->readAllSlideWherePosition(4,4);
        $position5=$db->readAllSlideWherePosition(4,5);
        $position6=$db->readAllSlideWherePosition(4,6);
            if (empty($position1)){
                $db->insertUpdateParDefaut(1,4);
                header("Refresh:0");
            }
            if (empty($position2)){
                $db->insertUpdateParDefaut(2,4);
                header("Refresh:0");
            }
            if (empty($position3)){
                $db->insertUpdateParDefaut(3,4);
                header("Refresh:0");
            }
            if (empty($position4)){
                $db->insertUpdateParDefaut(4,4);
                header("Refresh:0");
            }
            if (empty($position5)){
                $db->insertUpdateParDefaut(5,4);
                header("Refresh:0");
            }
            if (empty($position6)){
                $db->insertUpdateParDefaut(6,4);
                header("Refresh:0");
            }
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select class="selectChantier" name="selectChantierUpdate' .htmlspecialchars($resultAllChantierKey['id_chantier']). '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.htmlspecialchars($allKey['id_chantier']).'">'.htmlspecialchars($allKey['nom_chantier']).'</option>';
                }
            
            echo '<input type="submit" name="submitPosition' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Valider">
                </div>
                <p>' .htmlspecialchars($resultAllChantierKey['nom_chantier']) .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '" alt="">
                        </div>
                    </div>
                </div>
                <p>' .htmlspecialchars($resultAllChantierKey['description_chantier']). '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Modifier">
                    <input type="submit" name="Supprimer' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Supprimer">
                    <input type="hidden" class="inputHidden" name="postSupprimer' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="' .$resultAllChantierKey['id_chantier']. '">
                    <input type="hidden" name="oldImageAv" value="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '">
                    <input type="hidden" name="oldImageAp" value="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '">';
                    if (isset($_POST['Supprimer' .$resultAllChantierKey['id_chantier']. ''])) {
                        $oldImageAvDelete=$_POST['oldImageAv'];
                        $oldImageApDelete=$_POST['oldImageAp'];
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition' .$resultAllChantierKey['id_chantier']. ''])){
                        
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultAllChantierKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        var_dump($idChantierToReplace2);
                        var_dump($idChantierToReplace1);
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1);
                            if ($db) {
                                $countParDefaut=$db->countParDefaut(4);
                                if ($countParDefaut!=0) {
                                    $db->deleteParDefaut(4);
                                }
                            }  
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }
        echo '</div></section>';
        ?><section class='chantierAfficheUpdate2'>
            <p class='titleAffiche'>Chantiers disponibles:</p>
        <div class="slideChantierUpdate"><?php
        $resultChantierDispo=$db->readAllSlideWhereAnd2(4);
        foreach ($resultChantierDispo as $resultChantierDispoKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <div class="positionDiv">
                    <select class="selectChantier" name="selectChantierUpdate' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '">
                    <option value="">Sélectionner un chantier</option>';

                foreach($all as $allKey){
                    echo '<option value="'.htmlspecialchars($allKey['id_chantier']).'">'.htmlspecialchars($allKey['nom_chantier']).'</option>';
                }
            
            echo '<input type="submit" name="submitPosition2' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Valider">
                </div>
                <p>' .htmlspecialchars($resultChantierDispoKey['nom_chantier']) .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '" alt="">
                        </div>
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <div class="imageDivUpdate">
                            <img src="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '" alt="">
                        </div>
                    </div>
                </div>
                <p>' .htmlspecialchars($resultChantierDispoKey['description_chantier']). '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Modifier">
                    <input type="submit" name="Supprimer' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="Supprimer">
                    <input type="hidden" class="inputHidden" name="postSupprimer' .htmlspecialchars($resultChantierDispoKey['id_chantier']). '" value="' .$resultChantierDispoKey['id_chantier']. '">
                    <input type="hidden" name="oldImageAv" value="' .htmlspecialchars($resultChantierDispoKey['photo_av_chantier']). '">
                    <input type="hidden" name="oldImageAp" value="' .htmlspecialchars($resultChantierDispoKey['photo_ap_chantier']). '">';
                    if (isset($_POST['Supprimer' .$resultChantierDispoKey['id_chantier']. ''])) {
                        $oldImageAvDelete=$_POST['oldImageAv'];
                        $oldImageApDelete=$_POST['oldImageAp'];
                        $idCardSelect=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                        header("Refresh:0");
                    }
                    if (isset($_POST['submitPosition2' .$resultChantierDispoKey['id_chantier']. ''])){
                        $idChantierToReplace1=$_POST['selectChantierUpdate' .$resultChantierDispoKey['id_chantier']. ''];
                        $idChantierToReplace2=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        if (!empty($idChantierToReplace1)) {
                            $positionChantierArray1=$db->selectPosition($idChantierToReplace1);
                        $positionChantierArray2=$db->selectPosition($idChantierToReplace2);
                        $positionChantier1=$positionChantierArray1[0]['position_chantier'];
                        $positionChantier2=$positionChantierArray2[0]['position_chantier'];
                            $db->updatePosition($positionChantier1, $idChantierToReplace2);
                            $db->updatePosition($positionChantier2, $idChantierToReplace1);
                            if ($db) {
                                $countParDefaut=$db->countParDefaut(4);
                                if ($countParDefaut!=0) {
                                    $db->deleteParDefaut(4);
                                }
                            } 
                            header("Refresh:0");
                        }
                    }
                    if (isset($_POST['Modifier' .$resultChantierDispoKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultChantierDispoKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div>
            </form>';
        }

        echo '</div></section>';

        
    }
    
                            // AFFICHER TOUT //


    if (isset($_GET['page'], $_GET['modifieraffichage'], $_GET['categorie']) && $_GET['page']='affichage' && $_GET['modifieraffichage']='54123687569842000' && $_GET['categorie']=='All'){
        ?>
        <script>
            document.querySelector('.afficher').style.backgroundColor = ("#346077")
            document.querySelector('.afficher').style.color = ("#ffffff")
        </script>
        <section class='chantierAfficheUpdate'>
        <p class='titleAffiche'>Tout vos chantiers:</p>
        <div class="slideChantierUpdate">
        <?php
        $resultAllChantier=$db->readAllSlide();
        foreach ($resultAllChantier as $resultAllChantierKey) {
            echo
                '<form method=\'POST\' class=\'updateCardPost\'>
                <p>' .htmlspecialchars($resultAllChantierKey['nom_chantier']) .'</p>
                <div class="imageCardUpdate">
                    <div class="imageAvant">
                        <p>Avant</p>
                        <img src="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '" alt="">
                    </div>
                    <div class="imageApres">
                        <p>Après</p>
                        <img src="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '" alt="">
                    </div>
                </div>
                <p>' .htmlspecialchars($resultAllChantierKey['description_chantier']). '</p>
                <div class="updOrDelete">
                    <input type="submit" name="Modifier' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Modifier">
                    <input type="submit" name="Supprimer' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="Supprimer">
                    <input type="hidden" class="inputHidden" name="postSupprimer' .htmlspecialchars($resultAllChantierKey['id_chantier']). '" value="' .$resultAllChantierKey['id_chantier']. '">
                    <input type="hidden" name="oldImageAv" value="' .htmlspecialchars($resultAllChantierKey['photo_av_chantier']). '">
                    <input type="hidden" name="oldImageAp" value="' .htmlspecialchars($resultAllChantierKey['photo_ap_chantier']). '">';
                    if (isset($_POST['Supprimer' .$resultAllChantierKey['id_chantier']. ''])) {
                        $oldImageAvDelete=$_POST['oldImageAv'];
                        $oldImageApDelete=$_POST['oldImageAp'];
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        $db->deleteCard($idCardSelect);
                        if($db && !empty($oldImageApDelete) && !empty($oldImageAvDelete)){
                            unlink($oldImageAvDelete);
                            unlink($oldImageApDelete);
                        }
                    }
                    if (isset($_POST['Modifier' .$resultAllChantierKey['id_chantier']. ''])) {
                        $idCardSelect=$_POST['postSupprimer' .$resultAllChantierKey['id_chantier']. ''];
                        header("Location: index.php?page=realisation&command=modifier&card=$idCardSelect");
                    }
                echo '</div></form>';
        }
        
        echo '</div></section>';
    }

                                                        // AFFICHER TOUT //

                                                        // PAGE POUR MODIFIER //




    if (isset($_GET['page'], $_GET['command'], $_GET['card']) && $_GET['page']='realisation' && $_GET['command']='modifier'){
        $idCardUpdate=$_GET['card'];
        $resultCardUpdate=$db->readAllSlideUpdate($idCardUpdate);
        foreach ($resultCardUpdate as $resultCardUpdateKey){
        echo
                '<div class="divUpdateCardModifer"><form class="updateForm" method=\'POST\' enctype="multipart/form-data"><div class="cardupdate">
                <input type="text" class="inputModifier" name="updateNomInput" value="' .htmlspecialchars($resultCardUpdateKey['nom_chantier']) .'">
                <div class="imageCardUpdate">
                    <div class="imageAvantUp">
                        <p>Avant</p>
                        <img src="' .htmlspecialchars($resultCardUpdateKey['photo_av_chantier']). '" alt="">
                        <input type="file" name="uploadImgAv">
                        <input type="hidden" name="oldImageAv" value="' .htmlspecialchars($resultCardUpdateKey['photo_av_chantier']). '">
                    </div>
                    <div class="imageApresUp">
                        <p>Après</p>
                        <img src="' .htmlspecialchars($resultCardUpdateKey['photo_ap_chantier']). '" alt="">
                        <input type="file" name="uploadImgAp">
                        <input type="hidden" name="oldImageAp" value="' .htmlspecialchars($resultCardUpdateKey['photo_ap_chantier']). '">
                        
                    </div>
                </div>
                <textarea placeholder="Ecrivez une description (max=150 caractère)." class="areaModifier" name="updateDescriptionInput">' .htmlspecialchars($resultCardUpdateKey['description_chantier']) .'</textarea>
                <div class="updOrDelete">
                    <input type="submit" name="Supprimer' .htmlspecialchars($resultCardUpdateKey['id_chantier']). '" value="Supprimer">
                    <input type="text" class="inputHidden" name="postSupprimer' .htmlspecialchars($resultCardUpdateKey['id_chantier']). '" value="' .htmlspecialchars($resultCardUpdateKey['id_chantier']). '">
                    <input type="submit" name="validerUpdate" value="Valider">
                    </div>
                </div></form></div>';
        }
        if (isset($_POST['validerUpdate'])){
            if ($_FILES['uploadImgAv']['name'] !=''){
            $nameFile=$_FILES['uploadImgAv']['name'];
            $tmpFile=$_FILES['uploadImgAv']['tmp_name'];
            $typeFile=$_FILES['uploadImgAv']['type'];
            $sizeFile=$_FILES['uploadImgAv']['size'];
            $errFile=$_FILES['uploadImgAv']['error'];
            $oldImageAv=$_POST['oldImageAv'];
            $extensions=['png','jpg','jpeg', 'gif'];
            $type=['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
            $extension=explode(".", $nameFile);
            $maxSize=10000000;

            
            if (in_array($typeFile, $type)) {
                if (count($extension)<= 2 && in_array(strtolower(end($extension)), $extensions)) {
                    if ($sizeFile <=  $maxSize && $errFile == 0) {
                        $newName=uniqid(). '.' . strtolower(end($extension));
                        $imgPath='./images/'.$newName;
                        if (move_uploaded_file($tmpFile, $imgPath)) {
                            $db->uploadimgUpdate($imgPath, $idCardUpdate);
                            if ($db && !empty($oldImageAv)) {
                                unlink($oldImageAv);
                            }
                            var_dump($newName);           
                            echo 'Upload effectué';
                        }
                        else{
                            echo 'Erreur';
                        }
                    }
                    else {
                        echo 'Erreur, vérifier la taille.';
                    }
                }
                else{
                    echo 'Merci de mettre un image';
                }
            }
            else {
                echo 'Type non autorisé.';
            }
            }
        
        if ($_FILES['uploadImgAp']['name'] !=''){
            $nameFile=$_FILES['uploadImgAp']['name'];
            $tmpFile=$_FILES['uploadImgAp']['tmp_name'];
            $typeFile=$_FILES['uploadImgAp']['type'];
            $sizeFile=$_FILES['uploadImgAp']['size'];
            $errFile=$_FILES['uploadImgAp']['error'];
            $oldImageAp=$_POST['oldImageAp'];
            $extensions=['png','jpg','jpeg', 'gif'];
            $type=['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
            $extension=explode(".", $nameFile);
            $maxSize=10000000;

            
            if (in_array($typeFile, $type)) {
                if (count($extension)<= 2 && in_array(strtolower(end($extension)), $extensions)) {
                    if ($sizeFile <=  $maxSize && $errFile == 0) {
                        $newName=uniqid(). '.' . strtolower(end($extension));
                        $imgPath='./images/'.$newName;
                        if (move_uploaded_file($tmpFile, $imgPath)) {
                            $db->uploadimgUpdate2($imgPath, $idCardUpdate);
                            if ($db && !empty($oldImageAp)) {
                                unlink($oldImageAp);
                            }
                            var_dump($newName);           
                            echo 'Upload effectué';
                        }
                        else{
                            echo 'Erreur';
                        }
                    }
                    else {
                        echo 'Erreur, vérifier la taille.';
                    }
                }
                else{
                    echo 'Merci de mettre un image';
                }
            }
            else {
                echo 'Type non autorisé.';
            }
            }
            $newTitle=$_POST['updateNomInput'];
            $newDescription=$_POST['updateDescriptionInput'];
            $db->update2($newTitle, $newDescription, $idCardUpdate);
            header("Refresh:0"); 
        }
  }


  

    ?>
    </section>









                <?php   
                }








            }


             if (isset($_POST['submit_deconnexion'])) {
        $Deconnexion = $db->deconnexion();
    }
?>













        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script src="script/script.js"></script>
<?php
ob_end_flush();
?>
</body>
</html>








