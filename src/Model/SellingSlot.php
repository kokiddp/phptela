<?php

namespace KokiDDP\PHPTela\Model;

class SellingSlot {
  public \DateTimeInterface $startSlot;
  public \DateTimeInterface $endSlot;
  public string $slotId;
  public int $numTickets;
  
  public function __construct(array $data)
  {
    $this->startSlot = \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $data['start_slot']);
    $this->endSlot = \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $data['end_slot']);
    $this->slotId = $data['slot_id'];
    $this->numTickets = $data['num_tickets'] ?: 0;
  }
}
