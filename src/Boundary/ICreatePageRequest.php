<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\PageDTO;

interface ICreatePageRequest
{
    public function handle(PageDTO $pageDTO): void;
}