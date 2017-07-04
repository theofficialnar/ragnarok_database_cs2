<?php
function header_title(){
	echo 'Build View';
};

function get_title(){
	echo 'myRagnarok db | Build View';
};

function display_content(){
	global $conn;
	$build_id = $_GET['build_id'];
	echo '<div class="container">';
		$sql = "SELECT * FROM builds WHERE id = '$build_id'";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)){
			extract($row);
			echo '<div class="row">
				<h1>'.$build_name.'</h1>
				<span>'.$build_date.'</span><br>
				<h5>'.$build_description.'</h5>
			</div>';
		};//while end

		echo '<div class="row">
			<div class="col l8 m8 s12 offset-l2 offset-m2">
				<div class="col l10 m8 s8">
					<h5>Skill Name</h5>
				</div>
				<div class="col l2 m4 s4">
					<h5>Level</h5>
				</div>';
		$sql = "SELECT * FROM builds b JOIN skill_sims ss ON b.id = ss.build_id JOIN skills s ON ss.skill_id = s.id WHERE build_id = '$build_id'";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)){
			extract($row);
				echo '<div class="col l10 m8 s8">
					<p><img src="'.$icon.'"> '.$skill_name.'</p>
				</div>
				<div class="col l2 m4 s4">	
					<p>'.$level.'</p>
				</div>';
		};//while end
			echo '</div>
		</div>
		<div class="row">
			<div class="input-field">
				<span style="display: none" id="build_id">'.$build_id.'</span>
				<span style="display: none" id="user_id">'.$_SESSION['id'].'</span>
				<textarea name="build_comment" id="build_comment" class="materialize-textarea"></textarea>
				<label for="build_comment">Leave a comment</label>
				<button id="build-comment-submit">Comment</button>
			</div>
		</div>

		<div class="row">
			<div id="comment-section">';
		$sql = "SELECT * FROM build_comments bc JOIN builds b ON bc.build_id = b.id JOIN users u ON bc.commenter_id = u.id WHERE build_id = '$build_id'";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)){
			extract($row);
			echo '<p>Posted by: '.$username.'</p>
				<p>Date: '.$comment_date.'</p>
				<p>Comment: '.$comment.'<p>';
		};
			echo '</div>
		</div>
	</div>';
};

require_once 'template.php';

?>