<?php

require_once('../model/Post.php');
class ConvertDataToPosts
{
    // convert one record from posts table to post object 
    public static function convertOnePost($data)
    {
        $data = $data->fetch(PDO::FETCH_OBJ);
        $post = new Post($data->id, $data->title, $data->content, $data->firstname . ' ' . $data->lastname, $data->user_id, $data->created_at, $data->updated_at);
        return $post;
    }
    // convert records from posts table to array of post object 

    public static function convertPosts($data)
    {
        $data = $data->fetchAll(PDO::FETCH_OBJ);
        $posts = [];
        foreach ($data as $d) {
            $post = new Post($d->id, $d->title, $d->content, $d->firstname . ' ' . $d->lastname, $d->user_id, $d->created_at, $d->updated_at);
            array_push($posts, $post);
        }
        return $posts;
    }
}
