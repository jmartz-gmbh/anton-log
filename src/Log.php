<?php

namespace Anton;

class Log{
    public $filename = '';

    public $project = '';

    public $pipeline = '';

    public $data = [];

    public $message = [];

    public function __construct(string $filename){
        $this->filename = $filename.'.json';
    }

    public function setProject(string $project){
        $this->project = $project;
    }

    public function setPipeline(string $pipeline){
        $this->pipeline = $pipeline;
    }

    public function addMessage(array $message){
        $this->message[] = date('d.m.Y H:i:s').': '.$message;
    }

    public function addData(array $data){
        $this->data[] = $data;
    }

    public function save(){
        if(empty($this->project)){
            die('Log has no Project Name! ('.$this->filename.')');
        }
        if(empty($this->pipeline)){
            die('Log has no Pipeline! ('.$this->project.')');
        }
        exec('mkdir -p storage/logs/'.$this->project);
        file_put_contents($this->filename, jsone_encode([$this->message, $this->data], JSON_FORCE_OBJECT));
    }
    
}