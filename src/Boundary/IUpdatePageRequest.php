<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\PageDTO;

interface IUpdatePageRequest
{
    public function handle(PageDTO $page): void;
}