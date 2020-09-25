<?php


namespace Jokuf\Site\Service\Gateway;


use Jokuf\Site\Service\Data\PageData;
use Jokuf\Site\Core\Entity\Page;

interface PageGatewayInterface
{
    public function save(PageData $data): PageData;
    public function delete(PageData $data): bool;

    public function getBySlug(string $slug): ?PageData;
    public function getChildren(PageData $data): array;
    public function getPageSlug(Page $page): ?string;
    public function savePageSlug(Page $page, $slug): bool;
}