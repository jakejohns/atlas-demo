<?php
// @codingStandardsIgnoreFile

namespace App\Repository;

use Atlas\Orm\Atlas;

use Atlas\Orm\Mapper\RecordInterface;
use Atlas\Orm\Mapper\RecordSetInterface;

use App\Data\Entry\EntryMapper;
use App\Data\Tag\TagMapper;

class Create
{
    protected $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function create(array $values)
    {
        $values = $this->fixTags($values);
        $record = $this->atlas->newRecord(EntryMapper::class, $values);
        if( !$this->atlas->insert($record)) {
            throw new \Exception('Insert Failed');
        }
        return $this->find($record->entry_id);
    }

    public function update($identity, $values)
    {
        $values = $this->fixTags($values);

        // $values['entry_id'] = $identity;
        // $record = $this->atlas->newRecord(EntryMapper::class, $values);

        $record = $this->atlas->fetchRecord(
            EntryMapper::class,
            $identity,
            ['taggings', 'tags']
        );

        $record->set($values);

        $this->atlas->update($record);

        return $this->find($identity);
    }


    public function find($identity)
    {
        $record = $this->atlas->fetchRecord(
            EntryMapper::class,
            $identity,
            ['taggings', 'tags']
        );

        return $record;
    }

    protected function fixTags($values)
    {
        unset($values['taggings']);
        if ($values['tags'] instanceof RecordSetInterface) {
            return $values;
        }

        // $atlas->newRecordSet() does not take values
        $tags = $this->atlas
            ->mapper(TagMapper::class)
            ->newRecordSet($values['tags']);

        $values['tags'] = $tags;
        return $values;
    }
}
