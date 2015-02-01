<hr>

<h2>Kommentarer</h2>

<?php if (is_array($comments)) : ?>
echo "<br> is array";
<div class='comments'>
<?php foreach ($comments as $id => $comment) : ?>

<h4>By <?=$comment['name']?>  <?=$comment['date'];?></h4> 

<?=$comment['content']?><br>




<a href=""  title="mail"><?=$comment['mail']?></a><br>
<a href=""  title="homepage"><?=$comment['web']?></a> 
        <form method="post">
        <input type=hidden name="redirect" value="<?=$this->url->create($this->request->getCurrentUrl())?>">
        <input type="hidden" name="key" value="<?=$key ?>"/>
            <input type='submit' name='doEdit' value='Edit' onClick="this.form.action = '<?=$this->url->create('comment/editView/'.$id)?>'"/>
            <input type='submit' name='doDeleteComment' value='Remove' onClick="this.form.action = '<?=$this->url->create('comment/deleteComment/'.$id)?>'"/>

        </form>
<hr>

<?php endforeach; ?>
</div>
<?php else :
    echo "<br> not array";
?>
<?php endif; ?> 