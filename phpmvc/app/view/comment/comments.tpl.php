<hr>

<h2>Kommentarer</h2>
<?php //$page_id = str_replace(array('/'), '',$this->url->getPage());?>

<?php if (is_array($comments)) : ?>
<div class='comments'>
    
<?php foreach ($comments as $id => $comment) : ?>
    

<h4>#<?=$id+1?> från <?=$comment['name']?> | <?=$comment['timestamp']?></h4> 

<?=$comment['content']?><br>




<a href=""  title="mail"><?=$comment['mail']?></a><br>
<a href=""  title="homepage"><?=$comment['web']?></a> 
        <form method="post">
        <input type=hidden name="redirect" value="<?=$this->url->create($this->request->getCurrentUrl())?>">
        <input type="hidden" name="key" value="<?=$key ?>"/>
        <input type="hidden" name="commentId" value="<?=$id ?>"/>
            <input type='submit' name='doEdit' value='Edit' onClick="this.form.action = '<?=$this->url->create('comment/editView/')?>'"/>
            <input type='submit' name='doDeleteComment' value='Remove' onClick="this.form.action = '<?=$this->url->create('comment/deleteComment')?>'"/>
            

        </form>
<hr>

<?php endforeach; ?>
</div>
<?php else :
?>
<?php endif; ?> 