<?php

namespace Pyz\Zed\Book\Persistence;

use Generated\Shared\Transfer\BookTransfer;
use Orm\Zed\Book\Persistence\PyzBookQuery;

class BookRepository implements BookRepositoryInterface
{
    /**
     * @param int $idBook
     *
     * @return \Generated\Shared\Transfer\BookTransfer|null
     */
    public function findBookById(int $idBook): ?BookTransfer
    {
        $pyzBookEntity = PyzBookQuery::create()->findOneByIdBook($idBook);

        if (!$pyzBookEntity) {
            return null;
        }

        return $this->mapEntityToTransfer($pyzBookEntity);
    }

    /**
     * @param array $filter
     *
     * @return \Generated\Shared\Transfer\BookTransfer[]
     */
    public function findBooks(array $filter = []): array
    {
        $query = PyzBookQuery::create();

        // Apply filters if any

        $pyzBookEntities = $query->find();

        return $this->mapEntitiesToTransfers($pyzBookEntities);
    }

    /**
     * @param \Generated\Shared\Transfer\BookTransfer $bookTransfer
     *
     * @return \Generated\Shared\Transfer\BookTransfer
     */
    public function createBook(BookTransfer $bookTransfer): BookTransfer
    {
        $pyzBookEntity = new PyzBook();
        $pyzBookEntity = $this->mapTransferToEntity($bookTransfer, $pyzBookEntity);
        $pyzBookEntity->save();

        return $this->mapEntityToTransfer($pyzBookEntity);
    }

    /**
     * @param \Generated\Shared\Transfer\BookTransfer $bookTransfer
     *
     * @return \Generated\Shared\Transfer\BookTransfer
     */
    public function updateBook(BookTransfer $bookTransfer): BookTransfer
    {
        $idBook = $bookTransfer->getIdBook();
        $pyzBookEntity = PyzBookQuery::create()->findOneByIdBook($idBook);

        if (!$pyzBookEntity) {
            // Handle not found error
            return null;
        }

        $pyzBookEntity = $this->mapTransferToEntity($bookTransfer, $pyzBookEntity);
        $pyzBookEntity->save();

        return $this->mapEntityToTransfer($pyzBookEntity);
    }

    /**
     * @param int $idBook
     *
     * @return bool
     */
    public function deleteBook(int $idBook): bool
    {
        $pyzBookEntity = PyzBookQuery::create()->findOneByIdBook($idBook);

        if (!$pyzBookEntity) {
            // Handle not found error
            return false;
        }

        try {
            $pyzBookEntity->delete();
            return true;
        } catch (\Exception $e) {
            // Handle delete error
            return false;
        }
    }

    /**
     * @param \Orm\Zed\Book\Persistence\PyzBook $pyzBookEntity
     *
     * @return \Generated\Shared\Transfer\BookTransfer
     */
    protected function mapEntityToTransfer(PyzBook $pyzBookEntity): BookTransfer
    {
        $bookTransfer = new BookTransfer();
        $bookTransfer->fromArray($pyzBookEntity->toArray(), true);

        return $bookTransfer;
    }

    /**
     * @param \Orm\Zed\Book\Persistence\PyzBook[] $pyzBookEntities
     *
     * @return \Generated\Shared\Transfer\BookTransfer[]
     */
    protected function mapEntitiesToTransfers(array $pyzBookEntities): array
    {
        $bookTransfers = [];

        foreach ($pyzBookEntities as $pyzBookEntity) {
            $bookTransfers[] = $this->mapEntityToTransfer($pyzBookEntity);
        }

        return $bookTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\BookTransfer $bookTransfer
     * @param \Orm\Zed\Book\Persistence\PyzBook|null $pyzBookEntity
     *
     * @return \Orm\Zed\Book\Persistence\PyzBook
     */
    protected function mapTransferToEntity(BookTransfer $bookTransfer, ?PyzBook $pyzBookEntity = null): PyzBook
    {
        if ($pyzBookEntity === null) {
            $pyzBookEntity = new PyzBook();
        }

        $pyzBookEntity->fromArray($bookTransfer->toArray());

        return $pyzBookEntity;
    }
}
