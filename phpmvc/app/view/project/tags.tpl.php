<article class="article1">
    <h1>Taggs</h1>

<?php foreach ($tags as $tag) : ?>
    <?php echo"<td><a href='tagid/$tag->id'>$tag->tagname</a></td>";?>
    
    <?php  endforeach; ?>
 
</article> 