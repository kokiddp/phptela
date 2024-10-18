<?php

namespace KokiDDP\PHPTela\Model;

use Carbon\CarbonImmutable;

class Activity
{
  public string $title;
  public string $description;
  public string $type;
  public ?string $startDate;
  public ?string $endDate;
  public Info $info;
  public ?array $hashtags;
  public ?Settings $settings;
  public bool $enableNamesList;
  /** @var Ticket[] */
  public ?array $tickets;
  public ?TicketsData $ticketsData;
  public string $creator;
  public Photo $mainPhotoObj;
  /** @var Photo[] */
  public array $galleryObjs;
  public ?string $timestamp;
  public ?array $deskWith;
  public bool $isOpen;
  public ?string $vat;
  public string $activityId;
  /** @var \DateTimeInterface[] */
  public array $sellingDays;

  public function __construct(array $data)
  {
    $this->title = $data['title'];
    $this->description = $data['description'];
    $this->type = $data['type'];
    $this->startDate = $data['startDate'] ?? null;
    $this->endDate = $data['endDate'] ?? null;
    $this->info = new Info($data['info']);
    $this->hashtags = $data['hashtags'] ?? null;
    $this->settings = isset($data['settings']) && $data['settings'] ? new Settings($data['settings']) : null;
    $this->enableNamesList = $data['enableNamesList'] ?? false;
    $this->tickets = isset($data['tickets']) && is_array($data['tickets']) ? array_map(fn($ticket) => is_array($ticket) ? new Ticket($ticket) : null, $data['tickets']) : null;
    $this->ticketsData = isset($data['ticketsData']) && $data['ticketsData'] ? new TicketsData($data['ticketsData']) : null;
    $this->creator = $data['creator'];
    $this->mainPhotoObj = new Photo($data['mainPhotoObj']);
    $this->galleryObjs = array_map(fn($photo) => new Photo($photo), $data['galleryObjs'] ?? []);
    $this->timestamp = $data['timestamp'] ?? null;
    $this->deskWith = $data['deskWith'] ?? null;
    $this->isOpen = $data['isOpen'] ?? false;
    $this->vat = $data['vat'] ?? null;
    $this->activityId = $data['activityId'];
    $this->sellingDays = array_map(fn($day) => new CarbonImmutable($day['day']), $data['sellingDays'] ?? []);
  }
}
