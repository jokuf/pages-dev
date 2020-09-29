<?php


namespace Jokuf\Site\Service\Gateway;


use Jokuf\Site\Service\Data\PageData;
use Jokuf\Site\Core\Entity\Page;

interface PageGatewayInterface
{
    /**
     * @param PageData $data
     *
     * @return PageData
     */
    public function save(PageData $data): PageData;

    /**
     * @param PageData $data
     *
     * @return bool
     */
    public function delete(PageData $data): bool;

    /**
     * @param string $slug
     *
     * @return PageData|null
     */
    public function getBySlug(string $slug): ?PageData;

    /**
     * @param PageData $data
     *
     * @return PageData[]
     */
    public function getChildren(PageData $data): array;

    /**
     * @param Page $page
     *
     * @return string|null
     */
    public function getPageSlug(Page $page): ?string;

    /**
     * @param Page $page
     * @param $slug
     *
     * @return bool
     */
    public function savePageSlug(Page $page, $slug): bool;
}