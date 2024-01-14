<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\HTTP\UserAgent;

class Home extends BaseController{

	protected $session;
	//protected $builder;


	public function __construct(){
		// start session
		$this->session = Services::session();
		helper(['form', 'url']);
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
		}
		$data = [
        'title'  => 'Accueil',
        'description' => "Bienvenue sur la nouvelle version d'ElkirConnect !",
        'image' => '',
				'locale' => $this->request->getLocale(),
        'content' => 'home/index',
				'user' => $sessionmodel->user(session('userData.id')),
				'permissions' => $permissions
    ];
		echo view('layouts/default', $data);

	}

	//--------------------------------------------------------------------

}
