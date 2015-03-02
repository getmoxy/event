<?php
namespace Moxy;

class Event implements EventInterface {

    public function __construct($data) 
    {
        $this->data = $data;
    }
}
