<?php


namespace Jokuf\Site\DTO;


class PageCollectionResponseDto
{
    /**
     * @var ConcretePageResponseDto[]
     */
    private $pages;

    public function __construct(ConcretePageResponseDto ... $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return ConcretePageResponseDto[]
     */
    public function getCollection(): array
    {
        return $this->pages;
    }
}