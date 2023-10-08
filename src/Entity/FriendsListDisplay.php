<?php

namespace App\Entity;


use App\Entity\FriendCreator;

class FriendFriendListDisplay
{

    public $id;
    public $name;
    public $status;
    public function __construct($id, $name, $status) {
        $this -> id = $id;
        $this -> name = $name;
        $this -> status = $status;

    }

    public function getInfo() {
        return $this->id;
    }
}