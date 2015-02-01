<link rel="stylesheet" href="kmom04/css/anax-grid/styles.php">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> 

<h1><?=$title?></h1>
<?php if ($type=="show_all"){
     
} ?>
<table>    
<?php if ($type=="show_all"){ ?>
    <tr>
        <th>Användare</th><th>Mail</th><th>Info</th>
    </tr>
<?php foreach ($users as $user) : 
    if(!(isset($user->deleted))){?>
    <tr>
        <td><?=$user->acronym ?></td>
        <td><?=$user->email ?></td>
        <?php echo"<td><a href='id/$user->id'><i class='fa fa-beer'></i></a></td>";?>
    </tr>
    <?php } endforeach; ?>
</table>
<?php }
else { ?>
    <tr>
        <th>Användare</th><th>Mail</th><th>Info</th>
    </tr>
    <?php foreach ($users as $user) : 
    if(isset($user->deleted)){?>
    
    <tr>
        <td><?=$user->acronym ?></td>
        <td><?=$user->email ?></td>
        <?php if(isset($user->deleted)){echo"<td><a href='delete/$user->id'><i class='fa fa-circle-thin'></i></a></td>";} ?>
        <?php if(isset($user->deleted)){ echo"<td><a href='softDelete/$user->id'><i class='fa fa-circle-thin'></i></a></td>";} ?>
        <?php echo"<td><a href='editUser/$user->id'><i class='fa fa-edit'></i></a></td>";?>
        <?php echo"<td><a href='id/$user->id'><i class='fa fa-beer'></i></a></td>";?>
    </tr>
    <?php } endforeach; ?>
</table>
<?php } ?>

