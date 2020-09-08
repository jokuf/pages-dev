<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\PageDTO;

interface ICreatePageResponse
{
    public function present(PageDTO $pageDTO): void;
}