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
    $_SESSION['list_academies']= mysqli_query($con, $sql1);
       echo "<datalist id='list_academie'  >";
       while($row=mysqli_fetch_assoc($_SESSION['list_academies'])){
          echo "<option value=".$row['academie_admin']." >".$row['academie_admin']."</option>";
       }echo "</datalist>";
   echo "<datalist id='list_metier' size='5' ><option value='Prof' ></option><option value='Derecteur' ></option><option value='Economist' ></option><option value='Administratif' ></option></datalist>";
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
	 <form method="post" action="index.php" >
	 Nom et Prenom d'admin :<input type="text" name="nom_prenom" ></br>
	 l'academie d'admin:<input type="text" name="academie" ></br>
	  Mot de Passe :<input type="password" name="password_1" ></br>
	  Retapez votre mot de passe :<input type="password" name="password_2" ></br>
	  Adresse email :<input type="text" name="email" value="server@taib.php" ></br></br>
	  <button name="btn_Insc_admin" >Inscription</button></br>
	</form>
<?php } //inscriptionadmin($con);?>
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
	 <form method="post" action="index.php" >
	 Nom et Prenom d'user :<input type="text" name="nom_prenom" ></br>
	 metier d'user : <input list="list_metier" name="metier" ></br>
	 l'academie d'user :<input list="list_academie" name="academie" ></br>
	 ville d'user :<input type="text" name="ville" ></br>
	 ecole d'user :<input type="text" name="ecole" ></br>
	  Mot de Passe :<input type="password" name="password_1" ></br>
	  Retapez votre mot de passe :<input type="password" name="password_2" ></br>
	  Adresse email :<input type="text" name="email" value="server@taib.php" ></br></br>
	  <button name="btn_Insc_user" >Inscription</button></br>
	</form>
