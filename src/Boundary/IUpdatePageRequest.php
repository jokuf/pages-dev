<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\CreatePageRequestDto;

interface IUpdatePageRequest
{
    public function handle(CreatePageRequestDto $page): void;
}