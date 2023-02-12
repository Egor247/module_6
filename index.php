<?php
class TelegraphText
{
    public $title, $text, $author, $published, $textStorage = [];
    public $slug = 'array.txt';


    public function __construct($author, $slug)
    {
        $published = date("Y-m-d H:i:s");
        $this->published = new dateTime($published);
        $this->author = $author;
        $this->slug = $slug;


    }

    public function storeText($author, $title, $text, $slug, $published, &$textStorage)
    {
        $textStorage = ['title' => $title, 'text' => $text, 'author' => $author, 'published' => $published];
        $data = serialize($textStorage);
        file_put_contents($slug, $data);

    }

    public function loadText($text, $slug)
    {
        if (filesize($slug) > 0) {
            $data = file_get_contents($slug);
            $readingFile = unserialize($data);
            print_r($readingFile);
        }
        return $text;
     
       
    }
    
    public function editText($title, $text, $slug, &$textStorage)
    {
        $textStorage['title'] = $title;
        $textStorage['text'] = $text;
        $data = serialize($textStorage);
        file_put_contents($slug, $data);
    }
}

 
$authorName = readline('Введите имя автора:');
$title = readline("Введите название:");
$text = readline("Введите текст:");
$textStorage = [];
$telegraphText = new TelegraphText($authorName, 'array.txt');
$telegraphText -> storeText($authorName, $title, $text,  __DIR__.'/array.txt', date("Y-m-d H:i:s"), $textStorage);
$editTitle = readline("Введите новый заголовок:");
$editText = readline("Введите изменённый текст:");
$telegraphText -> editText($editTitle, $editText, __DIR__.'/array.txt', $textStorage);

var_dump($textStorage);
$telegraphText -> loadText($authorName, __DIR__.'/array.txt');
