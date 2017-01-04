<?php
// @codingStandardsIgnoreFile

namespace App\Data\Tag;

use Atlas\Orm\Mapper\RecordSet;

/**
 * @inheritdoc
 */
class TagRecordSet extends RecordSet
{

    public function offsetSet($offset, $value)
    {
        if (is_string($value)) {
            $value = [
                'slug'  => $this->slug($value),
                'title' => $value
            ];
        }

        if (is_array($value)) {
            return $this->appendNew($value);
        }

        return parent::offsetSet($offset, $value);
    }


    protected function slug($value)
    {
        $value = preg_replace('/[^a-z0-9-]+/', '-', strtolower($value));
        $value = preg_replace("/-+/", '-', $value);
        $value = trim($value, '-');
        return $value;
    }

    public function slugs()
    {
        $slugs = [];
        foreach ($this as $tag) {
            $slugs[] = $tag->slug;
        }
        return $slugs;
    }

    public function removeBySlug($tags)
    {
        foreach ($tags as $tag) {
            $this->removeOneBy(['slug' => $tag->slug]);
        }
    }
}
