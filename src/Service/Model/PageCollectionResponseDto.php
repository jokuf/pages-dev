<?php


namespace Jokuf\Site\Service\Model;


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