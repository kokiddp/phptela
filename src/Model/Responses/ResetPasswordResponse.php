<?php

namespace KokiDDP\PHPTela\Model\Responses;

class ResetPasswordResponse extends BaseResponse
{
  public function __construct(string $status, ?string $message = null) {
    parent::__construct($status, $message);
  }
}
