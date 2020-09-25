<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\UpdatePageRequestDto;

interface UpdatePageRequestInterface
{
    public function handle(UpdatePageRequestDto $page): void;
}