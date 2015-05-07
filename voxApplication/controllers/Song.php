<?php

namespace Controllers;

class Song extends \Controllers\BaseController {
	public function index() {
		$songModel = new \Models\SongModel();
		$songs = $songModel->getAll();

		$this->view->songs = $songs;
		$this->view->appendToLayout('body', 'songs');
		$this->view->display('layouts.themesbase');

		$ab = $this->input->post("user");
		if (isset($ab)) {
			echo "<h1>" . $ab . "</h1>"; 
		}
	}

	public function upload() {
		$songname = $this->input->post("name");
		$id = $this->input->post("songid");

		if (isset($songname) && isset($id)) {
			echo $id;
		}

		$this->view->appendToLayout('body', 'uploadsong');
		$this->view->display('layouts.themesbase');
	}
}


// if(isset($_FILES['song_file'])){
//         // checks if the file is uploaded
// 	        if($_FILES['song_file']['tmp_name']){
// 	            // checks if the file is bigger than 2MB (2MB = 20971152bytes)
// 	            if($_FILES['song_file']['size'] > 6097152){
// 	                $err[] = 'The file is more than 2MB';
// 	            }
// 	            // checks for valid image type - more types can be added to the list
// 	            if($_FILES['song_file']['type']!='audio/mp3' &&
// 	                $_FILES['song_file']['type']!='audio/jpeg' &&
// 	                $_FILES['song_file']['type']!='audio/pjerg'){
// 	                $err[] = 'The file is not an audio file';
// 	            }
// 	            // if(!$_POST['folder']>0){
// 	            //     $err[] = 'Please choose a category';
// 	            // }
// 	            // if there aren't any mistakes continue with the execution of the code
// 	            // count($err)==0 - Original code
// 	            if(!isset($err)){
// 	                // creates a user folder with his id
// 	                $folder = '..'.DIRECTORY_SEPARATOR.'user_songs'.DIRECTORY_SEPARATOR.'kgerov';
// 	                if(!is_dir($folder)){
// 	                    mkdir($folder);
// 	                }
// 	                $name = str_replace(' ', '', (time().'_'.$_FILES['song_file']['name']));
// 	                // moves uploaded file
// 	                if(move_uploaded_file($_FILES['song_file']['tmp_name'], $folder.DIRECTORY_SEPARATOR.$name))
// 	                {
// 		                echo $name;
// 	                    //Original code $_POST['is_public'] == 1
// 	                    // if(isset($_POST['is_public'])){
// 	                    //     $public = 1;
// 	                    // }
// 	                    // else{
// 	                    //     $public = 0;
// 	                    // }
// 	                    // run_q('INSERT INTO pictures (pic_name, catalogue_id, comment, date_added, is_public) VALUES
// 	                    // ("'.$name.'",'.(int)$_POST['folder'].',"'.mysql_real_escape_string(addslashes($_POST['user_desc'])).'",'
// 	                    // .time().','.$public.')');
// 	                    // create_thumb('user_songs'.DIRECTORY_SEPARATOR.$_SESSION['user_id'].DIRECTORY_SEPARATOR.$name);
// 	                    // $success = true;
// 	                } else {
// 	                    $err[] = 'Error while copying file. Please try again.';
// 	                }
// 	            }
// 	        }
// 	    }