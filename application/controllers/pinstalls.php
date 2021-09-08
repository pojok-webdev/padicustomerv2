<?php
  class Pinstalls extends CI_Controller{
    function __construct(){
      parent::__construct();
    }
    function countfiles(){
      $directory = '/home/klien/www/padicustomer/padiapp-data/installs/vsd/';
      $filecount = 0;
      $files = glob($directory . "*.vsd");
      if ($files){
        $filecount = count($files);
      }
      return $filecount;
    }
    function getfiles(){
      $id = $this->uri->segment(3);
      $directory = '/home/klien/www/padicustomer/padiapp-data/installs/vsd/'.$id;
      $filecount = 0;
      $files = glob($directory . "*.vsd");
      $arr = array();
      if ($files){
        foreach($files as $fl){
          array_push($arr,substr($fl,38,strlen($fl) - 38));
        }
      }      
      echo json_encode($arr);
    }
    function  do_upload(){
      $dir = 'installs/vsd/';
      $basicurl = '/home/klien/www/padicustomer/padiapp-data/';
      $this->createDirectory($basicurl.$dir);
      $target = $basicurl.$dir . $_FILES['file']['name'] .'-'. $this->countfiles() . '.vsd';
      $target = $basicurl.$dir . $_FILES['file']['name'] . '.vsd';
      $target = $basicurl.$dir . $_FILES['file']['name'] .'-'. date("Y-m-d") . 'T' .  date('H:i:sa') . '.vsd';
      move_uploaded_file($_FILES['file']['tmp_name'], $target);
      $oldmask = umask(0);
      chmod($target,0777);
      umask($oldmask);
      print_r($_FILES);
      die();
    }
    function createdir(){
      $this->createDirectory($this->uri->segment(3));
    }
    function createDirectory($directory){
      if(!file_exists($directory)){
        $oldmask = umask(0);
        mkdir($directory,0777);
        umask($oldmask);
      }
    }
  }
?>
