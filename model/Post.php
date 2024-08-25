<?php
require_once('../database/ConnectDatabase.php');
require_once('../database/ConvertDataToPosts.php');
// Shorten duplicate queries
$query1 = "SELECT blog_db.posts.id,blog_db.posts.title,blog_db.posts.content,blog_db.posts.user_id
            ,blog_db.posts.created_at,blog_db.posts.updated_at,users.firstname,users.lastname
             FROM blog_db.posts JOIN  blog_db.users ON
               blog_db.posts.user_id=blog_db.users.id";
$query2 = "ORDER BY created_at DESC";
class Post
{
    private int $id;
    private String $title;
    private String $content;
    private String $author;
    private int $user_id;

    private  $created_at;
    private  $updated_at;


    public function __construct($id, $title, $content, $author, $user_id, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->user_id = $user_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    public function getUpdated_at()
    {
        return $this->updated_at;
    }
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
    }
    public function getUser_id()
    {
        return $this->user_id;
    }

    public static function create($title, $content, $user_id)
    {

        $sql = "INSERT INTO blog_db.posts(title,content,user_id)
         VALUES ('$title','$content','$user_id')";
        return   ConnectDatabase::connectDatabae()->query($sql);
    }
    public static function read($id)
    {
        $sql = "$GLOBALS[query1] WHERE blog_db.posts.id='$id';";

        $data =  ConnectDatabase::connectDatabae()->query($sql);
        $post = ConvertDataToPosts::convertOnePost($data);
        return $post;
    }

    public static function update($id, $title, $content)
    {
        $date = date('Y-m-d H:i:s');
        $sql = "UPDATE blog_db.posts SET title='$title', content='$content' , updated_at='$date' WHERE id=$id";

        return  ConnectDatabase::connectDatabae()->query($sql);
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM blog_db.posts WHERE id=$id";

        return  ConnectDatabase::connectDatabae()->query($sql);
    }

    public static function listAll($saerch_key, $saerch_value)
    {
        //check if the user not input any serach operation
        if ($saerch_value == '') {
            $sql = "$GLOBALS[query1]
            $GLOBALS[query2]";
        } else {
            //check if the user is searching for a post from a specific author
            if ($saerch_key == "author") {
                $sql = "$GLOBALS[query1]
                   WHERE blog_db.users.firstname LIKE '%$saerch_value%'
                   OR  blog_db.users.lastname LIKE '%$saerch_value%' $GLOBALS[query2]";
            } else {
                $sql = "$GLOBALS[query1] 
                   WHERE blog_db.posts.$saerch_key LIKE '%$saerch_value%'
                  $GLOBALS[query2]";
            }
        }


        $data =  ConnectDatabase::connectDatabae()->query($sql);
        $posts = ConvertDataToPosts::convertPosts($data);
        return $posts;
    }
    public static function listMyPosts($id, $saerch_key, $saerch_value)
    {

        if ($saerch_value == '') {
            $sql = "$GLOBALS[query1]
               WHERE blog_db.posts.user_id=$id  $GLOBALS[query2]";
        } else {
            $sql = "$GLOBALS[query1]
               WHERE blog_db.posts.user_id=$id  and
                blog_db.posts.$saerch_key LIKE '%$saerch_value%'
                 $GLOBALS[query2]";
        }

        $data =  ConnectDatabase::connectDatabae()->query($sql);
        $posts = ConvertDataToPosts::convertPosts($data);
        return $posts;
    }
}