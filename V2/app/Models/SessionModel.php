<?php namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model{

  public function security($value){
    return strip_tags($value);
  }
  public function paragrapher($textarea){
    $textarea = str_replace("\r", '', $textarea);
    $textarea = preg_replace("'^(\n){1,}|(\n){1,}$'", '', $textarea);
    $textarea = preg_replace("'(\n){3,}|(\n){3,}'", "\n\n", $textarea);
    $textarea = str_replace("\n\n", '</p><p>', $textarea);
    $textarea = str_replace("\n", '<br />', $textarea);
    return $textarea;
  }

  public function permission($session_grade) {
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM permissions WHERE id_grade ='".$session_grade."'");
    return $builder->getRowArray();
	}
  public function user($user_id) {
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM user WHERE id ='".$user_id."'");
    return $builder->getRowArray();
	}

  public function projects($slug) {
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT * FROM projects WHERE slug ='".$slug."'");
    return $builder->getRowArray();
	}

  public function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
  }

  public function count_projects($year,$month){
    $db = \Config\Database::connect();
    $builder = $db->table('projects');
    $builder->like('date', ''.$year.'-'.$month.'');
    return $builder->countAllResults();
  }

  public function Send_Email($email_email,$title,$description,$status){
    $email = \Config\Services::email();

    $config_email['protocol'] = 'smtp';
    //$config_email['mailPath'] = '/usr/sbin/sendmail';
    $config_email['charset']  = 'utf-8';
    $config_email['mailType']  = 'html';
    $config_email['SMTPHost']  = 'smtp.ionos.fr';
    $config_email['SMTPUser']  = 'noreply@elkir-studio.com';
    $config_email['SMTPPass']  = 'Wj8vPiD263kD';
    $config_email['SMTPPort']  = '587';
    $config_email['SMTPCrypto']  = '';
    $config_email['SMTPKeepAlive'] = true;
    $config_email['wordWrap'] = true;
    $email->initialize($config_email);

    $email->setFrom('noreply@elkir-studio.com', 'ElkirConnect');
    $email->setTo($email_email);

    $email->setSubject($title);
    $email->setMessage($description);

    if (! $email->send()) {
      //error_reporting(E_ALL);
        //echo "<div class='alert alert-danger'>Envoi de l'email échoué</div>";
        //print_r(  $email->printDebugger());
    }else{
      echo "<div class='alert alert-success'>Un email est en cours d'envoi !</div>";
      $email->send();
    }
  }
}
