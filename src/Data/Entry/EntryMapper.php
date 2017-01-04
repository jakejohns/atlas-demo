<?php
//@codingStandardsIgnoreFile
namespace App\Data\Entry;

use Atlas\Orm\Mapper\AbstractMapper;

use App\Data\Tagging\TaggingMapper;
use App\Data\Tag\TagMapper;

/**
 * @inheritdoc
 */
class EntryMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('taggings', TaggingMapper::CLASS);
        $this->manyToMany('tags', TagMapper::class, 'taggings');
    }
}
