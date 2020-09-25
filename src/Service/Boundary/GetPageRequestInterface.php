<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\GetPageRequestDto;

interface GetPageRequestInterface
{
    public function handle(GetPageRequestDto $request): void;
}