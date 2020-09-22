<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\PageCollectionResponseDto;

interface GetPagesPresenterInterface
{
    public function present(PageCollectionResponseDto $response): void;
}