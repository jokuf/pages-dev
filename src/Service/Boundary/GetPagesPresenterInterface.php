<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\PageCollectionResponseDto;

interface GetPagesPresenterInterface
{
    public function present(PageCollectionResponseDto $response): void;
}