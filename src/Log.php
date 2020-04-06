<?php

namespace Anton;

class Log{
    public $filename = '';

    public $project = '';

    public $data = [];

    public $message = [];

    public function __construct(string $filename){
        $this->filename = $filename.'.json';
    }

    public function setProject(string $project){
        $this->project = $project;
    }

    public function addMessage(array $message){
        $this->message[] = $message;
    }

    public function addData(array $data){
        $this->data[] = $data;
    }

    public function save(){
        if(empty($this->project)){
            die('Log has no Project Name! ('.$this->filename.')');
        }
        exec('mkdir -p storage/logs/'.$this->project);
        file_put_contents($this->filename, jsone_encode([$this->message, $this->data], JSON_FORCE_OBJECT));
    }
    
}