<?php
namespace Anax\Comments;

/**
 * A controller for users and admin related events
 * 
 */
class CommentsDbaseController implements \Anax\DI\IInjectionAware {
    use \Anax\DI\TInjectable;
    
    /**
     * Initialize the controller
     * 
     *
     * @return void
     */
    public function initialize(){
        $this->commentsDatabase = new \Anax\Comments\CommentsDatabase();
        $this->commentsDatabase->setDI($this->di);
    }
    
    /**
     * Get all comments
     * 
     * @return object CommentsDatabase
     */
    public function getAllAction(){
        $this->initialize();
        $all = $this->commentsDatabase->findAll();
        return $all;
    }
    
    /**
     * Adds a comment to database
     * 
     * @param type $comment, object of Comment
     * @param type $key, String URL
     * @param type $dbaseid, same id as CommentSession[]
     * 
     * @return void
     */
    public function addCommentDbaseAction($comment, $key, $dbaseid){
        if (isset($comment)){
            $this->initialize();
            $now = date(DATE_RFC2822);
            $now = gmdate('Y-m-d H:i:s'); 
            $addComment = [
                'dbaseid'   => $dbaseid,
                'name'      => $comment['name'],
                'web'       => $comment['web'],
                'content'   => $comment['content'],
                'mail'      => $comment['mail'],
                'timestamp' => $now,
                'keyid'     => $key,
        ];
            $this->commentsDatabase->create($addComment); //here
        }
    }
    
    /**
     * Edits a comment in database
     * 
     * @param type $comment
     * @param type $dbaseid
     * @param type $key
     * 
     * @return void
     */
    public function editCommentDbaseAction($comment, $dbaseid, $key){
        $this->initialize();
        
        $all = $this->commentsDatabase->query()
            ->where('dbaseid = '.$dbaseid)
            ->andWhere("keyid = '".$key."'")
            ->execute();
        $commentDBase = $all[0];
        
        $commentDBase = $this->commentsDatabase->find($all[0]->id);
        $commentDBase->name = $comment['name'];
        $commentDBase->save();
        $commentDBase->content = $comment['content'];        
        $commentDBase->save();
        $commentDBase->web = $comment['web'];
        $commentDBase->save();
        $commentDBase->mail = $comment['mail'];
        $commentDBase->save();
    }


    /**
     * Delete a comment in database
     * 
     * @param type $dbaseid
     * @param type $key
     * 
     * @return void
     */
    public function deleteCommentDbaseAction($dbaseid, $key){
        $this->initialize();
        $all = $this->commentsDatabase->query()
            ->where('dbaseid = '.$dbaseid)
            ->andWhere("keyid = '".$key."'")
            ->execute();
        $res = $this->commentsDatabase->delete($all[0]->id);
        if (!isset($res)){
            die;
        }        
    }
    
    /**
     * Delets all rows in database
     * 
     * @return void     * 
     */
    public function deleteAllCommentsAction(){
        $this->initialize();
        $this->db->dropTableIfExists('commentsdatabase')->execute();        
        $this->db->createTable(
            'commentsdatabase',
            [
                'id'        => ['integer', 'primary key', 'not null', 'auto_increment'],
                'dbaseid'   => ['integer'],
                'name'      => ['varchar(80)'],
                'web'       => ['varchar(80)'],
                'content'   => ['text'],
                'mail'      => ['varchar(80)'],
                'timestamp' => ['datetime'],
                'keyid'       => ['varchar(80)'],
            ]
        )->execute();
    }
}