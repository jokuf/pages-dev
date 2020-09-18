<?php
namespace Jokuf\Site\Tests\Stories;

use Jokuf\Site\DTO\CreatePageRequestDto;
use Jokuf\Site\DTO\UpdatePageRequestDto;
use Jokuf\Site\Interactor\CreatePageInteractor;
use Jokuf\Site\Interactor\UpdatePageInteractor;
use Jokuf\Site\Tests\Stub\Gateway\InMemoryStorageGatewayInterface;
use Jokuf\Site\Tests\Stub\Presenter\DummyCreatePagePresenterInterface;
use Jokuf\Site\Tests\Stub\Presenter\UpdatePagePresenter;

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

    public function testAsAUserIWantToUpdatePageContent() {
        $request = new UpdatePageRequestDto(
            '/homepage',
            'jokuf-asdfa',
            null,
            null,
            [],
            5,
            true
        );

        $response = new UpdatePagePresenter();
        $useCase = new UpdatePageInteractor(self::$storage,$response);
        $useCase->handle($request);


        $this->assertEquals('jokuf-asdfa', $response->value->getName());
        $this->assertEquals('Welcome home', $response->value->getTitle());
        $this->assertNotEquals('/homepage', $response->value->getSlug());
    }

    public function testAsAUserIWantToGetPageBySlug() {
        $this->assertTrue(true);
    }

    public function testAsUserIWantToDeleteAPage() {
        $this->assertTrue(true);
    }

    public function testAsUserIWantToUpdateAPage() {
        $this->assertTrue(true);
    }
}