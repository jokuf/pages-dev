<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\UpdatePageRequestDto;

interface UpdatePageRequestInterface
{
    public function handle(UpdatePageRequestDto $page): void;
}