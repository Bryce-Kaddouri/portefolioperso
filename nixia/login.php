<?php
if (isset($_POST['login'])){
    session_start(); 
    $role=$_POST['role'];
    $emailSaisi = $_POST['email'];
    $pswdSaisi = $_POST['password'];
    require_once "administration/connexionBD.php";
    $sql = "SELECT id, nom, prenom, idRole, COUNT(id) as total  FROM user where email='" . $emailSaisi . "' AND password = SHA1('" .$pswdSaisi . "') AND idRole='". $role . "';";
    $res = $bd->query($sql);
    $ligne = $res -> fetch();
    if ($ligne['total'] == 1){
        if($role == 'Adm'){ 
            header("Location: administration/Administrateur/dashboardAdministrateur.php");
            $_SESSION['nom']=$ligne['nom'] . " " . $ligne['prenom'];
            $_session['id']=$ligne['id'];

        }
        elseif($role=='Emp'){
            header("Location: administration/employe/dashboardEmploye.php");
            $_SESSION['nom']=$ligne['nom'] . " " . $ligne['prenom'];
            $_SESSION['prenom']=$ligne['id'];  
        }
        else{
            echo "<script>alert('Veuillez selectionner votre fonction (Administrateur ou Employé)');</script>";
        }
    }else{
        echo "<script> alert('indentifiant ou mot de passe inccorect !'); </script>";

    }
}

	
 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Connexion Administrateur</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="styles/styleIndex.css">
        <link rel="stylesheet" href="styles/style.css">

        <style>
            
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                    </button>
                    <a href="index.html"><img src="gifntext-gif.gif" alt="giphy"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="login.php">Connexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron text-center">
            <h1>Bienvenue sur notre site !</h1> 
            <p style='color:black'>Ici, vous pouvez vous connecter en tant que administrateur ou employé</p> 
        </div>
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="col-md-6">
                        <img src="https://www.w3schools.com/w3images/avatar2.png" style="width:100%;margin-top:10%; margin-left:5%;">
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-logo">Connexion</h1>
                        <br>
                        <form action="" method="POST">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role"  value="Adm">
                                <label class="form-check-label" for="Administrateur">Administrateur</label>
                            
                                <input style='margin-left: 50px;' class="form-check-input" type="radio" name="role" value="Emp">
                                <label class="form-check-label" for="Employe">Employé</label>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Rester connecté</label>
                            </div>
                            <input type="submit" name="login" value="Login">
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
