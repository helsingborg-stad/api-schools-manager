<?php

namespace SchoolsManager\API\Fields\GetImage;

interface GetImageInterface
{
    /**
     * Get Image from an image ID.
     *
     * @param int $imageId The image ID.
     * @return ImageInterface|null The image object or null if not found.
     */
    public function getImage(int $imageId): ImageInterface;
}
