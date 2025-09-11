<?php

namespace SchoolsManager\API\Fields\GetImage;

use WpService\Contracts\GetPostField;
use WpService\Contracts\GetPostMeta;
use WpService\Contracts\WpGetAttachmentUrl;

class ImageProvider implements GetImageInterface
{
    public function __construct(
        private WpGetAttachmentUrl&GetPostMeta&GetPostField $wpService
    ) {
    }

    public function getImage(int $imageId): ImageInterface
    {
        return $this->createImage(
            $imageId,
            $this->wpService->wpGetAttachmentUrl($imageId) ?: null,
            $this->wpService->getPostMeta($imageId, '_wp_attachment_image_alt', true) ?: null,
            $this->wpService->getPostField('post_excerpt', $imageId) ?: null,
            $this->wpService->getPostField('post_title', $imageId) ?: null
        );
    }

    public function createImage(
        ?int $id = null,
        ?string $url = null,
        ?string $alt = null,
        ?string $caption = null,
        ?string $title = null
    ): ImageInterface {
        return new class ($id, $alt, $caption, $title, $url) implements ImageInterface {
            public function __construct(
                private ?int $id = null,
                private ?string $alt = null,
                private ?string $caption = null,
                private ?string $title = null,
                private ?string $url = null,
            ) {
            }
            public function getId(): ?int
            {
                return $this->id;
            }

            public function getAlt(): ?string
            {
                return $this->alt;
            }

            public function getCaption(): ?string
            {
                return $this->caption;
            }

            public function getTitle(): ?string
            {
                return $this->title;
            }
            public function getUrl(): ?string
            {
                return $this->url;
            }
            public function toArray(): array
            {
                return [
                    'ID'      => $this->getId(),
                    'url'     => $this->getUrl(),
                    'alt'     => $this->getAlt(),
                    'name'    => $this->getTitle(),
                    'caption' => $this->getCaption(),
                ];
            }
        };
    }
}
