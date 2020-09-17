<?php


namespace Jokuf\Site\Tests\Stub\Gateway;


use Jokuf\Site\Data\PageData;
use Jokuf\Site\Entity\Page;

class InMemoryStorageGatewayInterface implements \Jokuf\Site\Gateway\PageGatewayInterface
{
    private $pages;

    public function save(PageData $data): void
    {
        if ($data->getSlug() === null || empty($data->getSlug())) {
            throw new \InvalidArgumentException();
        }

        $this->pages[$data->getSlug()] = $data;
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
}