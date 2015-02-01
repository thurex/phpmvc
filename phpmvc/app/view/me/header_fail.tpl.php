<img class='sitelogo' src='<?=$this->url->asset("img/anax.jpg")?>' alt='Anax Logo'/><?php
if (isset($_SESSION['user'])) { ?>
    <span class='login'><a href='<?=$this->url->create('users/login')?>'>login</a></span>
<?php } 
else { ?>
<span class='login'><a href='<?=$this->url->create('users/login')?>'>login</a></span>
<?php } ?>
<span class='sitetitle'><?=$siteTitle?></span>
<span class='siteslogan'><?=$siteTagline?></span>


