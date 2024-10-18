<?php

namespace KokiDDP\PHPTela\Model;

class Photo
{
  public string $id;
  public string $type;
  public string $url;

  public function __construct(array $data)
  {
    $this->id = $data['id'];
    $this->type = $data['type'];
    $this->url = "https://telabe.kicky.cloud/download/photos?id={$data['id']}";
  }
}
