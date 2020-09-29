<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\ConcretePageResponseDto;
use Jokuf\Site\Service\Model\DeletePageResponseDto;
use Jokuf\Site\Service\Model\PageCollectionResponseDto;

interface PagePresenterInterface
{
    public function presentSinglePage(ConcretePageResponseDto $response): void;
    public function presentCollection(PageCollectionResponseDto $response): void;
    public function presentDeletedPage(DeletePageResponseDto $response): void;
}