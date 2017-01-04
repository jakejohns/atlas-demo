
BEGIN TRANSACTION;

CREATE TABLE `tags` (
    `tag_id` INTEGER NULL PRIMARY KEY AUTOINCREMENT,
    `slug` VARCHAR(255) NULL,
    `title` VARCHAR(255) NULL
);

CREATE TABLE `taggings` (
    `tagging_id` INTEGER NULL PRIMARY KEY AUTOINCREMENT,
    `tag_id` INTEGER NULL,
    `entry_id` INTEGER NULL,
    FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`entry_id`) REFERENCES `entries` (`entry_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `entries` (
    `entry_id` INTEGER NULL PRIMARY KEY AUTOINCREMENT,
    `slug` VARCHAR(255) NULL,
    `title` VARCHAR(255) NULL,
    `body` TEXT NULL
);

CREATE UNIQUE INDEX `entry_slug` ON `entries` (`slug` ASC);
CREATE UNIQUE INDEX `tag_slug` ON `tags` (`slug` ASC);
CREATE UNIQUE INDEX `assoc` ON `taggings` (`entry_id` ASC,`tag_id` ASC);
COMMIT;
