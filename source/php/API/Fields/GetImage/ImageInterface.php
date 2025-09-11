<?php

namespace SchoolsManager\API\Fields\GetImage;

interface ImageInterface
{
    public function getUrl(): ?string;
    public function getAlt(): ?string;
    public function getCaption(): ?string;
    public function getTitle(): ?string;
    public function getId(): ?int;
    public function toArray(): array;
}
