<?php


namespace Jokuf\Site\Gateway;


use Jokuf\Site\Data\PageData;

interface PageGatewayInterface
{
    public function save(PageData $data): void;
    public function delete(PageData $data): bool;
    public function getBySlug(string $slug): ?PageData;
}