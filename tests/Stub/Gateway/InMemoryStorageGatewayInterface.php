<?php


namespace Jokuf\Site\Tests\Stub\Gateway;


use Jokuf\Site\Service\Data\PageData;
use Jokuf\Site\Core\Entity\Page;

class InMemoryStorageGatewayInterface implements \Jokuf\Site\Service\Gateway\PageGatewayInterface
{
    private $id=0;
    private $pages;

    public function reset()
    {
        $this->id = 0;
        $this->pages = [];
    }

    public function save(PageData $data): PageData
    {
        if ($data->getSlug() === null || empty($data->getSlug())) {
            throw new \InvalidArgumentException();
        }

        $this->pages[$data->getSlug()] = new PageData(
            ++$this->id,
            $data->getParent(),
            $data->getSlug(),
            $data->getName(),
            $data->getTitle(),
            $data->getContent(),
            $data->getTags(),
            $data->getLevel(),
            $data->isLocked(),
            $data->getTemplate()
        );


        return $this->pages[$data->getSlug()];
    }

    public function delete(PageData $data): bool
    {
        if (array_key_exists($data->getSlug(), $this->pages)) {
            unset($this->pages[$data->getSlug()]);

            return true;
        }

        return false;
    }

    public function getBySlug(string $slug): ?PageData
    {
        return $this->pages[$slug] ?? null;
    }

    public function getChildren(PageData $pageData): array
    {
        // TODO: Implement getChildrenOf() method.
    }

    public function getPageSlug(Page $page): ?string
    {
        foreach ($this->pages as $k => $v) {
            if ($page === $v) {
                return $k;
            }
        }

        return null;
    }

    public function savePageSlug(Page $page, $slug): bool
    {
    }
}