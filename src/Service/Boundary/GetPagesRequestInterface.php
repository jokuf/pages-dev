<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\GetSinglePageBySlugDto;

interface GetPagesRequestInterface
{
    public function handle(GetSinglePageBySlugDto $request): void;
}