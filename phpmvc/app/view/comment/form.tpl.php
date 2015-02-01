<div class='row'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->url->create($this->request->getCurrentUrl())?>">
        <input type=hidden name="redirect" value="<?= $this->url->create($key) ?>">
        <input type="hidden" name="key" value="<?=$key ?>"/>
        <fieldset>
        <legend>Lämna ett meddelande</legend>
        <p><label>Kommentar:<br/><textarea name='content'><?=$content?></textarea></label></p>
        <p><label>Namn:<br/><input type='text' name='name' value='<?=$name?>'/></label></p>
        <p><label>Hemsida:<br/><input type='text' name='web' value='<?=$web?>'/></label></p>
        <p><label>Email:<br/><input type='text' name='mail' value='<?=$mail?>'/></label></p>
        <p class=buttons>
            <input type='submit' name='doCreate' value='Kommentera' onClick="this.form.action = '<?=$this->url->create('comment/add')?>'"/>
            <input type='reset' value='Rensa fält'/>
            <input type='submit' name='doRemoveAll' value='Rensa alla kommentarer' onClick="this.form.action = '<?=$this->url->create('comment/removeAll')?>'"/>
        </p>
        </fieldset>
    </form>
</div>