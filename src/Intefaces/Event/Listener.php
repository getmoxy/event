<?php
namespace Moxy\Iface\Event;

interface Listener {

    public function call(\Moxy\Interface\Event $event);
}
