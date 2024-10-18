<?php

namespace KokiDDP\PHPTela\Model;

class TicketsData
{
  public string $firstDescription;
  public ?string $footerDescription;
  public string $firstLogoType;
  public string $firstLogo;
  public string $firstLogoUrl;

  public function __construct(array $data)
  {
    $this->firstDescription = $data['firstDescription'];
    $this->footerDescription = $data['footerDescription'] ?? null;
    $this->firstLogoType = $data['firstLogoType'];
    $this->firstLogo = $data['firstLogo'];
    $this->firstLogoUrl = "https://telabe.kicky.cloud/download/photos?id={$data['firstLogo']}";
  }
}
