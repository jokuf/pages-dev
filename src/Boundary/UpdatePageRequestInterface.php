<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\CreatePageRequestDto;

interface UpdatePageRequestInterface
{
    public function handle(CreatePageRequestDto $page): void;
}