<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\GetPageRequestDto;

interface GetPagesRequestInterface
{
    public function handle(GetPageRequestDto $request): void;
}