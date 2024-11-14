<?php

namespace KokiDDP\PHPTela\Model;

class Activity
{
  public string $title;
  public string $description;
  public string $type;
  public ?\DateTimeInterface $startDate;
  public ?\DateTimeInterface $endDate;
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
  public ?\DateTimeInterface $timestamp;
  public ?array $deskWith;
  public bool $isOpen;
  public ?string $vat;
  public string $activityId;
  /** @var SellingDay[] */
  public array $sellingDays;

  public function __construct(array $data)
  {
    $this->title = $data['title'];
    $this->description = $data['description'];
    $this->type = $data['type'];
    $this->startDate = isset($data['startDate']) && $data['startDate'] ? \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $data['startDate']) : null;
    $this->endDate = isset($data['endDate']) && $data['endDate'] ? \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $data['endDate']) : null;
    $this->info = new Info($data['info']);
    $this->hashtags = $data['hashtags'] ?? null;
    $this->settings = isset($data['settings']) && $data['settings'] ? new Settings($data['settings']) : null;
    $this->enableNamesList = $data['enableNamesList'] ?? false;
    $this->tickets = isset($data['tickets']) && is_array($data['tickets']) ? array_map(fn($ticket) => is_array($ticket) ? new Ticket($ticket) : null, $data['tickets']) : null;
    $this->ticketsData = isset($data['ticketsData']) && $data['ticketsData'] ? new TicketsData($data['ticketsData']) : null;
    $this->creator = $data['creator'];
    $this->mainPhotoObj = new Photo($data['mainPhotoObj']);
    $this->galleryObjs = array_map(fn($photo) => new Photo($photo), $data['galleryObjs'] ?? []);
    $this->timestamp = isset($data['timestamp']) && $data['timestamp'] ? \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $data['timestamp']) : null;
    $this->deskWith = $data['deskWith'] ?? null;
    $this->isOpen = $data['isOpen'] ?? false;
    $this->vat = $data['vat'] ?? null;
    $this->activityId = $data['activityId'];
    $this->sellingDays = array_map(fn($day) => new SellingDay($day['day']), isset($data['sellingDays']) && $data['sellingDays'] ? $data['sellingDays'] : []);
  }
}
