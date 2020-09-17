<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\CreatePageRequestDto;

interface CreatePageRequestInterface
{
    public function handle(CreatePageRequestDto $pageDTO): void;
}