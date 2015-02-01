<link rel="stylesheet" href="/thurexstyles.php">
<hr>

<h2>Simple table</h2>
<p>
    <?php
    $tableContent = array(  array("id", "name", "sir name"),
                            array("1", "Tomas", "Thuresson"),
                            array("2", "Leif", "Thuresson"),
                            array("3", "Åsa", "Blomster"));
    $class = array('wrong_input'=>null, 'styleTable'=>null, 'styleTd'=>null, 'styleTrTh'=>null, 'styleTrOdd'=>'highlight', 'styleTrEven'=>'highlight', 'styleTh'=>null);
    $table = new \Anax\ThurexTable\CSimpleTable($tableContent, 'defaultStyle');
    echo "<h3>Default table: defaultStyle</h3>";
    echo $table->getHTML();
    $table = new \Anax\ThurexTable\CSimpleTable($tableContent, 'greenStyle', $class);
    echo "<h3>Table with color: greenStyle, with css class: highlight</h3>";
    echo $table->getHTML();
    $table = new \Anax\ThurexTable\CSimpleTable($tableContent, 'grayStyle', $class);
    echo "<h3>Table without color: grayStyle, with css class: highlight</h3>";
    echo $table->getHTML();
    
    
    ?>
</p>
