<?php

namespace Pyz\Zed\Book;

use Pyz\Zed\Book\Business\BookFacade;
use Pyz\Zed\Book\Persistence\BookRepository;
use Pyz\Zed\Book\Persistence\BookRepositoryInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class BookDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_BOOK = 'FACADE_BOOK';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    public function provideBusinessLayerDependencies(Container $container): void
    {
        $this->addFacadeBook($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function addFacadeBook(Container $container): void
    {
        $container->set(static::FACADE_BOOK, function (Container $container) {
            return new BookFacade($this->getRepository($container));
        });
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Pyz\Zed\Book\Persistence\BookRepositoryInterface
     */
    protected function getRepository(Container $container): BookRepositoryInterface
    {
        return new BookRepository();
    }
}
