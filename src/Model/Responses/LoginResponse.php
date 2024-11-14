<?php

namespace KokiDDP\PHPTela\Model\Responses;

use KokiDDP\PHPTela\Model\User;

class LoginResponse extends BaseResponse
{
  private ?User $user;

  public function __construct(string $status, ?User $user, ?string $message = null) {
    parent::__construct($status, $message);

    if ($status == 'err') {
      $this->user = null;
      return;
    }
    if ($user == null) {
      $this->user = null;
      return;
    }
    $this->user = $user;
  }

  /**
   * Get the user.
   *
   * @return User
   */
  public function get(): ?User
  {
    return $this->user;
  }
}
