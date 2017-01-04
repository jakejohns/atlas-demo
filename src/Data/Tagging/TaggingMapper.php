<?php
//@codingStandardsIgnoreFile
namespace App\Data\Tagging;

use Atlas\Orm\Mapper\AbstractMapper;

use App\Data\Tag\TagMapper;
use App\Data\Entry\EntryMapper;

/**
 * @inheritdoc
 */
class TaggingMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('tags', TagMapper::CLASS);
        $this->manyToOne('entries', EntryMapper::CLASS);
    }
}
