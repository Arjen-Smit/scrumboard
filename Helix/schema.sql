
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- pbi
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pbi`;

CREATE TABLE `pbi`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(32),
    `description` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- Helix_router
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Helix_router`;

CREATE TABLE `Helix_router`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `active` TINYINT(1) DEFAULT 0,
    `seolink` VARCHAR(255) NOT NULL,
    `module` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- Helix_router_argument
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Helix_router_argument`;

CREATE TABLE `Helix_router_argument`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `router_id` INTEGER NOT NULL,
    `key` VARCHAR(32),
    `value` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `Helix_router_argument_FI_1` (`router_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
