<?php
$request = \Config\Services::request();
$sessionmodel = new \App\Models\SessionModel();
$session = \Config\Services::session();
$db = \Config\Database::connect();
if(!empty($_SERVER['HTTP_REFERER'])){
  $findme = "connect.elkir.fr";
  $pos = strpos($_SERVER['HTTP_REFERER'], $findme);
  if($pos == true){
    if($ref === "register"){
      if(
       strip_tags(!empty($request->GetPost('pseudo'))) &&
       strip_tags(!empty($request->GetPost('password'))) &&
       strip_tags(!empty($request->GetPost('password2'))) &&
       strip_tags(!empty($request->GetPost('email'))) &&
       strip_tags(!empty($request->GetPost('conditions')))){
         if($request->GetPost('conditions') == "false"){
           echo "<div class='alert alert-danger'>Vous devez accepter les conditions et la politique avant de vous inscrire.</div>";
         }else{
         $builder = $db->table('user');
   			 $builder->where('email', $request->GetPost('email'));
   			 $verify__user_exist = $builder->countAllResults();
   			 if($verify__user_exist == 0){
           if(sha1($request->GetPost('password')) === sha1($request->GetPost('password2'))){
           $builder = $db->table('user');
           $data = [
             'username' => $sessionmodel->security($request->GetPost('pseudo')),
             'password' => sha1($request->GetPost('password')),
             'email' => $request->GetPost('email')
           ];
           $builder->insert($data);
           echo "<div class='alert alert-success'>Inscription avec succès</div>";
         }else{
           echo "<div class='alert alert-warning'>Les mots de passes ne sont pas identique.</div>";
         }
         }else{
           echo "<div class='alert alert-warning'>Ce compte existe déjà ! Pensez à vous connecter.</div>";
         }
       }
      }else{
        echo "<div class='alert alert-danger'>Certains champs sont vide. Pensez à bien les remplir !</div>";
      }
    }
    if($ref === "login"){
      $builder = $db->table('user');
			$builder->where('email', $request->GetPost('pseudo'));
			$verify__user_exist = $builder->countAllResults();
			if($verify__user_exist == 1){ // Verif si le compte existe

				$builder2 = $db->table('user');
				$builder2->where('email', $request->GetPost('pseudo'));
				$query = $builder2->get();
				foreach ($query->getResult() as $row){ // Affiche les données
	   	    if (sha1($request->GetPost('password')) != $row->password) {
            echo "<div class='alert alert-danger'>Le mot de passe de votre compte est incorrecte.</div>";
	   	    }elseif ($row->etat == 1) { // Desactived account
            echo "<div class='alert alert-danger'>Oups. On dirait que votre compte est désactivé !</div>";
	   	    }else{
	          // login OK, save user data to session
	          $session->set('isLoggedIn', true);
	          $session->set('userData', [
	          	 'id' => $row->id
  	       	]);

						$builder3 = $db->table('user');
						$builder3->set('last_login', date('Y-m-d H:i:s'));
            $builder3->where('email', $request->GetPost('pseudo'));
						$builder3->update();
            echo "<div class='alert alert-success'>Connexion réussie</div>";
	   	    }
				}
			}else{
        echo "<div class='alert alert-danger'>Oups. Ce compte n'existe pas. Vérifiez l'email ou le pseudo.</div>";
			}
    }
    if($ref === "update"){
      if(!empty($request->GetPost('password')) && !empty($request->GetPost('password2'))){
	   	if (sha1($request->GetPost('password')) != sha1($request->GetPost('password2'))) {
        echo "<div class='alert alert-danger'>Le mot de passe de votre compte est incorrecte.</div>";
	   	}else{
        $builder3 = $db->table('user');
				$builder3->set('password', sha1($request->GetPost('password')));
        $builder3->where('id', $user['id']);
				$builder3->update();
        echo "<div class='alert alert-success'>Votre mot de passe vient d'être modifié avec succès.</div>";
      }
      }
      if (sha1($user['email']) != sha1($request->GetPost('email'))) {
        $builder3 = $db->table('user');
  		 	$builder3->set('email', $request->GetPost('email'));
        $builder3->where('id', $user['id']);
  		 	$builder3->update();
        echo "<div class='alert alert-success'>Votre mot de passe vient d'être modifié avec succès.</div>";
      }
    }
    if($ref === "delete"){
      echo "<div class='alert alert-success'>Votre compte ElkirConnect vient d'être supprimé avec succès.</div>";
      $builder = $db->table('user');
      $builder->where('id', $user['id']);
      $builder->delete();
      $builder = $db->table('projects');
      $builder->where('user', $user['id']);
      $builder->delete();
      $builder = $db->table('projects__access');
      $builder->where('user', $user['id']);
      $builder->delete();
      $session->remove(['isLoggedIn', 'userData','token','token_secret','request_vars']);
    }
  }
} ?>
