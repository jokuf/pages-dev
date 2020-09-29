<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\CreatePageRequestDto;
use Jokuf\Site\Service\Model\DeletePageRequestDto;
use Jokuf\Site\Service\Model\GetPageRequestDto;
use Jokuf\Site\Service\Model\UpdatePageRequestDto;

interface PageBoundaryInterface
{
    public function create(CreatePageRequestDto $request): void;
    public function update(UpdatePageRequestDto $request): void;
    public function delete(DeletePageRequestDto $request): void;
    public function getBySlug(GetPageRequestDto $request): void;
}