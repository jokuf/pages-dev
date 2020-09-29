<?php
namespace Jokuf\Site\Tests\Stories;

use Jokuf\Site\Core\Interactor\PageInteractor;
use Jokuf\Site\Service\Model\CreatePageRequestDto;
use Jokuf\Site\Service\Model\DeletePageRequestDto;
use Jokuf\Site\Service\Model\GetPageRequestDto;
use Jokuf\Site\Service\Model\UpdatePageRequestDto;
use Jokuf\Site\Tests\Stub\Gateway\InMemoryStorageGatewayInterface;
use Jokuf\Site\Tests\Stub\Presenter\DummyPagePresenter;

class TestPageUserStories extends \PHPUnit\Framework\TestCase
{
    private static $storage;
    /**
     * @var DummyPagePresenter
     */
    private static $presenter;

    public static function setUpBeforeClass(): void
    {
        self::$storage = new InMemoryStorageGatewayInterface();
        self::$presenter = new DummyPagePresenter();
    }

    public function testAsAUserIWantToCreateAPage()
    {
        $useCase = new PageInteractor(
            self::$storage,
            self::$presenter
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
        $useCase->create($pageDTO);

        self::assertNotNull(self::$storage->getBySlug('/'));
    }

    /**
     * @depends testAsAUserIWantToCreateAPage
     */
    public function testAsUserIWantToUpdateAPage(): void
    {
        $request = new UpdatePageRequestDto(
            '/',
            'jokuf-asdfa',
            null,
            null,
            [],
            5,
            true
        );

        $useCase = new PageInteractor(self::$storage, self::$presenter);
        $useCase->update($request);


        self::assertEquals('jokuf-asdfa', self::$presenter->value->getName());
        self::assertEquals('Welcome home', self::$presenter->value->getTitle());
        self::assertEquals('/', self::$presenter->value->getSlug());
    }

    /**
     * @depends testAsAUserIWantToCreateAPage
     */
    public function testAsAUserIWantToGetPageBySlug()
    {
        $case = new PageInteractor(self::$storage, self::$presenter);

        $case->getBySlug(new GetPageRequestDto('/'));

        self::assertEquals('Welcome home', self::$presenter->value->getTitle());

        $case->getBySlug(new GetPageRequestDto('/?arg=true&arg2=false'));

        self::assertEquals('Welcome home', self::$presenter->value->getTitle());

        $case->getBySlug(new GetPageRequestDto('https://localhost/?arg=true&arg2=false'));

        self::assertEquals('Welcome home', self::$presenter->value->getTitle());

        $case->getBySlug(new GetPageRequestDto('/?arg=true&arg2=false'));

        self::assertEquals('Welcome home', self::$presenter->value->getTitle());
    }


    /**
     * @depends testAsAUserIWantToCreateAPage
     */
    public function testAsUserIWantToDeleteAPage()
    {
        $useCase = new PageInteractor(
            self::$storage,
            self::$presenter
        );

        $useCase->delete(
            new DeletePageRequestDto(
                '/'
            )
        );

        self::assertTrue(self::$presenter->value->isSuccessful());

        $useCase->delete(
            new DeletePageRequestDto(
                '/'
            )
        );

        self::assertFalse(self::$presenter->value->isSuccessful());
    }

    public function testCheckSlugValueIsInExpectedFormat() {
        self::$storage->reset();

        $createPageUseCase = new PageInteractor(
            self::$storage,
            self::$presenter
        );

        $pageDTO = new CreatePageRequestDto(
            null,
            'Home',
            'Welcome',
            'description',
            [],
            0,
            false,
            'homepage'
        );


        $createPageUseCase->create($pageDTO);

        $pageDTO = new CreatePageRequestDto(
            '/',
            'products',
            'Group page',
            'description',
            [],
            0,
            false,
            'product-category'
        );
        $createPageUseCase->create($pageDTO);


        $pageDTO = new CreatePageRequestDto(
            '/products',
            'Concrete product',
            'Concrete product title',
            'Product description',
            [],
            0,
            false,
            'product'
        );

        $createPageUseCase->create($pageDTO);
        $case = new PageInteractor(
            self::$storage,
            self::$presenter
        );

        $case->getBySlug(new GetPageRequestDto('/products/concrete-product'));

        self::assertNotNull(self::$presenter->value);
        self::assertEquals('Concrete product title', self::$presenter->value->getTitle());
    }

    /**
     * @depends testCheckSlugValueIsInExpectedFormat
     */
    public function testICanDeletePageByUrlWhichContainsQueryString(): void
    {
        $useCase = new PageInteractor(
            self::$storage,
            self::$presenter
        );

        $useCase->delete(
            new DeletePageRequestDto(
                '/products?query=1'
            )
        );

        self::assertTrue(self::$presenter->value->isSuccessful());
    }
}