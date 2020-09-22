<?php


namespace Jokuf\Site\Entity;


use Jokuf\Site\Data\PageData;
use Jokuf\Site\Gateway\PageGatewayInterface;

class Page
{
    /**
     * @var Page|null
     */
    protected $parent;
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
     * @var string|null
     */
    private $slug;

    private $dirtyFields = [];

    /**
     * Page constructor.
     * @param string|null $slug
     * @param Page|null $parent
     * @param string $name
     * @param string $title
     * @param string $content
     * @param array $tags
     * @param int $level
     * @param bool $locked
     * @param string $template
     */
    public function __construct(
        ?string $slug, ?Page $parent, string $name, string $title, string $content, array $tags, int $level, bool $locked, string $template
    )
    {
        $this->parent   = $parent;
        $this->level    = $level;
        $this->locked   = $locked;
        $this->template = $template;
        $this->content  = $content;
        $this->name     = $name;
        $this->title    = $title;
        $this->tags     = $tags;
        $this->slug     = $slug;
    }

    public function getSlug(): string
    {
        $slug = $this->slug;
        if ($slug) {
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

    private function slugify($string): string
    {
        // \\pL is a Unicode property shortcut. It can also be written as as\p{L} or \p{Letter}. It matches any kind of letter from any language.
        return strtolower(trim(preg_replace('/[^\p{L}0-9-]+/u', '-', $string), '-'));
    }

    public function isEqual(Page $page): bool
    {
        return $this->slug === $page->slug;
    }

    public function save(PageGatewayInterface $storage): bool
    {
        $storage->save(
            new PageData(
                $this->getSlug(),
                $this->name,
                $this->title,
                $this->content,
                $this->tags,
                $this->level,
                $this->locked,
                $this->template
            )
        );

        return true;
    }

    public function delete(PageGatewayInterface $storage): bool
    {
        return $storage->delete(new PageData($this->slug));
    }

    public function updateName(string $name): self
    {
        $this->markDirty('name');
        $this->name = $name;

        return $this;
    }

    /**
     * @param PageGatewayInterface $storage
     * @return Page[]
     */
    public function getChildren(PageGatewayInterface $storage): array
    {

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

    private function markDirty(string $name)
    {
        $this->dirtyFields[$name] = $this->$name;
    }

    public function hasChanged(): bool
    {
        return !empty($this->dirtyFields);
    }

    public function getChangedFields(): array
    {
        return array_keys($this->dirtyFields);
    }

    public function assembleData(): PageData
    {
        return new PageData(
            $this->slug,
            $this->name,
            $this->title,
            $this->content,
            $this->tags,
            $this->level,
            $this->locked,
            $this->template
        );
    }

    /**
     * @return Page|null
     */
    public function getParent(): ?Page
    {
        return $this->parent;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->locked;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}