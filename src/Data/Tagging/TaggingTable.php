<?php
/**
 * This table class was generated by Atlas. Changes will be overwritten.
 */
namespace App\Data\Tagging;

use Atlas\Orm\Table\AbstractTable;

/**
 * @inheritdoc
 */
class TaggingTable extends AbstractTable
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'taggings';
    }

    /**
     * @inheritdoc
     */
    public function getColNames()
    {
        return [
            'tagging_id',
            'tag_id',
            'entry_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getCols()
    {
        return [
            'tagging_id' => (object) [
                'name' => 'tagging_id',
                'type' => 'integer',
                'size' => null,
                'scale' => null,
                'notnull' => false,
                'default' => null,
                'autoinc' => true,
                'primary' => true,
            ],
            'tag_id' => (object) [
                'name' => 'tag_id',
                'type' => 'integer',
                'size' => null,
                'scale' => null,
                'notnull' => false,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
            ],
            'entry_id' => (object) [
                'name' => 'entry_id',
                'type' => 'integer',
                'size' => null,
                'scale' => null,
                'notnull' => false,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getPrimaryKey()
    {
        return [
            'tagging_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAutoinc()
    {
        return 'tagging_id';
    }

    /**
     * @inheritdoc
     */
    public function getColDefaults()
    {
        return [
            'tagging_id' => null,
            'tag_id' => null,
            'entry_id' => null,
        ];
    }
}
