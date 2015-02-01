<article class="article1">
    <h1>Frågor</h1>
<?php
//$user = $this->di->session->get('currentuser');
//print_r($this->user);
    if (isset($questions)) {
        if ($questions=="noTag"){
            ?><p>Inga frågor passar taggen</p>
            <?php
        }
        else {
            foreach ($questions as $question) : ?>
                <table>
                <tr>
                    <?php echo"<td><a href='getquestion/$question->id'><h2>$question->qname</h2></a></td>";?>
                </tr>
                <tr>
                    <td><i><?=$question->qtext ?></i></td>
                </tr>
                </table>
            <?php endforeach;
        }
    }
    else if(isset ($question)){ ?>
        <h2><?=$question->qname ?></h2>
        <h3><?=$question->qtext ?></h3>
        <i><?=$question->created ?> || <?php /*$question->userid*/ ?></i>
        
    <?php }
    ?>

    <?php if(isset($byline)) : ?>
        <footer class="byline">
            <?=$byline?>
        </footer>
    <?php endif; ?>
 
</article> 