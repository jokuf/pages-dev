<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\CreatePageRequestDto;

interface ICreatePageRequest
{
    public function handle(CreatePageRequestDto $pageDTO): void;
}