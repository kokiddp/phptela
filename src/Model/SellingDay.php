<?php

namespace KokiDDP\PHPTela\Model;

class SellingDay {
  public \DateTimeInterface $day;
  /** @var SellingSlot[] */
  public array $sellingSlots = [];
  
  public function __construct(array $data)
  {
    $this->day = \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $data['day']);
    $this->sellingSlots = array_map(fn($dataSlot) => new SellingSlot($dataSlot), isset($data['sellingSlots']) && $data['sellingSlots'] ? $data['sellingSlots'] : []);
  }
}
