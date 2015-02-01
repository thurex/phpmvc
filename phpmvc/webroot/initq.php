<?php
$app->theme->setTitle("Initierar questions");
    
    //$app->db->setVerbose();
 
    $app->db->dropTableIfExists('questionsdatabase')->execute();
 
    $app->db->createTable(
            //QUESTION table
        'questionsdatabase',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'userid' => ['integer', 'not null'],
            'tagid' => ['integer', 'not null'],
            'qname' => ['varchar(200)'],
            'qtext' => ['text'],
            'created' => ['datetime'],
        ]
    )->execute();
    
        $app->db->insert(
        'questionsdatabase',
        ['userid', 'tagid', 'qname', 'qtext', 'created']
    );
 
    $now = gmdate('Y-m-d H:i:s');
 
    $app->db->execute([
        '1',
        '1',
        'Finns fia med knuff utan knuff?',
        'Min kompis påstår att man kan spela fia utan att knuffas å bråkas, stämmer det?',
        $now
    ]);
 
    $app->db->execute([
        '1',
        '2',
        'Finns line of sight genom smutsiga fönster',
        'Borde bli avdrag om en squad försöker sig på defensive fire genom en smutsig fönsterruta?',
        $now
    ]);
    
    $app->db->dropTableIfExists('tags')->execute();
    
    $app->db->createTable(
            //TAGS table
        'tags',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'tagname' => ['varchar(200)'],
        ]
    )->execute();
    
        $app->db->insert(
        'tags',
        ['tagname']
    );
    
    $app->db->execute([
        'Familjespel'
    ]);
    
    $app->db->execute([
        'Blippspel'
    ]);
    
    $app->db->execute([
        'Rollspel'
    ]);
    
    $app->db->execute([
        'Taktiska'
    ]);
    
    //COMMENTS
    $app->db->dropTableIfExists('commentsdatabase')->execute();
    
    $app->db->createTable(
            //COMMENTS table
        'commentsdatabase',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'dbaseid' => ['integer'],
            'name' => ['varchar(80)'],
            'web' => ['varchar(80)'],
            'content' => ['text'],
            'mail' => ['varchar(80)'],
            'timestamp' => ['datetime'],
            'keyid' => ['varchar(80)'],
        ]
    )->execute();
    
    $app->db->dropTableIfExists('user')->execute();
 
        $app->db->createTable('user', [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'acronym' => ['varchar(20)', 'unique', 'not null'],
                'email' => ['varchar(80)'],
                'name' => ['varchar(80)'],
                'password' => ['varchar(255)'],
                'created' => ['datetime'],
                'updated' => ['datetime'],
                'deleted' => ['datetime'],
                'active' => ['datetime'],
                'gravatar' => ['varchar(80)']
            ]
        )->execute();

        // Adds two test users
        $app->db->insert('user', [
            'acronym', 'email', 'name', 'password', 'created', 'active']
        );
        
        

        $now = date(DATE_RFC2822);
        
        $now = gmdate('Y-m-d H:i:s');
     
        $app->db->execute([
            'admin',
            'admin@dbwebb.se',
            'Administrator',
            password_hash('admin', PASSWORD_DEFAULT),
            $now,
            $now
        ]);