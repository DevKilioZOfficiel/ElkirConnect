<?php
header('Content-Type: application/json');
$request = \Config\Services::request();
$sessionmodel = new \App\Models\SessionModel();
$session = \Config\Services::session();
$db = \Config\Database::connect();
$builder = $db->table('projects');
$query = $builder->get();
foreach ($query->getResult() as $key => $value) {
  if($value->referent_id != 0){
    $builder2 = $db->table('user');
    $builder2->where('id',$value->referent_id);
    $query2 = $builder2->get();
    foreach ($query2->getResult() as $key_referent => $value_referent) {
      $referent = $value_referent->username;
    }
    $builder2 = $db->table('user');
    $builder2->where('id',$value->user);
    $query2 = $builder2->get();
    foreach ($query2->getResult() as $key_referent => $value_referent) {
      $username = $value_referent->username;
    }
  }else{
    $referent = 0;
  }
  $api[] = array(
    "id" => $value->id,
    "info_project" => array(
      "name" => $value->name,
      "objet" => $value->projet_objet,
      "membres" => $value->projet_membres,
      "legal" => $value->projet_legal_status,
      "published" => $value->published,
      "status" => $value->status,
      "logo" => $value->icone,
      "username" => $username,
    ),
    "name" => $value->name,
    "slug" => $value->slug,
    "description" => htmlentities($value->description),
    "referent" => $referent,
    "pourquoi_elkir" => $value->projet_elkir,
  );
} ?>
{"api":<?= json_encode($api); ?>}
