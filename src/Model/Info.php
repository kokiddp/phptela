<?php

namespace KokiDDP\PHPTela\Model;

class Info
{
  public string $nameLocation;
  public string $address;
  public ?string $city;
  public ?string $streetNumber;
  public ?string $longitude;
  public ?string $latitude;
  public ?Location $location;
  public ?string $howToReachUs;
  public ?string $webSite;
  public ?string $toKnow;
  public ?string $phone;
  public ?string $mail;
  public array $ticketTypesDescription;

  public function __construct(array $data)
  {
    $this->nameLocation = $data['nameLocation'];
    $this->address = $data['address'];
    $this->city = $data['city'] ?? null;
    $this->streetNumber = $data['streetNumber'] ?? null;
    $this->longitude = $data['longitude'] ?? null;
    $this->latitude = $data['latitude'] ?? null;
    $this->location = isset($data['location']) ? new Location($data['location']) : null;
    $this->howToReachUs = $data['howToReachUs'] ?? null;
    $this->webSite = $data['webSite'] ?? null;
    $this->toKnow = $data['toKnow'] ?? null;
    $this->phone = $data['phone'] ?? null;
    $this->mail = $data['mail'] ?? null;
    $this->ticketTypesDescription = $data['ticketTypesDescription'] ?? [];
  }
}
