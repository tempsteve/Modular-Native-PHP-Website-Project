<?php if (isset($errors) && count($errors) > 0) : ?>
    <font color='red'>
    <p>表單填寫錯誤：</p>
        <ul>
            <?php foreach ($errors as $key => $error) : ?>
                <?php if (is_array($error)) : ?>
                    <?php foreach ($error as $i => $value) : ?>
                        <li><?=$value?></li>
                    <?php endforeach ?>
                <?php else : ?>
                    <li><?=$error?></li>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
    </font>
<?php endif ?>
