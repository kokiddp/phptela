<?php

namespace KokiDDP\PHPTela\Model;

class Location
{
  public string $type;  
  /** @var float[] */
  public array $coordinates;

  public function __construct(array $data)
  {
    $this->type = $data['type'];
    $this->coordinates = $data['coordinates'];
  }
}
