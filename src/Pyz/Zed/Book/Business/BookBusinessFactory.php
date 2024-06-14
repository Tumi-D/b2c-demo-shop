<?php
namespace Pyz\Zed\Book\Business;

use Pyz\Zed\Book\Business\Model\BookReader;
use Pyz\Zed\Book\Business\Model\BookWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class BookBusinessFactory extends AbstractBusinessFactory
{
    public function createBookWriter(): BookWriter
    {
        return new BookWriter();
    }

    public function createBookReader(): BookReader
    {
        return new BookReader();
    }
}
