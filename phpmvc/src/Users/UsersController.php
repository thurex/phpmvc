<?php
namespace Anax\Users;

/**
 * A controller for users and admin related events
 * 
 */
class UsersController implements \Anax\DI\IInjectionAware {
    use \Anax\DI\TInjectable;
    
    /**
     * Initialize the controller
     * 
     *
     * @return void
     */
    public function initialize(){
        $this->users = new \Anax\Users\User();
        $this->users->setDI($this->di);
    }
    
    /**
     * List all users
     * 
     * @param type of call (trashcan or regualar "show_all")
     * @return void
     */
    public function listAction($type = null) {
        $this->users = new \Anax\Users\User();
        $this->users->setDI($this->di);
        
        $all = $this->users->findAll();
        
        if ($type!=null){
            $type = "deleted";
        }
        else {
            $type = "show_all";
        }
        
        $this->theme->setTitle("List all users");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Användare",   
            'type'  => $type,
        ]);
    }
    
    public function logoutAction(){
        $this->session->clear('currentuser');
        $this->views->add('users/logout', [
            'title' => "Utloggad",  
        ]);
    }
    
    public function loginAction(){
        $form = $this->form; 
        
        //Set form
        $form = $form->create([], [ 
            'acronym' => [ 
                'type'        => 'text', 
                'label'       => 'Acronym', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
                'class' => 'form-control',
            ], 
            'password' => [ 
                'type'        => 'password', 
                'label'       => 'Password', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
                    'class' => 'form-control',
            ],
        'submit' => [ 
                'type'      => 'submit', 
                'class' => 'btn btn-lg btn-success pull-left',
                'Value' => 'Uppdatera',
                'callback'  => function($form) { 

                    $now = date(DATE_RFC2822); 
                    $now = gmdate('Y-m-d H:i:s');
                    /*
                    //Save to database              
                    $this->users->save([ 
                        'acronym'     => $form->Value('acronym'), 
                        'email'     => $form->Value('email'), 
                        'name'         => $form->Value('name'), 
                        'password'     => password_hash($form->Value('password'), PASSWORD_BCRYPT), 
                        'created'     => $now, 
                        'active'     => $now, 
                    ]); 
                     * 
                     */

                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
            echo "<br>Form ok!";
            $acronym = $form->Value('acronym');
            $password = $form->Value('password');
            //$this->checkInlogg();
            $signin = null;
            
            $signin = $this->users->query()
                //->where("acronym = {$acronym}")
                ->where("acronym = '{$acronym}'")
                //->where("tagid = 1")
                //->andwhere("password = {$password}")
                ->execute();
            if ($signin != null){
                $this->session->clear('currentuser'); 
                $this->session->set('currentuser', [
                'id' => $signin[0]->id,
                'acronym' => $signin[0]->acronym,
                'email' => $signin[0]->email,
                'name' => $signin[0]->name,
                'created' => $signin[0]->created
                ]);
            }
            
            $url = $this->url->create('users/id/' . $signin[0]->id); 
            $this->response->redirect($url); 
         
        } else if ($status === false) { 
         
            // What to do when form could not be processed? 
            $form->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>"); 
            header("Location: " . $_SERVER['PHP_SELF']); 
        } 

        $this->theme->setTitle("Logga in"); 
        $this->views->add('users/form', [ 
            'title' => "<h3><i class='fa fa-plus-square'></i>Logga in</h3>", 
            'form' => $form->getHTML() 
        ]); 
    }
    
    private function checkInlogg(){
        echo "<br> Inside inlogg";
        
    }

        /**
     * Show softdeleted users
     * 
     * @return void
     */
    public function trashcanAction(){
        
        $this->initialize();
        $all = $this->users->query()
            ->where('deleted is NOT NULL')
            ->execute();
        $this->theme->setTitle("Papperskorgen");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Papperskorgen",   
            'type'  => "deleted",
        ]);
    }
    
    /**
     * Activate a user
     * 
     * 
     * @param int $id of user to activate
     * @return void
     */
    public function activateAction($id = null){        
        $now = date(DATE_RFC2822);
        $now = gmdate('Y-m-d H:i:s');

        $user = $this->users->find($id);
        try {
            if(isset($user->active))
            {
              $user->active = null;
            }
            else 
            {
                $user->active = $now;
            }
        } catch (Exception $ex) {

        }
        

        $user->save();
        $url = $this->url->create('users/list');
        $this->response->redirect($url);     
        $this->listAction();        
    }
    
    /**
     * Setup database for test purposes
     *
     */
    public function setupAction(){

        $this->db->dropTableIfExists('user')->execute();
 
        $this->db->createTable('user', [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'acronym' => ['varchar(20)', 'unique', 'not null'],
                'email' => ['varchar(80)'],
                'name' => ['varchar(80)'],
                'password' => ['varchar(255)'],
                'created' => ['datetime'],
                'updated' => ['datetime'],
                'deleted' => ['datetime'],
                'active' => ['datetime'],
            ]
        )->execute();

        // Adds two test users
        $this->db->insert('user', [
            'acronym', 'email', 'name', 'password', 'created', 'active']
        );
        
        

        $now = date(DATE_RFC2822);
        
        $now = gmdate('Y-m-d H:i:s');
     
        $this->db->execute([
            'admin',
            'admin@dbwebb.se',
            'Administrator',
            password_hash('admin', PASSWORD_DEFAULT),
            $now,
            $now
        ]);
     
        $this->db->execute([
            'doe',
            'doe@dbwebb.se',
            'John/Jane Doe',
            password_hash('doe', PASSWORD_DEFAULT),
            $now,
            $now
        ]);
        
        $this->db->execute([
            'thurex',
            'thure@dbwebb.se',
            'Tompa Tompasson',
            password_hash('doe', PASSWORD_DEFAULT),
            $now,
            $now
        ]);

        $url = $this->url->create('users/list');
        $this->response->redirect($url);     
    }
    
    
    /**
    * List all active and not deleted users.
    *
    * @return void
    */
    public function activeAction()
    {
        $all = $this->users->query()
            ->where('active IS NOT NULL')
            ->andWhere('deleted is NULL')
            ->execute();

        $this->theme->setTitle("Aktiva användare");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Aktiva användare",
            'type'  => "show_all",
        ]);
    }
    
    /**
     * List user with id
     * 
     * @param int $id of user to display
     * 
     *
     * @return void
     */
    public function idAction($id = null){
        $this->users = new \Anax\Users\User();
        $this->users->setDI($this->di);

        $user = $this->users->find($id);

        $this->theme->setTitle("View user with id");
        $this->views->add('users/view', [
            'user' => $user,
        ]);
    }
    
    /**
     * Delete (soft) user
     * 
     *
     * @param integer $id of user to delete.
     *
     * @return void
     */
    public function softDeleteAction($id = null){
        if (!isset($id)) {
            die("Missing id");
        }

        $now = date(DATE_RFC2822);
        
        $now = gmdate('Y-m-d H:i:s');

        $user = $this->users->find($id);
        $reset = true;
        
        if (!isset($now)) {
            die("Missing now");
        }
        if (!isset($user)) {
            die("Missing user");
        }
        if (isset($user->deleted)){
            $user->deleted = null;  
            $reset = false;
        }
        else {
            $user->deleted = $now;
        }

        $user->save();
        
        if ($reset==true){ //show all users
            $url = $this->url->create('users/list');
            $this->response->redirect($url);   
            $this->listAction();
        }
        else { //show trashcan
            $url = $this->url->create('users/trashcan');
            $this->response->redirect($url);  
        }        
    } 
    
    /**
     * Delete user.
     *
     * @param integer $id of user to delete
     * 
     *
     * @return void
     */
    public function deleteAction($id = null){
        if (!isset($id)) {
            die("Missing id");
        }

        $res = $this->users->delete($id);
        
        $url = $this->url->create('users/trashcan'); //show trashcan
        $this->response->redirect($url);  
    }
    
    public function profileAction() {
        $loggedin = $this->di->session->get('currentuser');
        $this->editUserAction($loggedin['id']);
    } 
    
    /**
     * Edit user.
     *
     * @param integer $id of user to edit
     * 
     *
     * @return void
     */
    public function editUserAction($id = null){
        $loggedin = $this->di->session->get('currentuser');
        if ($loggedin['id']==$id){
        $form = $this->form; 

        $user = $this->users->find($id); 

        $form = $form->create([], [ 
            'acronym' => [ 
                'type'        => 'text', 
                'label'       => 'Acronym', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
                'value' => $user->acronym, 
                'class' => 'form-control'
            ], 
            'name' => [ 
                'type'          => 'text', 
                'label'         => 'Name', 
                'required'      => true, 
                'validation'    => ['not_empty'], 
                'value'         => $user->name, 
                'class' => 'form-control'
            ], 
            'email' => [ 
                'type'          => 'text', 
                'required'      => true, 
                'validation'    => ['not_empty', 'email_adress'], 
                'value'         => $user->email, 
                'class'         => 'form-control'
            ], 
            'submit' => [ 
                'type'      => 'submit', 
                //'class' => 'col-md-offset-11 btn btn-success btn-lg',
                'value' => 'Uppdatera',
                'callback'  => function($form) use ($user) { 

                    $now = date(DATE_RFC2822); 
                    $now = gmdate('Y-m-d H:i:s');
                    $this->users->save([ 
                        'id'        => $user->id, 
                        'acronym'     => $form->Value('acronym'), 
                        'email'     => $form->Value('email'), 
                        'name'         => $form->Value('name'), 
                        'updated'     => $now, 
                        'active'     => $now, 
                    ]); 

                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) {             
            $url = $this->url->create('users/id/' . $user->id); 
            $this->response->redirect($url); 
         
        } else if ($status === false) { 
            header("Location: " . $_SERVER['PHP_SELF']); 
            echo "ERROR!";
            exit; 
        } 

        $this->theme->setTitle("Uppdatera användare"); 
        $this->views->add('users/form', [ 
            'title' => "Uppdatera användare", 
            'form' => $form->getHTML() 
        ]); 
    }
    }
    
    /**
     * Add new user
     * 
     *
     * @param string $acronym of user to add.
     *
     * @return void
     */    
    public function addAction()  
    { 
        $form = $this->form; 
        
        //Set form
        $form = $form->create([], [ 
            'acronym' => [ 
                'type'        => 'text', 
                'label'       => 'Acronym', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
                'class' => 'form-control',
            ], 
            'password' => [ 
                'type'        => 'password', 
                'label'       => 'Password', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
                    'class' => 'form-control',
            ], 
            'name' => [ 
                'type'        => 'text', 
                'label'       => 'Name', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
                    'class' => 'form-control',
            ], 
            'email' => [ 
                'type'        => 'text', 
                'required'    => true, 
                'validation'  => ['not_empty', 'email_adress'], 
                    'class' => 'form-control',
            ], 
            'submit' => [ 
                'type'      => 'submit', 
                'class' => 'btn btn-lg btn-success pull-left',
                'Value' => 'Uppdatera',
                'callback'  => function($form) { 

                    $now = date(DATE_RFC2822); 
                    $now = gmdate('Y-m-d H:i:s');
                    
                    //Save to database              
                    $this->users->save([ 
                        'acronym'     => $form->Value('acronym'), 
                        'email'     => $form->Value('email'), 
                        'name'         => $form->Value('name'), 
                        'password'     => password_hash($form->Value('password'), PASSWORD_BCRYPT), 
                        'created'     => $now, 
                        'active'     => $now, 
                    ]); 

                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
          
            $url = $this->url->create('users/id/' . $this->users->id); 
            $this->response->redirect($url); 
         
        } else if ($status === false) { 
         
            // What to do when form could not be processed? 
            $form->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>"); 
            header("Location: " . $_SERVER['PHP_SELF']); 
        } 

        $this->theme->setTitle("Lägg till användare"); 
        $this->views->add('users/form', [ 
            'title' => "<h3><i class='fa fa-plus-square'></i>Lägg till användare</h3>", 
            'form' => $form->getHTML() 
        ]); 
    }
    
}