<?php
foreach ($result as $item)
{
    ?>
    <a href="<?=app()->route->getUrl('/item').'?id=' . $item->id.'">'.$item->title?></a>
    <?php
}