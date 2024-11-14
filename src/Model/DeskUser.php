<?php

namespace KokiDDP\PHPTela\Model;

class DeskUser {
  public bool $isDesk;
  public ?string $title;
  /** @var SellingDay[] */
  public array $sellingDays;

  public function __construct(array $data)
  {
    $this->isDesk = $data['isDesk'] ?: false;
    $this->title = isset($data['title']) && $data['title'] ? $data['title'] : null;
    $this->sellingDays = array_map(fn($dataDay) => new SellingDay($dataDay), isset($data['sellingDays']) && $data['sellingDays'] ? $data['sellingDays'] : []);
  }
}