<?php }//inscriptionuser($con); ?>
<?php function connexionadmin($con){
	    $nom_prenom_admin = "";
	    $pass_admin= "";
	    $email_admin="";
	    $errors = array();
	   if(isset($_POST['Conn_btn_admin'])){
		   $nom_prenom_admin=$_POST['nom_prenom_admin'];
		   $pass_admin=$_POST['pass_admin'];
		   $email_admin=$_POST['email_admin'];
		if (empty($nom_prenom_admin)) { array_push($errors, "Username required"); }
		if (empty($email_admin)) { array_push($errors, "email required"); }
		if (empty($pass_admin)) { array_push($errors, "Password required"); }
		if (empty($errors)) {
			
		   $sql1="SELECT * FROM controler_transitions.admin_academie WHERE nom_prenom_admin='$nom_prenom_admin' AND email_admin='$email_admin' ";
		   $result=mysqli_query($con,$sql1);
		   if( mysqli_num_rows($result) > 0){
		   $tab=mysqli_fetch_array($result);
		     if(password_verify($pass_admin,$tab['pass_admin'])){
		       $_SESSION['nom_prenom_admin']=$_POST['nom_prenom_admin'];
               $_SESSION['email_admin']=$tab['email_admin'];
               $_SESSION['id_admin']=$tab['id_admin'];
                   header("location: Index.php");	   
		   }else {
				array_push($errors, 'Password incorrecte');
			}
		   }else{
			   array_push($errors, 'les données n-exist pas ou Vous Inscript');
		   }
	     }
	   } ?>
		<form method="post" action="index.php" >
		<h3>Connexion​</h3>
		  <?php include(ROOT_PATH . '/errors.php') ?>
		nom prénom d'admin :<input type="text" name="nom_prenom_admin"  ></br>
		Email d'admin :<input type="text" name="email_admin"  ></br>
	    Mot de Passe :<input type="password" name="pass_admin"></br>
	    <button name="Conn_btn_admin" >Connexion</button></br>
	     </form>
<?php } //connexionadmin($con);?>
<?php function connexionuser($con){
	    $nom_prenom_user = "";
	    $pass_user= "";
	    $email_user="";
	    $errors = array();
	   if(isset($_POST['Conn_btn_user'])){
		   $nom_prenom_user=$_POST['nom_prenom_user'];
		   $pass_user=$_POST['pass_user'];
		   $email_user=$_POST['email_user'];
		if (empty($nom_prenom_user)) { array_push($errors, "Username required"); }
		if (empty($email_user)) { array_push($errors, "email required"); }
		if (empty($pass_user)) { array_push($errors, "Password required"); }
		if (empty($errors)) {
			
		   $sql1="SELECT * FROM controler_transitions.user WHERE nom_prenom_user='$nom_prenom_user' AND email_user='$email_user' ";
		   $result=mysqli_query($con,$sql1);
		   if( mysqli_num_rows($result) > 0){
		   $tab=mysqli_fetch_array($result);
		     if(password_verify($pass_user,$tab['pass_user'])){
		       $_SESSION['nom_prenom_user']=$_POST['nom_prenom_user'];
               $_SESSION['id_academie_user']=$tab['id_academie_user'];
               $_SESSION['email_user']=$tab['email_user'];
               $_SESSION['id_user']=$tab['id_user'];
                   header("location: Index.php");	   
		   }else {
				array_push($errors, 'Password incorrecte');
			}
		   }else{
			   array_push($errors, 'les données n-exist pas ou Vous Inscript');
		   }
	     }
	   } ?>
		<form method="post" action="index.php" >
		<h3>Connexion​</h3>
		  <?php include(ROOT_PATH . '/errors.php') ?>
		nom prénom d'user :<input type="text" name="nom_prenom_user"  ></br>
		Email d'user :<input type="text" name="email_user"  ></br>
	    Mot de Passe :<input type="password" name="pass_user"></br>
	    <button name="Conn_btn_user" >Connexion</button></br>
	     </form>
<?php }//connexionuser($con); ?>
<?php function dommandeuser($con){
           $errors = array();
           $id_user=$_SESSION['id_user'];
           $id_admin=$_SESSION['id_academie_user'];
		   $sql1= "SELECT * FROM controler_transitions.user WHERE id_user=$id_user ";
		   $result=mysqli_query($con,$sql1);
		   $user=mysqli_fetch_array($result);
		   include(ROOT_PATH . '/errors.php');	    
        if( $user['dommande'] == "oui" ){ 
        	array_push($errors, 'La dommande est déja crées un suel foit ;');
            header("location: Index.php");
        }else{
        $id_academie_rechercher=0;
        $academie_rechercher=0;
        $ville_rechercher="non-importe";
        $ecole_rechercher="non-importe";
        $inserting="";
	   if(isset($_POST['btn_doma_user'])){
		   $academie_rechercher=$_POST['academie_rechercher'];
		   $ville_rechercher=$_POST['ville_rechercher'];
		   $ecole_rechercher=$_POST['ecole_rechercher'];
		if (empty($academie_rechercher)) { array_push($errors, "L'academie est obligatoir"); }
			    $sql="SELECT id_admin FROM controler_transitions.admin_academie WHERE academie_admin='$academie_rechercher' ";
			    $result1=mysqli_query($con, $sql);
			    $id_academie = mysqli_fetch_assoc($result1);
			    $id_academie_rechercher=$id_academie['id_admin'];
		if (empty($errors)) {
		   $iserting="INSERT INTO controler_transitions.dommande(id_user,id_admin,id_academie_rechercher,ville_rechercher,ecole_rechercher,date_dommande_user) VALUES ($id_user,$id_admin,$id_academie_rechercher,'$ville_rechercher','$ecole_rechercher',now())";
		   $execut=mysqli_query($con,$iserting);
		   if($execut){
		   	   $update="UPDATE controler_transitions.user SET dommande='oui' WHERE id_user='$id_user' ";
		   	   $execut1=mysqli_query($con,$update);
               if($execut1){header("location: Index.php");}else{
		   	          array_push($errors, "Ereere en date_modify in table user");
		        }
		   }else{
		   	 array_push($errors, "Rian ne insert ereer de code");
		   }          
	     }
	   } ?>
		<form method="post" action="index.php" >
		<h3>Dommande Transition :</h3>
		  <?php include(ROOT_PATH . '/errors.php') ?>
		 Academie Rechercher :<input list="list_academie" name="academie_rechercher"  ></br>
		 Ville_Rechercher :<input type="text" name="ville_rechercher"  ></br>
	     Ecole_Rechercher :<input type="text" name="ecole_rechercher"></br>
	    <button name="btn_doma_user" >Dommandé</button></br>
	     </form>
<?php } }//dommandeuser($con);?>
<?php function analysedommande($con){
           $errors = array();
           $id_user=$_SESSION['id_user'];
           $id_admin=$_SESSION['id_academie_user'];
		   $sql1= "SELECT * FROM controler_transitions . user WHERE id_user=$id_user ";
		   $result=mysqli_query($con,$sql1);
		   $user=mysqli_fetch_array($result);
		   include(ROOT_PATH . '/errors.php');	    
        if( $user['dommande'] == "non" ){
        	array_push($errors, 'La dommande ne pas crée ;');
            //header("location: Index.php");
        }else{
          //info de ma demmande
		   $sql2= "SELECT * FROM controler_transitions . dommande WHERE id_user=$id_user ";
		   $result1=mysqli_query($con,$sql2);
		   $dommande_moi=mysqli_fetch_array($result1);
		   $id_admin_rechecher_moi=$dommande_moi['id_academie_rechercher'];
          //info des dommande comme moi
		   $sql3 = "SELECT * FROM controler_transitions . dommande WHERE id_academie_rechercher=$id_admin AND id_user IN (SELECT id_user FROM controler_transitions . dommande WHERE id_admin=$id_admin_rechecher_moi )";
		   $result2=mysqli_query($con,$sql3);
		   $dommande_toi=mysqli_fetch_array($result2);
          //INSERTING
		   $id_dommande_moi=$dommande_moi['id_dommande'];
		   while ($row=mysqli_fetch_array($result2)) {
              $id_dommande_toi=$dommande_toi['id_dommande'];
              $id_user_peut_etre=$dommande_toi['id_user'];
              $id_admin_peut_etre=$dommande_toi['id_admin'];
              $sql4="INSERT INTO controler_transitions . analyse_dommande(id_user,id_dommande_moi,id_dommande_toi,id_user_peut_etre,id_admin_peut_etre,date_dommande,date_daccord_user,date_daccord_ad_moi,date_daccord_ad_toi) VALUES ($id_user,$id_dommande_moi,$id_dommande_toi,$id_user_peut_etre,$id_admin_peut_etre,now(),now(),now(),now()) ";	
              $insert=mysqli_query($con,$sql4);if(!$insert){array_push($errors, 'rian ne inserting ereer de code ;');}	  
		   }

        }
}//analysedommande($con);?>

