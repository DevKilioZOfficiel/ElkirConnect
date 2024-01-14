<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use CodeIgniter\Database\ConnectionInterface;

class Project extends BaseController{

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

	public function index($id = FALSE){
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		$info_project = $sessionmodel->projects($id);
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$data['permissions'] = $sessionmodel->permission($user['grade']);
  	}else{
			$user = "0";
			$data['permissions'] = "0";
		}
		if(empty($info_project)){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}else{
			$builder = $db->table('projects');
      $builder->where('user', $user['id']);
      $builder->where('id', $info_project['id']);
      $verification = $builder->countAllResults();

			$builder = $db->table('projects__access');
      $builder->where('user', $user['id']);
      $builder->where('project_id', $info_project['id']);
      $verification_staff = $builder->countAllResults();
			if($verification === 1 || $verification_staff === 1){
		  	$data = [
				  'info_project' => $sessionmodel->projects($id),
          'title'  => $info_project['name'],
          'description' => $info_project['description'],
          'image' => $info_project['icone'],
		  		'locale' => $this->request->getLocale(),
					'request' => \Config\Services::request(),
          'content' => 'projects/index',
		  		'user' => $sessionmodel->user(session('userData.id')),
					'sessionmodel' => new \App\Models\SessionModel(),
			  	'permissions' => $data['permissions']
      	];
		  	echo view('layouts/default', $data);
		 	}else{
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		 	}
	  }
	}

	public function settings($id = FALSE){
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		$info_project = $sessionmodel->projects($id);
		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$data['permissions'] = $sessionmodel->permission($user['grade']);
  	}else{
			$user = "0";
			$data['permissions'] = "0";
		}
		if(empty($info_project)){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}else{
			$builder = $db->table('projects');
      $builder->where('user', $user['id']);
      $builder->where('id', $info_project['id']);
      $verification = $builder->countAllResults();

			$builder = $db->table('projects__access');
      $builder->where('user', $user['id']);
      $builder->where('project_id', $info_project['id']);
      $verification_staff = $builder->countAllResults();
			if($verification === 1 || $verification_staff === 1){
		  	$data = [
				  'info_project' => $sessionmodel->projects($id),
          'title'  => $info_project['name'],
          'description' => $info_project['description'],
          'image' => $info_project['icone'],
		  		'locale' => $this->request->getLocale(),
					'request' => \Config\Services::request(),
          'content' => 'projects/settings',
		  		'user' => $sessionmodel->user(session('userData.id')),
					'sessionmodel' => new \App\Models\SessionModel(),
			  	'permissions' => $data['permissions']
      	];
		  	echo view('layouts/default', $data);
		 	}else{
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		 	}
	  }
	}

	public function import($page = FALSE){
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();
		$info_project = $sessionmodel->projects($page);
		if(!empty($info_project)){
			$request = \Config\Services::request();
			$data = [
					'locale' => $this->request->getLocale(),
					'user' => $sessionmodel->user(session('userData.id')),
					'request' => \Config\Services::request()
			];

			$input = [
				//'avatar'		=> 'required|uploaded[avatar]|mime_in[avatar,image/webp,image/png,image/jpg]',
				'avatar' => 'ext_in[avatar,png,jpg,gif,webp]|is_image[avatar]|max_dims[avatar,2048,2048]'
			];
			if (!$this->validate($input)) {
				return redirect()->to('project/'.$info_project['slug'].'/settings')->withInput()->with('errors', $this->validator->getErrors());
			}else{
				if(!$this->validator->getErrors('avatar')){
					$img = $this->request->getFile('avatar');
		    	$newName = $img->getRandomName();
		    	$img->move('./uploads/createurs/', $newName);

					$extension = $img->getClientExtension();

					$builder = $db->table('projects');
					$builder->set('icone', base_url('uploads/createurs/'.$newName.''));
					$builder->where('id', $info_project['id']);
					$builder->update();
					return redirect()->to(base_url('project/'.$info_project['slug'].'/settings'))->withInput()->with('success', 'Logo mis à jour avec succès.');
				}else{
					return redirect()->to(base_url('project/'.$info_project['slug'].'/settings'))->withInput()->with('error', "Oups. Une erreur est survenue lors de la mise à jour du logo.");
				}
			}

		}
	}

	//--------------------------------------------------------------------

}
