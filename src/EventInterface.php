<?php
namespace Moxy;

interface EventInterface {

    public function __construct($name, $data);
    public function __get($name);
}
