<?php

namespace Pyz\Zed\Book\Business\Model;

use Generated\Shared\Transfer\BookTransfer;
use Orm\Zed\Book\Persistence\PyzBookQuery;

class BookWriter
{
    public function create(BookTransfer $bookTransfer): void
    {
        $bookEntity = new PyzBook();
        $bookEntity->fromArray($bookTransfer->toArray());
        $bookEntity->save();
    }

    public function update(BookTransfer $bookTransfer): void
    {
        $bookEntity = PyzBookQuery::create()->findOneByIdBook($bookTransfer->getIdBook());
        $bookEntity->fromArray($bookTransfer->toArray());
        $bookEntity->save();
    }

    public function delete(int $idBook): void
    {
        $bookEntity = PyzBookQuery::create()->findOneByIdBook($idBook);
        $bookEntity->delete();
    }
}

