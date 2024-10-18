<?php

namespace KokiDDP\PHPTela\Model;

class Ticket
{
  public string $type;
  public float $price;
  public bool $valid;
  public ?string $typeId;

  public function __construct(array $data)
  {
    $this->type = $data['type'];
    $this->price = (float)$data['price'];
    $this->valid = $data['valid'] ?? false;
    $this->typeId = $data['typeId'] ?? null;
  }
}
