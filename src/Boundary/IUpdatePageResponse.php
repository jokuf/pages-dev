<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\PageDTO;

interface IUpdatePageResponse
{
    public function present(PageDTO $pageDTO): void;
}