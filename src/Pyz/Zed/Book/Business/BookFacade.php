<?php
namespace Pyz\Zed\Book\Business;

use Generated\Shared\Transfer\BookTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class BookFacade extends AbstractFacade implements BookFacadeInterface
{
    public function createBook(BookTransfer $bookTransfer): void
    {
        $this->getFactory()->createBookWriter()->create($bookTransfer);
    }

    public function updateBook(BookTransfer $bookTransfer): void
    {
        $this->getFactory()->createBookWriter()->update($bookTransfer);
    }

    public function deleteBookById(int $idBook): void
    {
        $this->getFactory()->createBookWriter()->delete($idBook);
    }

    public function getBookById(int $idBook): BookTransfer
    {
        return $this->getFactory()->createBookReader()->getById($idBook);
    }

    public function getAllBooks(): array
    {
        return $this->getFactory()->createBookReader()->getAll();
    }
}
