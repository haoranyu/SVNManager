<?php foreach($list as $key => $value):?>
    <ul>
        <li>
            <?php if($value['type'] == '/'):?>
                <span><a href="./<?=$key?>/"><?=$key?></a></span>
            <?php else:?>
                <span><a href="#"><?=$key?></a></span>
            <?php endif;?>
            <span><strong>Author</strong> <?=$value['author']?></span>
            <span><strong>Date</strong> <?=$value['date']?></span>
            <span><strong>Revision</strong> <?=$value['author']?></span>
            <span><strong>Type</strong> <?=$value['type']?></span>
        </li>
    </ul>
<?php endforeach;?>
