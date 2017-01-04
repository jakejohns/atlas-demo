<?php
// @codingStandardsIgnoreFile
namespace App\Data\Tag;

use Atlas\Orm\Mapper\AbstractMapper;

use App\Data\Tagging\TaggingMapper;
use App\Data\Entry\EntryMapper;

/**
 * @inheritdoc
 */
class TagMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('taggings', TaggingMapper::CLASS);
        $this->manyToMany('entries', EntryMapper::CLASS, 'taggings');
    }
}
