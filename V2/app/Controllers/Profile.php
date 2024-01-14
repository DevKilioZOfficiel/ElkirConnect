<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use CodeIgniter\Database\ConnectionInterface;

class Profile extends BaseController{

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

	public function index($user1 = FALSE){
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		$info_user = $sessionmodel->info_user($user1);
		if(!empty($info_user['discord'])){
	  	$discord_info = $sessionmodel->discord($info_user['discord'], "574220363345690625");
		}else{
		  $discord_info = "";
		}
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$data['permissions'] = $sessionmodel->permission($user['grade']);
  	}else{
			$user = "0";
			$data['permissions'] = "0";
		}
		if(empty($info_user)){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}else{
		  $data = [
				  'user1' => $user1,
				  'info_user' => $sessionmodel->info_user($user1),
          'title'  => $info_user['pseudo'],
          'description' => $info_user['biographie'],
          'image' => '',
      		'adsense' => true,
      		'twemoji' => true,
		  		'locale' => $this->request->getLocale(),
          'content' => 'profile/index',
		  		'user' => $sessionmodel->user(session('userData.id')),
					'discord' => $discord_info,
					'permission_user' => $sessionmodel->permission($info_user['grade']),
					'postmodal' => new \App\Models\PostModel(),
					'sessionmodel' => new \App\Models\SessionModel(),
			  	'permissions' => $data['permissions']
      ];
		  echo view('layouts/default', $data);
	  }
	}

	//--------------------------------------------------------------------

}
