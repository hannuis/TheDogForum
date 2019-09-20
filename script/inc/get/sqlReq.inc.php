<?php

function getPostSql($id) {
    return "SELECT * 
            FROM post 
            WHERE postID = '$id' 
            LIMIT 1";
}

function getPostsSql() {
    return "SELECT 
	       post.postID, 
	       LEFT(post.title, 50) AS title, 
	       LEFT(post.content, 300) AS content, 
           post.date, 
           user.username FROM post
           LEFT JOIN user 
           ON post.postCreatorID = user.userID 
           ORDER BY post.date DESC";
}

function getLastestPosts($num) {
    return "SELECT 
            post.postID, 
            LEFT(post.title, 25) AS title, 
            post.date 
            FROM post 
            ORDER BY post.date DESC 
            LIMIT $num";
}

function getSearchSql($s) {
    return "SELECT 
            post.postID, 
            LEFT(post.title, 50) AS title,
            LEFT(post.content, 300) AS content, 
            post.date, 
            user.username 
            FROM post LEFT JOIN user 
            ON post.postCreatorID = user.userID 
            WHERE post.title LIKE '%$s%' 
            OR post.content LIKE '%$s%' 
            OR post.date LIKE '%$s%' 
            OR user.username LIKE '%$s%'
            ORDER BY post.date DESC";
}

function getRandomPostsSql($num) {
    return "SELECT 
	       post.postID, 
	       LEFT(post.title, 50) AS title, 
           LEFT(post.content, 300) AS content, 
           post.date, 
           user.username 
           FROM post LEFT JOIN user 
           ON post.postCreatorID = user.userID 
           ORDER BY RAND() 
           LIMIT $num";
}

function getCommentsSql($id) {
    return "SELECT 
            b.content, 
            b.date, 
            a.username 
            FROM comment AS b INNER JOIN user AS a 
            ON (b.commentCreatorID = a.userID) 
            AND (b.postID = '$id')
            ORDER BY b.date DESC";
}

function getLikesSql($id) {
    return "SELECT 
            user.username 
            FROM user LEFT JOIN score 
            ON score.userID = user.userID 
            WHERE score.postID = '$id'";
}

function getScoreNumSql($table,$id) {
    return "SELECT 
            COUNT(postID) AS total 
            FROM $table 
            WHERE postID = $id";
}