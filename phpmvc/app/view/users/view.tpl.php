<link rel="stylesheet" href="kmom04/css/anax-grid/styles.php">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<?php
$loggedin = $this->di->session->get('currentuser');
?>

<div>
    <h1><?=$user->acronym?></h1>
    <?=$user->name?> 
    <h3><?=$user->email?></h3> 
    <h4>Skapad: <?=$user->created?></h4> 
<?php 
if ($loggedin['id']==$user->id){ 
    ?>
    <p><a href='<?=$this->url->create("users/editUser/$user->id")?>'>Ändra profil</a></p> 
<?php } ?>
</div>