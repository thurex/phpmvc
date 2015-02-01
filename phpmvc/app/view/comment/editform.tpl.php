<div class='row'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->url->create($this->request->getCurrentUrl())?>">
        <input type=hidden name="redirect" value="<?= $this->url->create($key) ?>">
        <input type="hidden" name="key" value="<?=$key ?>"/>
        <input type="hidden" name="commentId" value="<?=$id?>"/>
        <fieldset>
        <legend>Ändra kommentaren med id: <?=$id +1?></legend>
        <p><label>Comment:<br/><textarea name='content'><?=$content?></textarea></label></p>
        <p><label>Name:<br/><input type='text' name='name' value='<?=$name?>'/></label></p>
        <p><label>Homepage:<br/><input type='text' name='web' value='<?=$web?>'/></label></p>
        <p><label>Email:<br/><input type='text' name='mail' value='<?=$mail?>'/></label></p>
        <p class=buttons>
            <input type='submit' name='doSave' value='Save' onClick="this.form.action = '<?=$this->url->create('comment/save')?>'"/>
            <input type='reset' value='Reset'/>
            <input type='submit' name='doRemoveAll' value='Remove all' onClick="this.form.action = '<?=$this->url->create('comment/remove-all')?>'"/>
        </p>
        </fieldset>
    </form>
</div>