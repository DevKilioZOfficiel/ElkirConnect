<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use Models\SessionModel;
use CodeIgniter\Database\ConnectionInterface;

class Auth extends BaseController
{
	protected $session;

	public function __construct(){
		// start session
		$this->session = Services::session();
		helper(['form', 'url', 'text']);
	}

	public function register(){
		$sessionmodel = new \App\Models\SessionModel();
		$db = \Config\Database::connect();
		$data = [
        'title'  => 'Inscription',
        'description' => "Découvrez dès aujourd'hui tout ce qu'ElkirConnect peut vous proposer.",
        'image' => '',
				'locale' => $this->request->getLocale(),
        'content' => 'auth/register',
				'user' => $sessionmodel->user(session('userData.id'))
    ];
		if (!session('isLoggedIn')) {
		  echo view('layouts/default', $data);
	  }else{
			return redirect()->to('dashboard');
		}
	}

	public function login(){
		$sessionmodel = new \App\Models\SessionModel();

		$db = \Config\Database::connect();
		$data = [
        'title'  => 'Connexion',
        'description' => "Connectez-vous à votre compte ElkirConnect.",
        'image' => '',
				'locale' => $this->request->getLocale(),
        'content' => 'auth/login',
				'user' => $sessionmodel->user(session('userData.id'))
    ];
		if (!session('isLoggedIn')) {
		  echo view('layouts/default', $data);
	  }else{
			return redirect()->to('dashboard');
		}
	}

	public function login_post(){
		$db = \Config\Database::connect();
		// validate request
		$rules = [
			'elkir__email'		=> 'required|valid_email',
			'elkir__password' 	=> 'required|min_length[6]',
		];

		if (!$this->validate($rules)) {
			return redirect()->to('login')->withInput()->with('errors', $this->validator->getErrors());
		}else{
	   	// check credentials
			$builder = $db->table('user');
			$builder->where('email', $this->request->getVar('elkir__email'));
			$verify__user_exist = $builder->countAllResults();
			if($verify__user_exist == 1){ // Verif si le compte existe

				$builder2 = $db->table('user');
				$builder2->where('email', $this->request->getVar('elkir__email'));
				$query = $builder2->get();
				foreach ($query->getResult() as $row){ // Affiche les données
	   	    if (sha1($this->request->getVar('elkir__password')) != $row->password) {
	   	    	return redirect()->to('login')->withInput()->with('error', "Oups. On dirait que votre mot de passe n'est pas correcte.");
	   	    }else{
	          // login OK, save user data to session
	          $this->session->set('isLoggedIn', true);
	          $this->session->set('userData', [
	          	 'id' 	    	=> $row->id
  	       	]);

						$builder3 = $db->table('user');
						$builder3->set('last_login', date('Y-m-d H:i:s'));
						$builder3->where('email', $this->request->getVar('elkir__email'));
						$builder3->update();
            return redirect()->to('/')->withInput()->with('success', "Connexion au compte Elkir réussi. Chargement en cours.");
	   	    }
				}
			}else{
				return redirect()->to('login')->withInput()->with('error', "Erreur. Nous n'avons trouvé aucun compte avec les éléments que vous avez fournis.");
			}
	   }
	}

	public function register_post(){
		$db = \Config\Database::connect();
		$sessionmodel = new \App\Models\SessionModel();
		// validate request
		$rules = [
		  'pseudo' 	=> 'required|min_length[3]|is_unique[user.username]',
			'email'		=> 'required|valid_email|is_unique[user.email]',
			'password' 	=> 'required|min_length[6]',
			'password2' 	=> 'required|matches[password]',
			'condition' 	=> 'required',
		];

		if (!$this->validate($rules)) {
			return redirect()->to('register')->withInput()->with('errors', $this->validator->getErrors());
		}else{
			$builder = $db->table('user');
			$builder->where('email', $this->request->getVar('email'));
			$verify__user_exist = $builder->countAllResults();
			if($verify__user_exist == 0){ // Verif si le compte pas existe
				$pseudo_check = $sessionmodel->security($this->request->getVar('pseudo'));
				if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $pseudo_check)){
					return redirect()->to('register')->withInput()->with('error', 'Vous utilisez des caractères interdit. Veuillez changer votre pseudo.');
				}else{
					//$builder = $db->table('security__vericiation');
          //$builder->where('id', $this->request->getVar('verification__devtime2'));
          //$query = $builder->get();
          //foreach ($query->getResult() as $row){
					//if($row->response == $this->request->getVar('verification__devtime')){
						$email_domain = preg_replace('/^[^@]++@/', '', $this->request->getVar('email'));
						if ((bool) checkdnsrr($email_domain, 'MX')==FALSE){
			      	return redirect()->to('register')->withInput()->with('error', 'Une erreur est survenue. #EMAIL01');
			      }else{

			           	$builder = $db->table('user');
			           	$data = [
			           		'username' => $sessionmodel->security($this->request->getVar('pseudo')),
			           		'password' => sha1($this->request->getVar('password')),
			           		'email' => $this->request->getVar('email')
			           	];
			           	$builder->insert($data);



			           	return redirect()->to('login')->withInput()->with('success', "Inscription avec succès ! Vous pouvez désormais vous connecter a votre compte ElkirConnect !");
						}
			  	//}else{
					//	return redirect()->to('register')->withInput()->with('error', 'La vérification est pas correcte !');
			  	//}
			  }
			}else{
				return redirect()->to('register')->withInput()->with('error', lang('Language.error__account_exist'));
			}
		}
	}

	public function forgot_post(){
		$db = \Config\Database::connect();
		$sessionmodel = new \App\Models\SessionModel();
		// validate request
		$rules = [
			'elkir__email_forgot'		=> 'required|valid_email',
		];

		if (!$this->validate($rules)) {
			return redirect()->to('login')->withInput()->with('errors', $this->validator->getErrors());
		}else{
	   	// check credentials
			$builder = $db->table('user');
			$builder->where('email', $this->request->getVar('elkir__email_forgot'));
			$verify__user_exist = $builder->countAllResults();
			if($verify__user_exist == 1){ // Verif si le compte pas existe
				$builder = $db->table('user');
				$code = "DVTME8-".rand(1,9999)."-".rand(1,9999)."-".rand(1,9999)."-PWD";
				$builder->set('password', sha1($code));
				$builder->where('email', $this->request->getVar('elkir__email_forgot'));
				$builder->update();

				$email = \Config\Services::email();
	      $config['protocol'] = 'sendmail';
	      $config['mailPath'] = '/usr/sbin/sendmail';
	      $config['charset']  = 'utf-8';
	      $config['wordWrap'] = true;

	      $email->initialize($config);

	      $email->setFrom('noreply@elkir.fr', 'Elkir');
	      $email->setTo($this->request->getVar('elkir__email_forgot'));

	      $email->setSubject('Mot de passe oublié - ElkirConnect !');
	      $email->setMessage('Bonjour,
	Voici votre nouveau mot de passe pour accéder a votre compte ElkirConnect.
	'.$code);

	      $email->send();



				return redirect()->to('login')->withInput()->with('success', lang('Language.text__forgot_password_sended'));
			}else{
				return redirect()->to('login')->withInput()->with('error', lang('Language.error__account_not_exist'));
			}
	   }
	}

	public function logout(){
		$this->session->remove(['isLoggedIn', 'userData','token','token_secret','request_vars']);

		return redirect()->to('login');
	}

	//--------------------------------------------------------------------

}
