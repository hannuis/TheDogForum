<?php

require 'script/inc/dbh.inc.php';
require 'sqlReq.inc.php';

function getPost() {
	global $conn;
	$result = mysqli_query($conn,getPostSql($_GET['id']));
	renderPost($result);
}

function getPosts() {
	global $conn;
	$result = mysqli_query($conn,getPostsSql());
	renderPosts($result);
}

function getLatest() {
    global $conn;
	$result = mysqli_query($conn,getLastestPosts(5));
	
    $output = '<ul>';
    while ($row = mysqli_fetch_assoc($result)) {
		$titlee = $row['title'];
        if (strlen($titlee) === 25) {
            $titlee .= "...";
        }
		$id = $row['postID'];
		$output .= '<li><a href="post?id=' .$id .'">' .$titlee .'</a></li>';
	}
    $output .= '</ul>';
    
	echo $output;
}

function searchPosts() {
    global $conn;
    if (isset($_POST['search-submit'])) {
        $search = mysqli_real_escape_string($conn,$_POST['search']);
        if (!empty($search)) {
            $sql = getSearchSql($search);
            $result = mysqli_query($conn,$sql);
            renderPosts($result);
        } else {
            echo '
            <p>No results</p>
            ';
        }
    } else {
        getRandomPosts(5);
    }
}

function getRandomPosts($num) {
	global $conn;
    $result = mysqli_query($conn,getRandomPostsSql($num));
    renderPosts($result);
}

function getComments() {
	global $conn;
	$result = mysqli_query($conn,getCommentsSql($_GET['id']));
	$output = '<div id="comments"> <h3>Kommentarer</h3>';
	
	while ($row = mysqli_fetch_assoc($result)) {
		$contentComment = nl2br($row['content']);
		$date = $row['date'];
		$username = $row['username'];
		
		$output .= '
            <div class="comment">
                <p class="username">' .$username .' skrev:</p>
                <p class="content">' .$contentComment .'</p>
                <p class="date">' .$date .'</p>
            </div>';
	}
	$output .= '</div>';
    echo $output;
}

function getLikes() {
	global $conn;
	$result = mysqli_query($conn,getLikesSql($_GET['id']));
    $output = '<div id="likes"> <h3>Likes</h3>';
	
	while ($row = mysqli_fetch_assoc($result)) {
		$username = $row['username'];
		
		$output .= '
		<div class="like">
			<img src="./img/heart-filled.jpg">
			<p>' .$username .'</p>
		</div>';
	}
	$output .= '</div>';
	echo $output;
}

function getScoreNum($table,$id) {
	global $conn;
    $sql = mysqli_query($conn,getScoreNumSql($table,$id));
	$num = mysqli_fetch_assoc($sql);
	return $num['total'];
}

function renderPost($result) {
	$output = '';
	
	while ($row = mysqli_fetch_assoc($result)) {
		$title = $row['title'];
		$content = nl2br($row['content']);
		$date = $row['date'];
		$id = $row['postID'];
		
		$output .= '<div class="post"><h3>' .$title .'</h3><p class="content">' .$content .'</p><div class="date"><p>' .$date .'</p></div></div>';
	}
	
	echo $output;
}

function renderPosts($result) {
    $output = '';
	
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$author = $row['username'];
			$title = $row['title'];
            if (strlen($title) === 50) {
                $title .= "...";
            }
			$content = nl2br($row['content']);
            if (strlen($content) === 300) {
                $content .= "...";
            }
			$date = $row['date'];
			$id = $row['postID'];
		
            $output .= '
                <div class="post">
                    <a href="post?id=' .$id .'">
                        <h3>' .$author .': ' .$title .'</h3>
                    </a>
                    <a href="post?id=' .$id .'">
                        <p class="content">' .$content .'</p>
                    </a>
                    <div class="date">
                        <p>' .$date .'</p>
                        <p>
                        <span>'.getScoreNum("score",$id) .' Likes</span>
                        <span>'.getScoreNum("comment",$id) .' Kommentarer</span>
                        </p>
                    </div>
                </div>';
		}
	}
	else $output = "No results";
	
	echo $output;
}