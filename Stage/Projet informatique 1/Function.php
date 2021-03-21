<?php 
	session_start();
	$con = mysqli_connect('localhost', 'root','');
	if (!$con) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/Stage/Projet%20informatique%201/');
 /*#############################################################################
#*/ $sql1="SELECT id_admin,academie_admin FROM controler_transitions .admin_academie";
    $_SESSION['list_academies']= array();
    $_SESSION['list_academies']== mysqli_query($con, $sql1);
   echo "<datalist id='list_academie' size='50' >";
       while($row=mysqli_fetch_assoc($_SESSION['list_academies'])){
          echo "<option value=".$row['academie_admin']." >".$row['academie_admin']."</option>";
       }
   echo "</datalist><datalist id='list_metier' size='5' ><option value='Prof' ></option><option value='Derecteur' ></option><option value='Economist' ></option><option value='Administratif' ></option></datalist>";
?>
<?php function inscriptionadmin($con){
	$nom_prenom = "";
	$email    = "";
	$password_1= "";
	$password_2= "";
	$academie="";
	$errors = array(); 
    if(isset($_POST['btn_Insc_admin'])){
			$nom_prenom =$_POST['nom_prenom'];
			$academie =$_POST['academie'];
		    $email = $_POST['email'];
		    $password_1 = $_POST['password_1'];
		    $password_2 =$_POST['password_2'];
			if (empty($nom_prenom)) {  array_push($errors, "il fous Entre votre nom prénom"); }
			if (empty($academie)) {  array_push($errors, "il fous Entre votre region academie"); }
		    if (empty($email)) { array_push($errors, "il fous entre votre email"); }
		    if (empty($password_1)) { array_push($errors, "il fous entrez votre password"); }
		    if ($password_1 != $password_2) { array_push($errors, "votre password ne pas correcte");}
		    $admin_exists = "SELECT * FROM controler_transitions.admin_academie WHERE nom_prenom_admin='$nom_prenom' OR academie_admin='$academie' LIMIT 1";
		    $result = mysqli_query($con, $admin_exists);
		if ($result) {
		    $admin = mysqli_fetch_assoc($result);
			   if ($admin['nom_prenom_admin'] === $nom_prenom) {
			     array_push($errors, "votre nom prénom exists déjà");
		     	}
			   if ($admin['academie_admin'] === $academie) {
			     array_push($errors, "votre academie exists déjà");
			   }
			}
		if (count($errors) == 0) {
				$password = password_hash($password_1,PASSWORD_BCRYPT);
			    $query = "INSERT INTO controler_transitions.admin_academie (nom_prenom_admin,academie_admin,pass_admin,email_admin,date_inscription_admin) VALUES ('$nom_prenom','$academie','$password','$email',now())";
				$req=mysqli_query($con, $query);
				if($req){
			    $_SESSION['nom_prenom_admin']=$_POST['nom_prenom'];
			    $_SESSION['academie_admin']=$_POST['academie'];
                $_SESSION['email']=$_POST['email'];
				header('location: index.php');
				}else{
					array_push($errors, "rian ne insert au vous base donnee il aves error dons le code!!");
				}
			  
		    }
	    } ?>
	 <h3>Inscription</h3>
	 <?php include(ROOT_PATH . '/errors.php') ?>
	 <form method="post" action="Function.php" >
	 Nom et Prenom d'admin :<input type="text" name="nom_prenom" ></br>
	 l'academie d'admin:<input type="text" name="academie" ></br>
	  Mot de Passe :<input type="password" name="password_1" ></br>
	  Retapez votre mot de passe :<input type="password" name="password_2" ></br>
	  Adresse email :<input type="text" name="email" value="server@taib.php" ></br></br>
	  <button name="btn_Insc_admin" >Inscription</button></br>
<?php } ?>
<?php function inscriptionuser($con){
	$nom_prenom="";
	$metier="";
	$ville="";
	$ecole="";
	$id_academie=0;
	$email= "";
	$password_1= "";
	$password_2= "";
	$academie="";
	$errors = array(); 
    if(isset($_POST['btn_Insc_user'])){
			$nom_prenom =$_POST['nom_prenom'];
			$academie =$_POST['academie'];
	        $metier=$_POST['metier'];
	        $ville=$_POST['ville'];
	        $ecole=$_POST['ecole'];
		    $email = $_POST['email'];
		    $password_1 = $_POST['password_1'];
		    $password_2 =$_POST['password_2'];
			if (empty($nom_prenom)) {  array_push($errors, "il fous Entre votre nom prénom"); }
			if (empty($academie)) {  array_push($errors, "il fous Entre votre region academie"); }
		    if (empty($metier)) { array_push($errors, "il fous entre votre metier"); }
		    if (empty($ville)) { array_push($errors, "il fous entre votre ville"); }
		    if (empty($email)) { array_push($errors, "il fous entrez votre email"); }
		    if (empty($password_1)) { array_push($errors, "il fous entrez votre password"); }
		    if ($password_1 != $password_2) { array_push($errors, "votre password ne pas correcte");}
		    $user_exists = "SELECT * FROM controler_transitions.user WHERE nom_prenom_user='$nom_prenom' OR email_user='$email' LIMIT 1";
		    $result = mysqli_query($con, $user_exists);
		if ($result) {
		    $user = mysqli_fetch_assoc($result);
			   if ($user['nom_prenom_user'] === $nom_prenom) {
			     array_push($errors, "votre nom prénom exists déjà");
		     	}
			   if ($user['email_user'] === $email) {
			     array_push($errors, "votre email exists déjà");
			   }
			}
		if (count($errors) == 0) {
			    $sql="SELECT id_admin FROM controler_transitions.admin_academie WHERE academie_admin='$academie' ";
			    $result1=mysqli_query($con, $sql);
			    $id_academie = mysqli_fetch_assoc($result1);
			    $val=$id_academie['id_admin'];
				$password = password_hash($password_1,PASSWORD_BCRYPT);
			    $query = "INSERT INTO controler_transitions . user (nom_prenom_user,id_academie_user,metier_user,pass_user,email_user,ville_user,ecole_user,date_inscription_user) VALUES ('$nom_prenom',$val,'$metier','$password','$email','$ville','$ecole',now())";
				$req=mysqli_query($con, $query);
				if($req){
			    $_SESSION['nom_prenom_user']=$_POST['nom_prenom'];
			    $_SESSION['id_academie_user']=$id_academie['id_admin'];
                $_SESSION['email']=$_POST['email'];
				header('location: index.php');
				}else{
					array_push($errors, "rian ne insert au vous base donnee il aves error dons le code!!");
				}
			  
		    }
	    } ?>
	 <h3>Inscription</h3>
	 <?php include(ROOT_PATH . '/errors.php') ?>
	 <form method="post" action="Function.php" >
	 Nom et Prenom d'user :<input type="text" name="nom_prenom" ></br>
	 metier d'user : <input list="list_metier" name="metier" ></br>
	 l'academie d'user :<input list="list_academie" name="academie" ></br>
	 ville d'user :<input type="text" name="ville" ></br>
	 ecole d'user :<input type="text" name="ecole" ></br>
	  Mot de Passe :<input type="password" name="password_1" ></br>
	  Retapez votre mot de passe :<input type="password" name="password_2" ></br>
	  Adresse email :<input type="text" name="email" value="server@taib.php" ></br></br>
	  <button name="btn_Insc_user" >Inscription</button></br>
<?php } ?>

