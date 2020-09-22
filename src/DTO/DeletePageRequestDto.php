<?php


namespace Jokuf\Site\DTO;


class DeletePageRequestDto
{
    /**
     * @var string
     */
    private $slug;

    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}