<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\CreatePageRequestDto;

interface IUpdatePageResponse
{
    public function present(CreatePageRequestDto $pageDTO): void;
}