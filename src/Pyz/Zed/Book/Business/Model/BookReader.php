<?php
namespace Pyz\Zed\Book\Business\Model;

use Generated\Shared\Transfer\BookTransfer;
use Orm\Zed\Book\Persistence\PyzBookQuery;

class BookReader
{
    public function getById(int $idBook): BookTransfer
    {
        $bookEntity = PyzBookQuery::create()->findOneByIdBook($idBook);
        $bookTransfer = new BookTransfer();
        $bookTransfer->fromArray($bookEntity->toArray(), true);

        return $bookTransfer;
    }

    public function getAll(): array
    {
        $bookEntities = PyzBookQuery::create()->find();
        $bookTransfers = [];
        foreach ($bookEntities as $bookEntity) {
            $bookTransfer = new BookTransfer();
            $bookTransfer->fromArray($bookEntity->toArray(), true);
            $bookTransfers[] = $bookTransfer;
        }

        return $bookTransfers;
    }
}