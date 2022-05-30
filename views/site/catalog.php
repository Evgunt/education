<?php

foreach ($cats as $cat) {
        ?>
        <a href="<?=app()->route->getUrl('/item').'?id=' . $cat->id.'">'.$cat->title?></a>
        <?php
}
?>
