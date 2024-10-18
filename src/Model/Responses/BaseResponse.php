<?php

namespace KokiDDP\PHPTela\Model\Responses;

class BaseResponse
{
  private string $status;
  private ?string $message;
  
  public function __construct(string $status, ?string $message = null)
  {
    $this->status = $status;
    $this->message = $message;
  }

  public function getStatus(): string
  {
    return $this->status;
  }

  public function getMessage(): ?string
  {
    return $this->message;
  }
}