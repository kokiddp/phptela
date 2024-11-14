<?php

namespace KokiDDP\PHPTela\Model;

use KokiDDP\PHPTela\Model\DeskUser;

class User {
  public string $name;
  public string $surname;
  public string $email;
  public string $userId;
  public bool $superUser;
  public DeskUser $deskuser;

  public function __construct(array $data)
  {
    $this->name = $data['name'];
    $this->surname = $data['surname'];
    $this->email = $data['email'];
    $this->userId = $data['userId'];
    $this->superUser = $data['superUser'];
    $this->deskuser = new DeskUser($data['deskUser']);
  }
}
