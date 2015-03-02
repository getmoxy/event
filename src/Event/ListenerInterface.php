<?php
namespace Moxy\Event;

interface ListenerInterface {

    public function call(\Moxy\EventInterface $event);
}
