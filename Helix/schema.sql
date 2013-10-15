
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- company
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255),
    `password` VARCHAR(64),
    `fullname` VARCHAR(255),
    `email` VARCHAR(128),
    `company_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `user_FI_1` (`company_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(32),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- user_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_group`;

CREATE TABLE `user_group`
(
    `user_id` INTEGER NOT NULL,
    `group_id` INTEGER NOT NULL,
    PRIMARY KEY (`user_id`,`group_id`),
    UNIQUE INDEX `user_group_U_1` (`user_id`, `group_id`),
    INDEX `user_group_FI_2` (`group_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- project
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `company_id` INTEGER,
    `name` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `project_FI_1` (`company_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- project_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_user`;

CREATE TABLE `project_user`
(
    `user_id` INTEGER NOT NULL,
    `project_id` INTEGER NOT NULL,
    PRIMARY KEY (`user_id`,`project_id`),
    UNIQUE INDEX `project_user_U_1` (`user_id`, `project_id`),
    INDEX `project_user_FI_2` (`project_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- project_tab
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_tab`;

CREATE TABLE `project_tab`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `position` INTEGER,
    `project_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `project_tab_FI_1` (`project_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- project_story
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_story`;

CREATE TABLE `project_story`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `position` INTEGER,
    `text` VARCHAR(255),
    `time_estimate` FLOAT,
    `time_spend` FLOAT,
    `owner_id` INTEGER,
    `appointed_id` INTEGER,
    `project_id` INTEGER,
    `project_tab_id` INTEGER,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `project_story_FI_1` (`owner_id`),
    INDEX `project_story_FI_2` (`appointed_id`),
    INDEX `project_story_FI_3` (`project_id`),
    INDEX `project_story_FI_4` (`project_tab_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
