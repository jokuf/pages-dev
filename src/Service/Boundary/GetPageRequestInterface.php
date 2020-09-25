<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\GetSinglePageBySlugDto;

interface GetPageRequestInterface
{
    public function handle(GetSinglePageBySlugDto $request): void;
}