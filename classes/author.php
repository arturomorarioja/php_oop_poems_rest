<?php

class Author 
{
    private string $name;
    private string $dir;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->dir = __DIR__ . '/../poems/' . $this->name;
    }
    
    public function getInfo(): array
    {
        $infoFile = $this->dir . '/.info.json';
        return json_decode(file_get_contents($infoFile), true);
    } 

    public function getPoems(): array
    {
        $poems = scandir($this->dir);
        $poems = array_splice($poems, 3);
        $poems = array_map(function($poemFileName) {
            return substr($poemFileName, 0, strlen($poemFileName) - 5);
        }, $poems);
        return $poems;
    }
}