<?php function list_dommande($con){
      analysedommande($con);
           $errors = array();
           $id_user=$_SESSION['id_user'];
           $id_admin=$_SESSION['id_academie_user'];
		   $sql1= "SELECT * FROM controler_transitions . analyse_dommande WHERE id_user=$id_user ";
		   $result1=mysqli_query($con,$sql1);
           while($rew=mysqli_fetch_array($result1)){
              $id_user_peut_etre=$analyse['id_user_peut_etre'];
              $id_admin_peut_etre=$analyse['id_admin_peut_etre'];
               	  $sql2= "SELECT U . nom_prenom_user,A . academie_admin,U . ville_user,U . ecole_user,D . ville_rechercher,D . ecole_rechercher FROM controler_transitions . user U,controler_transitions . admin A,controler_transitions . dommande D WHERE U . id_user=$id_user_peut_etre AND A . id_admin=$id_admin_peut_etre AND D . id_user=$id_user_peut_etre ";
		          $result2=mysqli_query($con,$sql2);
               	  $sql3= "SELECT academie_admin FROM controler_transitions . admin_academie WHERE id_admin IN (SELECT id_academie_rechercher FROM controler_transitions . dommande WHERE id_user=$id_user_peut_etre )";
		          $result3=mysqli_query($con,$sql3);
		          $valo1=mysqli_fetch_array($result2);
		          $valo2=mysqli_fetch_array($result3); ?>              
                      <form method="post" action="index.php" >
	                      <div>
		                      nom prenom :  <?php echo $valo1['nom_prenom_user']; ?><br>
		                      nom academie :  <?php echo $valo1['academie_admin']; ?><br>
		                      ville :  <?php echo $valo1['ville_user']; ?><br>
		                      ecole :  <?php echo $valo1['ecole_user']; ?><br>
		                      nom academie rechercher :  <?php echo $valo2['academie_admin']; ?><br>
		                      ville rechecher :  <?php echo $valo1['ville_rechercher']; ?><br>
		                      ecole recherche :  <?php echo $valo1['ecole_rechercher']; ?><br>
                              <button><a href="invit.php?id_user1=$id_user&id_user2=$id_user_peut_etre">invitation</a></button><br>
	                      </div>
                      </form>        
<?php } } ?>
