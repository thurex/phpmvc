<?php
namespace Anax\Questions;

/**
 * A controller for users and admin related events
 * 
 */
class QuestionsController implements \Anax\DI\IInjectionAware {
    use \Anax\DI\TInjectable;
    
    /**
     * Initialize the controller
     * 
     *
     * @return void
     */
    public function initialize(){
        $this->questionsDatabase = new \Anax\Questions\QuestionsDatabase();
        $this->questionsDatabase->setDI($this->di);
    }
    
    private function clear(){
        $this->views->add('project/clear', [ 
            'title' => "Frågor", 
            //'questions' => $questions 
        ]); 
    }


    public function showtagAction($tag = null){
        $this->initialize();
        echo "<br>Inide QController: ".$tag;
        //$all = $this->questionsDatabase->find($tag);
        $questions = $this->questionsDatabase->query()
            ->where("tagid = {$tag}")
            //->where("tagid = 1")
            ->execute();
        if ($questions == null){
            $questions = "noTag";
        }
        $this->clear();
        $this->returnQuestions($questions);
        //$this->getQuestionAction($id)
        //$this->returnQuestions($questions);
        /*
        $this->theme->setTitle("Frågor med Tagg "); 
        $this->views->add('project/questions', [ 
            'title' => "Frågor", 
            'questions' => $all 
        ]); 
         * 
         */
    
    }


    /**
     * Get all comments
     * 
     * @return object CommentsDatabase
     */
    public function getAllAction($tag=null){
        $this->initialize();
        $questions = null;
        $tag = $this->di->session->has('currentuser');
        if ($tag==null || $tag == true){
            $questions = $this->questionsDatabase->findAll();
        }
        else {
            $questions = $this->questionsDatabase->query()
            ->where("tagid = {$tag}")
            //->where("tagid = 1")
            ->execute();
            if ($questions == null){
                $questions = "noTag";
            }
        }
        
        //$this->returnQuestions($questions);
        
        $this->theme->setTitle("Frågor"); 
        $this->views->add('project/questions', [ 
            'title' => "Frågor", 
            'questions' => $questions 
        ]); 
    }
    
    private function returnQuestions($questions = null){
        $this->clear();
        $this->theme->setTitle("Frågor"); 
        $this->views->add('project/questions', [ 
            'title' => "Frågor", 
            'questions' => $questions 
        ]); 
    }
    
    public function getQuestionAction($id = null){
        $this->initialize();
        $question = $this->questionsDatabase->find($id);
        $this->theme->setTitle("Frågor med Tagg "); 
        $this->views->add('project/questions', [ 
            'title' => "Frågor", 
            'question' => $question 
        ]); 
        $loggedin = $this->di->session->has('currentuser');
        if ($loggedin == true){
            //include comments
            //*****************
             $this->dispatcher->forward([
            'controller' => 'comment',
            'action'     => 'view',
            'params'     => ['key'=>$question->id,],
            ]);
     
        //Variables to a view
        $this->views->add('comment/form', [
            'mail'      => null,
            'web'       => null,
            'name'      => null,
            'content'   => null,
            'output'    => null,
            'key'       => $question->id //unique name for a view
            ]); 
        }
        
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
    /*
    public function addQuestionDbaseAction($comment, $key, $dbaseid){
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
            $this->questionsDatabase->create($addComment); //here
        }
    }
     * 
     */
    
    /**
     * Edits a comment in database
     * 
     * @param type $comment
     * @param type $dbaseid
     * @param type $key
     * 
     * @return void
     */
    /*
    public function editQuestionDbaseAction($comment, $dbaseid, $key){
        $this->initialize();
        
        $all = $this->questionsDatabase->query()
            ->where('dbaseid = '.$dbaseid)
            ->andWhere("keyid = '".$key."'")
            ->execute();
        $commentDBase = $all[0];
        
        $commentDBase = $this->questionsDatabase->find($all[0]->id);
        $commentDBase->name = $comment['name'];
        $commentDBase->save();
        $commentDBase->content = $comment['content'];        
        $commentDBase->save();
        $commentDBase->web = $comment['web'];
        $commentDBase->save();
        $commentDBase->mail = $comment['mail'];
        $commentDBase->save();
    }
     * 
     */


    /**
     * Delete a comment in database
     * 
     * @param type $dbaseid
     * @param type $key
     * 
     * @return void
     */
    /*
    public function deleteQuestionDbaseAction($dbaseid, $key){
        $this->initialize();
        $all = $this->questionsDatabase->query()
            ->where('dbaseid = '.$dbaseid)
            ->andWhere("keyid = '".$key."'")
            ->execute();
        $res = $this->questionsDatabase->delete($all[0]->id);
        if (!isset($res)){
            die;
        }        
    }
     * 
     */
    
    /**
     * Delets all rows in database
     * 
     * @return void     * 
     */
    /*
    public function setupAction(){
        $this->initialize();
        $this->db->dropTableIfExists('questions')->execute();        
        $this->db->createTable(
            'questions',
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
     * 
     */
    
    /**
     * Delets all rows in database
     * 
     * @return void     * 
     */
    /*
    public function deleteAllQuestionsAction(){
        $this->initialize();
        $this->db->dropTableIfExists('questionsdatabase')->execute();        
        $this->db->createTable(
            'questionsdatabase',
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
     * 
     */
}