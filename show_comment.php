<?php
    include('config/constants.php');
?>
<?php
$commentQuery = "SELECT review_id, product_id, username, content, createAt FROM tbl_reviews WHERE product_id = '0' ORDER BY review_id DESC";
$commentsResult = mysqli_query($conn, $commentQuery) or die("database error:". mysqli_error($conn));
$commentHTML = '';
while($comment = mysqli_fetch_assoc($commentsResult)){
	$commentHTML .= '
		<div class="panel panel-primary">
		<div class="panel-heading">By <b>'.$comment["username"].'</b> on <i>'.$comment["createAt"].'</i></div>
		<div class="panel-body">'.$comment["content"].'</div>
		<div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="'.$comment["review_id"].'">Reply</button></div>
		</div> ';
	$commentHTML .= getCommentReply($conn, $comment["review_id"]);
}
echo $commentHTML;
function getCommentReply($conn, $parentId = 0, $marginLeft = 0) {
	$commentHTML = '';
    $commentQuery = "SELECT review_id, product_id, username, content, createAt FROM tbl_reviews WHERE product_id = '".$product_id."'";
	// $commentQuery = "SELECT id, parent_id, comment, sender, date FROM comment WHERE parent_id = '".$parentId."'";	
	$commentsResult = mysqli_query($conn, $commentQuery);
	$commentsCount = mysqli_num_rows($commentsResult);
	if($parentId == 0) {
		$marginLeft = 0;
	} else {
		$marginLeft = $marginLeft + 48;
	}
	if($commentsCount > 0) {
		while($comment = mysqli_fetch_assoc($commentsResult)){  
			$commentHTML .= '
            <div class="panel panel-primary">
            <div class="panel-heading">By <b>'.$comment["username"].'</b> on <i>'.$comment["createAt"].'</i></div>
            <div class="panel-body">'.$comment["content"].'</div>
            <div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="'.$comment["review_id"].'">Reply</button></div>
            </div> ';
			$commentHTML .= getCommentReply($conn, $comment["id"], $marginLeft);
		}
	}
	return $commentHTML;
}
?>