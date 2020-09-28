<?php
namespace Jokuf\Site\Tests\Stories;

use Jokuf\Site\Service\Model\CreatePageRequestDto;
use Jokuf\Site\Service\Model\DeletePageRequestDto;
use Jokuf\Site\Service\Model\GetPageRequestDto;
use Jokuf\Site\Service\Model\UpdatePageRequestDto;
use Jokuf\Site\Core\Interactor\CreatePageInteractor;
use Jokuf\Site\Core\Interactor\DeletePageInteractor;
use Jokuf\Site\Core\Interactor\GetPageBySlugInteractor;
use Jokuf\Site\Core\Interactor\UpdatePageInteractor;
use Jokuf\Site\Tests\Stub\Gateway\InMemoryStorageGatewayInterface;
use Jokuf\Site\Tests\Stub\Presenter\DeletePagePresenter;
use Jokuf\Site\Tests\Stub\Presenter\DummyCreatePagePresenterInterface;
use Jokuf\Site\Tests\Stub\Presenter\GetPagePresenter;
use Jokuf\Site\Tests\Stub\Presenter\UpdatePagePresenter;
use PHPUnit\Util\Xml\ValidationResult;

class TestPageUserStories extends \PHPUnit\Framework\TestCase
{
    private static $storage;

    public static function setUpBeforeClass(): void
    {
        self::$storage = new InMemoryStorageGatewayInterface();
    }

    public function testAsAUserIWantToCreateAPage()
    {
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

        $response = new UpdatePagePresenter();
        $useCase = new UpdatePageInteractor(self::$storage, $response);
        $useCase->handle($request);


        self::assertEquals('jokuf-asdfa', $response->value->getName());
        self::assertEquals('Welcome home', $response->value->getTitle());
        self::assertEquals('/', $response->value->getSlug());
    }

    /**
     * @depends testAsAUserIWantToCreateAPage
     */
    public function testAsAUserIWantToGetPageBySlug()
    {
        $presenter = new GetPagePresenter();
        $case = new GetPageBySlugInteractor(
            self::$storage,
            $presenter
        );

        $case->handle(new GetPageRequestDto('/'));

        self::assertEquals('Welcome home', $presenter->value->getTitle());

        $case->handle(new GetPageRequestDto('/?arg=true&arg2=false'));

        self::assertEquals('Welcome home', $presenter->value->getTitle());

        $case->handle(new GetPageRequestDto('https://localhost/?arg=true&arg2=false'));

        self::assertEquals('Welcome home', $presenter->value->getTitle());

        $case->handle(new GetPageRequestDto('/?arg=true&arg2=false'));

        self::assertEquals('Welcome home', $presenter->value->getTitle());
    }


    /**
     * @depends testAsAUserIWantToCreateAPage
     */
    public function testAsUserIWantToDeleteAPage()
    {
        $presenter = new DeletePagePresenter();
        $useCase = new DeletePageInteractor(
            self::$storage,
            $presenter
        );

        $useCase->handle(
            new DeletePageRequestDto(
                '/'
            )
        );

        self::assertTrue($presenter->value->isSuccessful());

        $useCase->handle(
            new DeletePageRequestDto(
                '/'
            )
        );

        self::assertFalse($presenter->value->isSuccessful());
    }

    public function testCheckSlugValueIsInExpectedFormat() {
        self::$storage->reset();

        $createPageUseCase = new CreatePageInteractor(
            self::$storage,
            new DummyCreatePagePresenterInterface()
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


        $createPageUseCase->handle($pageDTO);

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
        $createPageUseCase->handle($pageDTO);


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

        $createPageUseCase->handle($pageDTO);
        $presenter = new GetPagePresenter();
        $case = new GetPageBySlugInteractor(
            self::$storage,
            $presenter
        );

        $case->handle(new GetPageRequestDto('/products/concrete-product'));

        self::assertNotNull($presenter->value);
        self::assertEquals('Concrete product title', $presenter->value->getTitle());
    }
}