<?php

function add_post($title, $contents){
	$file = add_attachment();
	$title = htmlentities(mysql_real_escape_string($title));
	$contents = htmlentities(mysql_real_escape_string($contents));
	
	mysql_query("INSERT INTO posts (title, contents, posted_date) VALUES('$title', '$contents', NOW())");
}

function edit_post($id, $title, $contents){
	
	$id 		= (int)$id;
	$title 		= htmlentities(mysql_real_escape_string($title));
	$contents 	= htmlentities(mysql_real_escape_string($contents));
	
	$sql = 	"UPDATE posts SET title = '$title', contents = '$contents' WHERE id = '$id'";
	
	$res = mysql_query($sql);
	
	//mysql_query("UPDATE 'posts' SET 'title'=[$title], 'contents'=[$contents] WHERE 'id'=".$id.";");
}

function delete($table, $id){
	
	$table = mysql_real_escape_string($table);
	$id = (int)$id;
	
	mysql_query("DELETE FROM posts WHERE id = '$id'");

}

function get_posts($id = null){
// ORDER BY id DESC
	$posts = array();
	
	$query = "SELECT `id`, `title`, `contents`, `posted_date` FROM `posts`";

	if ( isset($id) ){
		$id = (int)$id;
		
	$query .= " WHERE id = {$id}" ;
	}
	$query .= " ORDER BY id DESC";
	
	$query = mysql_query($query);
	
	while ( $row = mysql_fetch_assoc($query) ){
		$posts[] = $row;
	}
	return $posts;
		
}

function add_attachment(){

	if(isset($_FILES['upload'])) {
	
		$file_type = $_FILES['upload']['type']; //returns the mimetype

			$allowed = array("image/jpeg", "image/gif", "image/png", "application/pdf");
					if(!in_array($file_type, $allowed)) {
						$errors = 'Only jpg, gif, and pdf files are allowed.';
					}else{
						move_uploaded_file ($_FILES['upload']['tmp_name'], "upload/{$_FILES['upload']['name']}");
						mysql_query("INSERT INTO attachments (names) VALUES('" . mysql_real_escape_string($_FILES['upload']['name']) . "')");
					}

	}	
}

/*function add_attachment(){

	if( isset( $_FILES['upload'] ) ) {
	
		if( $_FILES['upload'] ){
						
				if (move_uploaded_file ($_FILES['upload']['tmp_name'], "upload/{$_FILES['upload']['name']}")){
					//mysql_query("INSERT INTO posts (names) VALUES('" . mysql_real_escape_string($_FILES['upload']['name']) . "')");
			}
		}
	
	}

}*/
?>
