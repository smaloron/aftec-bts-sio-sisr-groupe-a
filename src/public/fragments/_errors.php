<?php if(count($errors) > 0): ?>
        <h3>Veuillez corriger les erreurs suivantes : </h3>
        <ul>
            <?php foreach($errors as $item): ?>
                <li> <?=$item ?> </li>
            <?php endforeach ?>
        </ul>
<?php endif ?>