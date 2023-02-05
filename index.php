<?php

     
class TelegraphText
{
    public $title, $text, $author, $published, $textStorage = [];
    public static $slug = 'array.txt';

    public function __construct($author, $published)
    {
        $this->author = $author;
        $this->published = date("Y-m-d H:i:s");
    }

    public function storeText(&$author, &$title, &$text, $slug, $published, &$textStorage)
    {
        $textStorage = ['title' => $title, 'text' => $text, 'author' => $author, 'published' => $published];
        $data = serialize($textStorage);
        file_put_contents($slug, $data);

    }

    public function loadText(&$author, &$title, &$text, $slug, $published) 
    {
        if (filesize(__DIR__ .'/array.txt') > 0) {
            $data = file_get_contents($slug);
            $readingFile = unserialize($data);
            print_r($readingFile);
        }
        return $text;
     
       
    }

    public function editText(&$author, &$title, &$text, $slug, $published, &$textStorage)
    {
        if(isset($_POST['txt_edit_title']) && isset($_POST['txt_edit_text'])) {
             $textStorage = ['title' => $_POST['txt_edit_title'], 'text' => $_POST['txt_edit_text'], 'author' => $author, 'published' => $published];
             $data = serialize($textStorage);
             file_put_contents($slug, $data);
        }    
    }
}



if(!empty($_POST)){
    $textStorage = [];
    $telegrahpText = new TelegraphText($_POST['author_name'], date("Y-m-d H:i:s"));
    $telegrahpText -> storeText($_POST['author_name'], $_POST['title'], $_POST['text'], __DIR__ .'/array.txt', date("Y-m-d H:i:s"), $textStorage);
    $telegrahpText -> editText($_POST['author_name'], $_POST['txt_edit_title'], $_POST['txt_edit_text'], __DIR__ .'/array.txt', date("Y-m-d H:i:s"), $textStorage);
    
    var_dump($textStorage);
    $telegrahpText -> loadText($_POST['author_name'], $_POST['title'], $_POST['text'], __DIR__ .'/array.txt', date("Y-m-d H:i:s"));

}

    
    



?>
<html>
    <head>  
        <title><?=!empty($_POST) ? $_POST['title'] : 'The Telegraf'?></title>
    </head>
    <body>
        <form method="post">
            <input name="title" type="input" placeholder="Введите название" value="<?=!empty($_POST) ? $_POST['title'] : '' ?>"><br><br>
            <input name="author_name" type="input" placeholder="Имя автора" value="<?=!empty($_POST) ? $_POST['author_name'] : '' ?>"><br><br>
            <textarea name="text" type="input" placeholder="Введите текст"><?=!empty($_POST) ? $_POST['text'] : ''?></textarea><br><br>
            <input name="send_button" type="submit" text="send"><br><br><br>
            <?php if(!empty($_POST)) { ?>
                <input name="txt_edit_title" type="input" placeholder="Изменить название:" value="<?=!empty($_POST) ? $_POST['txt_edit_title'] : ''?>"><br><br>
                 <textarea name="txt_edit_text" type="input" placeholder="Изменить текст:"><?=!empty($_POST) ? $_POST['txt_edit_text'] : '' ?></textarea><br><br>

            <?php } ?>
           
        </form>
    </body>
</html>