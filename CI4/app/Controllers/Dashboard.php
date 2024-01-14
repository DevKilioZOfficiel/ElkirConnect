<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use Models\SessionModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\HTTP\Files\UploadedFile;

class Dashboard extends BaseController{

	protected $session;
	//protected $builder;


	public function __construct(){
		// start session
		$this->session = Services::session();
		helper(['form', 'url', 'text']);
		//$db = db_connect();
		//protected $db;
		//$this->db =& $db;
	}

	public function index(){
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
  	}else{
			$user = "0";
			$permissions = "0";
			return redirect()->to(base_url('login'))->withInput()->with('error', lang('Language.error__no_connected'));
		}
		$data = [
        'title'  => 'Dashboard',
        'description' => '',
        'image' => '',
				'locale' => $this->request->getLocale(),
        'content' => 'dashboard/index',
				'user' => $sessionmodel->user(session('userData.id')),
				'request' => \Config\Services::request(),
				'permissions' => $sessionmodel->permission($user['grade'])
    ];
		if (!session('isLoggedIn')) {
			return redirect()->to(base_url('login'))->withInput()->with('error', lang('Language.error__no_connected'));
		}else{
		  echo view('layouts/default', $data);
	  }
	}
	public function new(){
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
  	}else{
			$user = "0";
			$permissions = "0";
			return redirect()->to(base_url('login'))->withInput()->with('error', lang('Language.error__no_connected'));
		}
		$data = [
        'title'  => 'Nouvelle demande',
        'description' => '',
        'image' => '',
				'locale' => $this->request->getLocale(),
        'content' => 'dashboard/new',
				'user' => $sessionmodel->user(session('userData.id')),
				'request' => \Config\Services::request(),
				'permissions' => $sessionmodel->permission($user['grade'])
    ];
		if (!session('isLoggedIn')) {
			return redirect()->to(base_url('login'))->withInput()->with('error', lang('Language.error__no_connected'));
		}else{
		  echo view('layouts/default', $data);
	  }
	}

	public function sendproject(){
		$db = \Config\Database::connect();
		$sessionmodel = new \App\Models\SessionModel();
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);
  	}else{
			$user = "0";
			$permissions = "0";
			return redirect()->to(base_url('login'))->withInput()->with('error', lang('Language.error__no_connected'));
		}
		// validate request
		$rules = [
			'prenom' 	=> 'required',
			'nom'		=> 'required',
			'age' 	=> 'required|alpha_numeric', // mini. 15
			'postes' 	=> 'required',
			'formations' 	=> 'required',
			'experiences' 	=> 'required',

			'project_name' 	=> 'required|is_unique[projects.name]',
			'project_legal' 	=> 'required',
			'project_effectif' 	=> 'required|alpha_numeric',
			'project_object' 	=> 'required',
			'project_description' 	=> 'required',
			'project_help_elkir' 	=> 'required',
		];

		if (!$this->validate($rules)) {
			return redirect()->to('dashboard/new')->withInput()->with('errors', $this->validator->getErrors());
		}else{
				$builder = $db->table('projects');
				$data = [
					'user' => $user['id'],
					'name' => strip_tags($this->request->getVar('project_name')),
					'slug' => url_title( strip_tags($this->request->getVar('project_name')), '-', true),
					'icone' => "https://cdn.elkir.fr/assets/img/avatars/img-profil-base.jpg",
					'description' => strip_tags($sessionmodel->paragrapher($this->request->getVar('project_description'))),
					'url' => "",
					'status' => 0,
					'user_prenom' => strip_tags($this->request->getVar('prenom')),
					'user_nom' => strip_tags($this->request->getVar('nom')),
					'user_age' => strip_tags($this->request->getVar('age')),
					'user_poste' => strip_tags($this->request->getVar('postes')),
					'user_formations' => strip_tags($this->request->getVar('formations')),
					'user_experiences' => strip_tags($this->request->getVar('experiences')),
					'projet_legal_status' => strip_tags($this->request->getVar('project_legal')),
					'projet_objet' => strip_tags($this->request->getVar('project_object')),
					'projet_membres' => strip_tags($this->request->getVar('project_effectif')),
					'projet_elkir' => strip_tags($this->request->getVar('project_help_elkir'))
				];
				$builder->insert($data);
				return redirect()->to('dashboard/new')->withInput()->with('success', "Votre projet est actuellement en attente. Une réponse sous peu sera envoyée par email !");
		}
	}
	//--------------------------------------------------------------------

}
