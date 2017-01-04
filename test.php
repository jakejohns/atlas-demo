#!/usr/bin/env php
<?php
// @codingStandardsIgnoreFile

namespace App;

require './vendor/autoload.php';

use Atlas\Orm\AtlasContainer;
use App\Data\Entry\EntryMapperEvents;

$atlasContainer = new AtlasContainer('sqlite:./data/app.db');

$atlasContainer->setFactoryFor(
    EntryMapperEvents::class,
    function () use ($atlasContainer) {
        return new EntryMapperEvents(
            new Repository\SyncTags($atlasContainer->getAtlas())
        );
    }
);

$atlasContainer->setMappers(
    [
        Data\Entry\EntryMapper::class,
        Data\Tag\TagMapper::class,
        Data\Tagging\TaggingMapper::class
    ]
);


$atlas = $atlasContainer->getAtlas();


// Create a tag
$tag = $atlas->newRecord(Data\Tag\TagMapper::class, ['slug' => 'test', 'title'=>'Test']);
$atlas->insert($tag);


$repo = new Repository\Create($atlas);


$entry = $repo->create(
    [
        'slug'  => 'test',
        'title' => 'This is a Title',
        'body'  => 'Some Content',
        'tags'  => ['Hello World', 'test', 'First Post']
    ]
);


function format($entry) {
    echo sprintf("%s) %s \n", $entry->entry_id, $entry->slug);
    echo sprintf("## %s \n", $entry->title);
    echo sprintf("> %s \n", $entry->body);

    foreach ($entry->tags as $tag) {
        echo sprintf('[%s: %s] ', $tag->slug, $tag->title);
    }

    echo "\n\n";
    echo str_repeat('#', 15);
    echo "\n\n";
}

if ($entry) {
    format($entry);
}


$entry->tags[] = 'bing';
$entry->title = "New Title";

$entry = $repo->update($entry->entry_id, $entry->getArrayCopy());


format($entry);

