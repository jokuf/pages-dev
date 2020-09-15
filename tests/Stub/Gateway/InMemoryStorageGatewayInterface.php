<?php


namespace Jokuf\Site\Tests\Stub\Gateway;


use Jokuf\Site\Entity\Page;

class InMemoryStorageGatewayInterface implements \Jokuf\Site\Gateway\PageGatewayInterface
{
    private $id=0;
    private $pages;

    public function get(int $id): ?Page
    {
        return $this->pages[$id] ?? null;
    }

    public function save(Page $page): void
    {
        if (null === $page->getId()) {
            $page->setId(++$this->id);
        }

        $this->pages[$this->id] = $page;
    }

    public function delete(Page $page): bool
    {
        if (array_key_exists($page->getId(), $this->pages)) {
            unset($this->pages[$page->getId()]);

            return true;
        }

        return false;
    }

    public function getBySlug(string $slug): ?Page
    {

    }

    public function getAll(string $language, int $level): array
    {
        return $this->pages;
    }

    public function getHomepage(): ?array
    {
        return [];
    }
}