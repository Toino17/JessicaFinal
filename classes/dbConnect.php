<?php

include 'Database.php';

class DbConnect extends Database{
    private $dbConnect;    


    public function __construct()
    {
        
        $this->dbConnect = Database::dbConnect();
    }



    public function insertPartenaire ($nomCollab,$logoCollab){        
        $sqlinsertPartenaire = "INSERT INTO collab(nom_collab, logo_collab, id_style)
                                VALUES (:nom_collab, :logo_collab, :id_style)";

        $stmtinsertPartenaire =$this->dbConnect->prepare($sqlinsertPartenaire);
        $stmtinsertPartenaire->bindValue(':nom_collab', $nomCollab);
        $stmtinsertPartenaire->bindValue(':logo_collab', $logoCollab);
        $stmtinsertPartenaire->bindValue(':id_style', "1");

        $stmtinsertPartenaire->execute();
        
        return 'Le partenaire a bien été ajouté';
    } 

    public function insertEntreprise ($nomCollab,$logoCollab){        
        $sqlinsertEntreprise = "INSERT INTO collab(nom_collab, logo_collab, id_style)
                                VALUES (:nom_collab, :logo_collab, :id_style)";

        $stmtinsertEntreprise =$this->dbConnect->prepare($sqlinsertEntreprise);
        $stmtinsertEntreprise->bindValue(':nom_collab', $nomCollab);
        $stmtinsertEntreprise->bindValue(':logo_collab', $logoCollab);
        $stmtinsertEntreprise->bindValue(':id_style', "2");
        $stmtinsertEntreprise->execute();
        
        return 'L\'entreprise a été bien ajoutée';
    } 

    public function creationCompte($emailAdmin, $mdp_admin) {
        $insertUserQuery = "INSERT INTO `admin` (email_admin, mdp_admin, `role`) 
                            VALUES (:email_admin, :mdp_admin, :role)";
        $insertUserStmt = $this->dbConnect->prepare($insertUserQuery);
        $insertUserStmt->bindValue(':email_admin', $emailAdmin);
        $insertUserStmt->bindValue(':mdp_admin', $mdp_admin);
        $insertUserStmt->bindValue(':role', "0");
        $insertUserStmt->bindValue('mdp_admin', password_hash($mdp_admin, PASSWORD_DEFAULT)); 
        $insertUserStmt->execute();
        echo "Le compte a été créé avec succès!";
    }

    
    public function Connexion($emailAdmin) {
        $checkUserQuery = "SELECT * FROM admin WHERE email_admin = :email_admin";
        $checkUserStmt = $this->dbConnect->prepare($checkUserQuery);
        $checkUserStmt->bindValue(':email_admin', $emailAdmin);
        $checkUserStmt->execute();
        $user = $checkUserStmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }  

    public function setAdmin($user) {
        $_SESSION['id_admin'] = $user['id_admin'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email_admin'] = $user['email_admin'];
    }
    
    public function deconnexion() {
        session_destroy();
        echo "<h1>Merci de votre visite !</h1>";
        echo "<p>Nous vous remercions d'avoir visité notre site. Nous espérons vous revoir bientôt !</p>";
        header("refresh:1;url=http://localhost/JessicaIntegrationAdminFinal/index.php");
        exit();
    }

    public function modifCompte ($idAdmin, $newEmail, $newPassword) {
        $updateUserQuery = "UPDATE admin
                            SET email_admin = :new_email,  
                                mdp_admin = :new_password
                            WHERE id_admin = :admin_id";
        $updateUserStmt = $this->dbConnect->prepare($updateUserQuery);
        $updateUserStmt->bindValue(':new_email',$newEmail);
        $updateUserStmt->bindValue(':new_password',password_hash($newPassword, PASSWORD_DEFAULT));
        $updateUserStmt->bindValue(':admin_id',$idAdmin);
        $updateUserStmt->execute();
        return 'les modifications ont bien été prises en compte!';
    }



// gestion section realisation slide






    public function readAllSlide()
    {
        $sql="SELECT * FROM `chantier`;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAllSlideWhereAnd($idtravaux)
    {
        $sql="SELECT * FROM `chantier` WHERE `id_travaux`=$idtravaux AND `position_chantier`!=0 ORDER BY `position_chantier` ASC;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAllSlideWhereAnd2($idtravaux)
    {
        $sql="SELECT * FROM `chantier` WHERE `id_travaux`=$idtravaux AND `position_chantier`=0 ORDER BY `position_chantier` ASC;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAllSlideWhere($idtravaux)
    {
        $sql="SELECT * FROM `chantier` WHERE `id_travaux`=$idtravaux;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCard($idCardDelete){
        $sqlDeleteCard="DELETE FROM `chantier` WHERE `id_chantier`=$idCardDelete;";
        $stmtDeleteCard= $this->dbConnect->prepare($sqlDeleteCard);
        $stmtDeleteCard->execute();
        }

    public function readAllSlideUpdate($idCardUpdate){

        $sql="SELECT * FROM `chantier` WHERE `id_chantier`=$idCardUpdate;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function uploadimgUpdate($imgPath, $idCardUpdate){
        $sql="UPDATE `chantier`
            SET `photo_av_chantier`='$imgPath' WHERE `id_chantier`=$idCardUpdate;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
    }

    public function uploadimgUpdate2($imgPath, $idCardUpdate){
        $sql="UPDATE `chantier`
            SET `photo_ap_chantier`='$imgPath' WHERE `id_chantier`=$idCardUpdate;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
    }

    public function update2($newTitle, $newDescription, $idCardUpdate){
        $sql="UPDATE `chantier`
        SET `nom_chantier` = :newTitle, `description_chantier` = :newDescription WHERE `id_chantier` = :idCardUpdate;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->bindParam(":newTitle", $newTitle, PDO::PARAM_STR);
        $stmt->bindParam(":newDescription", $newDescription, PDO::PARAM_STR);
        $stmt->bindParam(":idCardUpdate", $idCardUpdate, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function insertUpdateParDefaut($positionParDefaut,$idtravaux){
        $sql="INSERT INTO `chantier`(`nom_chantier`, `description_chantier`, `position_chantier`, `id_travaux`) VALUES ('Chantier$positionParDefaut','Description par défaut','$positionParDefaut','$idtravaux');";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
    }

    public function readAllSlideWherePosition($idtravaux, $position)
    {
        $sql="SELECT * FROM `chantier` WHERE `id_travaux`=$idtravaux AND `position_chantier`=$position;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectPosition($idChantierToReplace)
    {
        $sql="SELECT `position_chantier` FROM `chantier` WHERE `id_chantier`=$idChantierToReplace;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePosition($positionChantier, $idChantier){
        $sql="UPDATE `chantier`
        SET `position_chantier`='$positionChantier' WHERE `id_chantier`=$idChantier;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
    }

    public function deleteParDefaut($idtravaux){
        $sql="DELETE FROM `chantier` WHERE `description_chantier`='Description par défaut' AND `position_chantier`=0 AND `id_travaux`=$idtravaux;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        
    }

    public function countParDefaut($idtravaux){
        $sql="SELECT COUNT(*) FROM  `chantier` WHERE `description_chantier`='Description par défaut' AND `position_chantier`=0 AND `id_travaux`=$idtravaux;";
        $stmt= $this->dbConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }











} 

