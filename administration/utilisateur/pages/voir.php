<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

// $id = $_GET["id"];
// $sql = "SELECT * from utilisateur WHERE id=$id";
// $req = $bdd->prepare($sql);
// $req->execute();
// $utilisateurs = $req->fetch(PDO::FETCH_ASSOC);
// var_dump($utilisateurs);

if (isset($_GET['id'])){
    $id = intval($_GET['id']);
    if ($id > 0){
         $sql  = 'SELECT * FROM utilisateur WHERE id='.$id;
         $req = $bdd->prepare($sql);
         $req->execute();
         $utilisateurs = $req->fetch(PDO::FETCH_ASSOC);
//         var_dump($utilisateur);
        $sqlRoles = 'SELECT * FROM role';
        $reqRoles = $bdd->prepare($sqlRoles);
        $reqRoles->execute();
        $roles = $reqRoles->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($roles);
        $sqlRolesUtilisateur = 'SELECT * FROM utilisateur_role  WHERE utilisateur_role.id_utilisateur = '.$id;
        $reqRolesUtilisateur = $bdd->prepare($sqlRolesUtilisateur);
        $reqRolesUtilisateur->execute();
        $rolesUtilisateur = $reqRolesUtilisateur->fetchAll(PDO::FETCH_ASSOC);
    //    var_dump($rolesUtilisateur);
        foreach ($rolesUtilisateur as $role) {
            $rolesId[] = $role['id_role'];
        }
    //    var_dump($rolesId);
    
    }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<?php if (isset($_SESSION["ajout_utilisateur"]) && $_SESSION["ajout_utilisateur"] == true) { ?>
        <div class="alert alert-success col-11 text-center mx-auto" role="alert">
            L'utilisateur a été créer !
        </div>
<?php unset($_SESSION["ajout_utilisateur"]); } ?>
<?php if (isset($_SESSION["modif_utilisateur"]) && $_SESSION["modif_utilisateur"] == true) { ?>
        <div class="alert alert-info col-11 text-center mx-auto" role="alert">
            L'utilisateur a été modifié !
        </div>
<?php unset($_SESSION["modif_utilisateur"]); } ?>

<h1 class="text-center">utilisateur n° <?php echo $utilisateurs["id"] ?></h1>

<table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                    <th>Rôle</th>
                    <th>Avatar</th>
                   
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $utilisateurs["id"] ?></td>
                    <td><?php echo $utilisateurs["nom"] ?></td>
                    <td><?php echo $utilisateurs["prenom"] ?></td>
                    <td><?php echo $utilisateurs["pseudo"] ?></td>
                    <td><?php echo $utilisateurs["mail"] ?></td>  
                    <td><select class="form-control user-role" id="role" name="role[]" multiple="multiple" disabled>
                        <?php  foreach ($roles as $role):
                                if (in_array($role["id"],$rolesId)) {
                                    $selected='selected';
                                }else {
                                    $selected='';
                                }?>
                            <option value="<?= $role['id'] ?>" <?= $selected ?>><?= $role['libelle'] ?></option>
                        <?php endforeach; ?>
                        </select></td>


                    <td><img width="50px" height="50px" src="../img/avatar/<?php echo $utilisateurs["avatar"] ?>" alt=""></td>
                   
         
                </tr>
            
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
        <a href="../index.php" class="text-center btn btn-primary">Retour</a>
        </div>
<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>