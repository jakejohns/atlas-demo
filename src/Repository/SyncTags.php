<?php
// @codingStandardsIgnoreFile

namespace App\Repository;

use Atlas\Orm\Atlas;

use App\Data\Tag\TagMapper;
use App\Data\Tagging\TaggingMapper;

class SyncTags
{

    protected $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function tags($entry)
    {
        if (! $tags = $entry->tags) {
            return;
        }

        $tags = $this->findOrCreateTags($tags);
        $this->clearTags($entry->entry_id);
        $this->tagEntry($entry->entry_id, $tags);
    }

    protected function findOrCreateTags($tags)
    {
        $found = $this->findTagsBySlug($tags->slugs());
        $tags->removeBySlug($found);

        // using $atlas->insert($tag);
        // Uncaught exception 'PDOException' with message 'There is no active transaction'
        $mapper = $this->atlas->mapper(TagMapper::class);

        foreach ($tags as $tag) {
            $mapper->insert($tag);
            $found[] = $tag;
        }

        return $found;
    }

    protected function findTagsBySlug($slugs)
    {
        $found = $this->atlas->select(TagMapper::class)
            ->where('slug IN (?)', $slugs)
            ->fetchRecordSet();

        return $found;
    }

    protected function clearTags($entry_id)
    {
        $taggings = $this->atlas->select(TaggingMapper::class)
            ->where('entry_id = ?', $entry_id)
            ->fetchRecordSet();

        $mapper = $this->atlas->mapper(TaggingMapper::class);
        foreach ($taggings as $tagging) {
            $mapper->delete($tagging);
        }
    }

    protected function tagEntry($entry_id, $tags)
    {
        // using $atlas->insert($tag);
        // Uncaught exception 'PDOException' with message 'There is no active transaction'
        $mapper = $this->atlas->mapper(TaggingMapper::class);

        foreach ($tags as $tag) {
            $cols = ['entry_id' => $entry_id, 'tag_id' => $tag->tag_id];
            $record = $this->atlas->newRecord(TaggingMapper::class, $cols);
            $mapper->insert($record);
        }
    }

}
