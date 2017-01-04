<?php
// @codingStandardsIgnoreFile
namespace App\Data\Entry;

use Atlas\Orm\Mapper\MapperEvents;
use Atlas\Orm\Mapper\MapperInterface;
use Atlas\Orm\Mapper\RecordInterface;

use Aura\SqlQuery\Common\Delete;
use Aura\SqlQuery\Common\Insert;
use Aura\SqlQuery\Common\Update;
use PDOStatement;

use App\Repository\SyncTags;

/**
 * @inheritdoc
 */
class EntryMapperEvents extends MapperEvents
{

    protected $sync;

    public function __construct(SyncTags $sync)
    {
        $this->sync = $sync;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterInsert(
        MapperInterface $mapper,
        RecordInterface $record,
        Insert $insert,
        PDOStatement $pdoStatement
    ) {
        $this->sync->tags($record);
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterUpdate(
        MapperInterface $mapper,
        RecordInterface $record,
        Update $update,
        PDOStatement $pdoStatement
    ) {
        $this->sync->tags($record);
    }

}
