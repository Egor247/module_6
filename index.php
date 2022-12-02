<?php
$textStorage = array();
$text = [];
$title = [];

function add(&$array_text) : void
{
    if (!empty($_POST)) { 
        $text['text'] = $_POST['text'];
        $title['title'] = $_POST['title'];
        $array_text[] = array_merge($title, $text);     
    } 
}

function remove(&$array_text) : bool
{
    if (!empty($_POST)) {           
        if (isset($_POST['txt_del_num'])) {
            for ($i = 0; $i <= count($array_text); $i++) { 
                if ($_POST['txt_del_num'] == $i) { 
                    unset($array_text[$i]);
                    return true;     
                } else {
                    return false;
                }
            }
        }       
    }
    return true; 
}

function edit(&$array_text) : array
{
    
    if (!empty($_POST)) {   
        if (isset($_POST['txt_edit_index'])) {
            for ($i = 0; $i <= count($array_text); $i++) { 
                if ($_POST['txt_edit_index'] == $i) { 
                    $text['text'] = $_POST['txt_edit_text'];
                    $title['title'] = $_POST['txt_edit_title'];
                    $array_text[$i] = array_merge($title, $text);
                }
            }
        }
    }
    return $array_text;
}

if (isset($_POST)) {
    echo add($textStorage); 
    echo add($textStorage); 
    echo remove($textStorage);
    echo remove($textStorage);
    print_r(edit($textStorage));
    var_dump($textStorage);
}   
     

?>
<html>
    <head>  
        <title><?=!empty($_POST) ? $_POST['title'] : 'The Telegraf'?></title>
    </head>
    <body>
        <form method="post">
            <input name="title" type="input" placeholder="Введите название" value="<?=!empty($_POST) ? $_POST['title'] : '' ?>"><br><br>
            <textarea name="text" type="input" placeholder="Введите текст"><?=!empty($_POST) ? $_POST['text'] : ''?></textarea><br><br>
            <input name="send_button" type="submit" text="send"><br><br><br>
            <?php if(!empty($_POST)) { ?>
                <input name="txt_del_num" type="input" placeholder="Удалить масив номер:">
                 <hr><br>
                 <input name="txt_edit_index" type="input" placeholder="Изменить масив номер:"><br><br>
                 <input name="txt_edit_title" type="input" placeholder="Изменить название:"><br><br>
                 <textarea name="txt_edit_text" type="input" placeholder="Изменить текст:"></textarea><br><br>

            <?php } ?>
           
        </form>
    </body>
</html>