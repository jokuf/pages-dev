<?php


namespace Jokuf\Site\Gateway;


use Jokuf\Site\Entity\Page;

interface PageGatewayInterface
{
    public function get(int $id): ?Page;
    public function save(Page $page): void;
    public function delete(Page $page): bool;
    public function getBySlug(string $slug): ?Page;
}