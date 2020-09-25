<?php


namespace Jokuf\Site\Core\Entity;


use Jokuf\Site\Service\Data\PageData;
use Jokuf\Site\Service\Gateway\PageGatewayInterface;

class Page
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var Page|null
     */
    private $parent;
    /**
     * @var string
     */
    private $slug;
    /**
     * @var int
     */
    protected $level;
    /**
     * @var bool
     */
    protected $locked;
    /**
     * @var string
     */
    protected $template;
    /**
     * @var string
     */
    private $content;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $title;
    /**
     * @var array
     */
    private $tags;
    /**
     * @var array
     */
    private $dirtyFields = [];
    /**
     * @var bool
     */
    private $deleted = false;

    public function __construct(PageData $data) {
        $parentPageData = $data->getParent();
        $this->id       = $data->getId();
        $this->parent   = $parentPageData? new self($parentPageData) : null;
        $this->name     = $data->getName();
        $this->title    = $data->getTitle();
        $this->content  = $data->getContent();
        $this->tags     = $data->getTags();
        $this->slug     = $data->getSlug();

        if ($this->id && null === $this->slug) {
            throw new \DomainException('Missing slug when the page is loaded.');
        }

        if (null === $this->id) {
            $this->slug = null;
        }

        $this->level    = $data->getLevel();
        $this->locked   = $data->isLocked();
        $this->template = $data->getTemplate();
    }

    public function getSlug(): string
    {
        $slug = $this->slug;
        // if the slug is set this means that the page is not new
        if ($slug) {
            // if the page name is changed - regenerate the slug
            if (isset($this->dirtyFields['name'])) {
                $parts = explode('/', $slug);
                $baseSlug = implode('/', array_slice($parts, 0, -1));
                $slug = sprintf("%s/%s", $baseSlug, $this->slugify($this->name));
            }
        } else {
            $baseSlug = '';
            if (null !== $this->parent) $baseSlug = $this->parent->getSlug();
            $slug = sprintf("%s/%s", $baseSlug, $this->slugify($this->name));
        }

        $this->slug = $slug;

        return $this->slug;
    }

    public function save(PageGatewayInterface $storage): void
    {
        $data          = $storage->save(self::export($this));
        $this->id      = $data->getId();
        $this->parent  = $data->getParent();
        $this->deleted = false;
    }

    public function delete(PageGatewayInterface $storage): bool
    {
        if (true === $this->deleted) {
            throw new \DomainException('Cannot delete not existing page.');
        }

        if ($storage->delete(self::export($this))) {
            $this->deleted = true;

            return true;
        }

        throw new \DomainException('Unable to delete a page, please investigate.');
    }

    public function updateName(string $name): self
    {
        $this->markDirty('name');
        $this->name = $name;

        return $this;
    }

    public function updateTitle(string $title): self
    {
        $this->markDirty('title');
        $this->title = $title;

        return $this;
    }

    public function updateContent(string $content): self
    {
        $this->markDirty('content');
        $this->content = $content;

        return $this;
    }

    public function isChanged(): bool
    {
        return !empty($this->dirtyFields);
    }

    public function getChangedFields(): array
    {
        return array_keys($this->dirtyFields);
    }

    public function revert(): void
    {
        foreach ($this->dirtyFields as $name => $value) {
            $this->{$name} = $value;
        }

        $this->dirtyFields = [];
    }

    private function slugify($string): string
    {
        // \\pL is a Unicode property shortcut. It can also be written as as\p{L} or \p{Letter}. It matches any kind of letter from any language.
        return strtolower(trim(preg_replace('/[^\p{L}0-9-]+/u', '-', $string), '-'));
    }

    private function markDirty(string $name): void
    {
        $this->dirtyFields[$name] = $this->{$name};
    }

    public static function export(Page $page): PageData
    {
        return new PageData(
            $page->id,
            $page->parent ? self::export($page->parent): null,
            $page->getSlug(),
            $page->name,
            $page->title,
            $page->content,
            $page->tags,
            $page->level,
            $page->locked,
            $page->template
        );
    }
}