<?php
namespace Jokuf\Site\Tests\Stories;

use Jokuf\Site\DTO\PageContentDTO;
use Jokuf\Site\DTO\CreatePageRequestDto;
use Jokuf\Site\Entity\Page;
use Jokuf\Site\Entity\PageContent;
use Jokuf\Site\Interactor\CreatePageInteractor;
use Jokuf\Site\Tests\Stub\Gateway\InMemoryStorageGatewayInterface;
use Jokuf\Site\Tests\Stub\Presenter\DummyCreatePagePresenterInterface;

class TestPageUserStories extends \PHPUnit\Framework\TestCase
{
    private static $storage;

    public static function setUpBeforeClass(): void
    {
        self::$storage = new InMemoryStorageGatewayInterface();
    }

    public function testAsAUserIWantToCreateAPage() {
        $useCase = new CreatePageInteractor(
            self::$storage,
            new DummyCreatePagePresenterInterface()
        );

        $pageDTO = new CreatePageRequestDto(
            null,
            'Homepage',
            'Welcome home',
            'long description',
            ['test', 'test2'],
            0,
            false,
            'homepage'
        );
        $useCase->handle($pageDTO);

        $this->assertNotNull(self::$storage->getBySlug('/homepage'));
    }

    public function testAsAUserIWantToAddNewLanguageVersionToAPage() {
        $this->assertTrue(true);
    }

    public function testAsAUserIwantToUpdatePageContent() {
        $page = self::$storage->getBySlug('/homepage');

        $this->assertNotNull($page);
        $name = $page->getName();
        $title = $page->getTitle();
        $content = $page->getContent();


        $entity = new Page(
            '/homepage', null,$name, "$title - modified", "$content - modified", ['tag1', 'tag2'], 0, false, 'homepage'
        );

        $entity->save(self::$storage);

        $modifiedPage = self::$storage->getBySlug('/homepage');

        $this->assertNotEquals($page->getTitle(), $modifiedPage->getTitle());
        $this->assertNotEquals($page->getContent(), $modifiedPage->getContent());
    }

    public function testAsAUserIWantToGetPageById() {
        $this->assertTrue(true);
    }

    public function testAsAUserIWantToGetPageBySlug() {
        $this->assertTrue(true);
    }

    public function testAsAUserIWantToDeletePageLanguageVersion() {
        $this->assertTrue(true);
    }

    public function testAsUserIWantToDeleteAPage() {
        $this->assertTrue(true);
    }

    public function testAsUserIWantToUpdateAPage() {
        $this->assertTrue(true);
    }

    public static function tearDownAfterClass(): void
    {
        var_dump(self::$storage);
    }
}