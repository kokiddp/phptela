<?php

namespace KokiDDP\PHPTela\Model;

class Settings
{
  public bool $enableGuestPurchase;
  public int $maxPurchasable;

  public function __construct(array $data)
  {
    $this->enableGuestPurchase = $data['enableGuestPurchase'];
    $this->maxPurchasable = $data['maxPurchasable'];
  }
}
