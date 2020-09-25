<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\CreatePageRequestDto;

interface CreatePageRequestInterface
{
    public function handle(CreatePageRequestDto $pageDTO): void;
}