<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\GetPageRequestDto;

interface GetPageRequestInterface
{
    public function handle(GetPageRequestDto $request): void;
}