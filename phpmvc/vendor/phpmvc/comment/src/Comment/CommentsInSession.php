<?php

namespace Phpmvc\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentsInSession implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
    
    private $key; // id specific for page

    /**
     *  Constructor
     * 
     *  @param $id = specific id from comments array (index value)
     */
    function __construct($id = null) {
        $this->key = $id;
    }
    
    /**
     * Delets a comment from session comment.
     *
     * @return void
     * @param $id = specific id (in array) of comment, $key = specific view from route in index.php
     */
    public function deleteComment($id, $key = null){
        $comments = $this->session->get('comments', []);
        unset($comments[$key][$id]);
        $this->session->set('comments', $comments);
    }
    
    /**
     * Sets a comment to session comment.
     *
     * @return void
     * @param $key = specific view from route in index.php, $comment =  comment (array)
     */
    public function add($comment, $key = null)
    {
        $comments = $this->session->get('comments', []);
        $comments[$key][] = $comment;
        $this->session->set('comments', $comments);
    }



    /**
     * Find and return all comments.
     *
     * @return array with all comments.
     * @param $key = specific view from route in index.php
     */
    public function findAll($key = null)
    {
        $comments =  $this->session->get('comments', []);
        if(isset($comments[$key])){
            return $comments[$key];
        }
        
    }
    
    /**
     * Find and return all comments.
     *
     * @return array with all comments.
     * @param $id = specific id (in array) of comment, $key = specific view from route in index.php
     */
    public function getComment($id, $key){
        $comments =  $this->session->get('comments', []);
        $comment = $comments[$key][$id];
        return $comment;
    }
    
    /**
     * Edits a comment to session comment.
     *
     * @return void
     * @param $id = specific id (in array) of comment, $key = specific view from route in index.php, $comment =  comment (array)
     */
    public function saveComment($comment, $id, $key){
        $comments =  $this->session->get('comments', []);
        $comments[$key][$id] = $comment;
        $this->session->set('comments', $comments);
    }



    /**
     * Delete all comments.
     *
     * @return void
     */
    public function deleteAll()
    {
        $this->session->set('comments', []);
    }
}
