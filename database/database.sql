CREATE SCHEMA IF NOT EXISTS `devboard` DEFAULT CHARACTER SET utf8mb4;

USE `devboard`;

CREATE TABLE IF NOT EXISTS `user` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `-username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `workspace` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `user_id` INT NOT NULL,
    PRIMARY KEY (`id`, `user_id`),
    UNIQUE INDEX `name_UNIQUE` (`name` ASC),
    INDEX `fk_workspace_user_idx` (`user_id` ASC),
    CONSTRAINT `fk_workspace_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `project` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(100) NULL,
    `date_added` DATETIME NOT NULL,
    `date_modified` DATETIME NULL,
    `user_id` INT NOT NULL,
    `workspace_id` INT NOT NULL,
    PRIMARY KEY (`id`, `user_id`, `workspace_id`),
    UNIQUE INDEX `date_added_UNIQUE` (`date_added` ASC),
    UNIQUE INDEX `date_modified_UNIQUE` (`date_modified` ASC),
    UNIQUE INDEX `name_UNIQUE` (`name` ASC),
    INDEX `fk_project_user_idx` (`user_id` ASC),
    INDEX `fk_project_workspace_idx` (`workspace_id` ASC),
    CONSTRAINT `fk_project_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_project_workspace`
    FOREIGN KEY (`workspace_id`)
    REFERENCES `workspace` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `technology` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `project_technologies` (
    `project_id` INT NOT NULL,
    `technology_id` INT NOT NULL,
    PRIMARY KEY (`project_id`, `technology_id`),
    INDEX `fk_project_technologies_technology_idx` (`technology_id` ASC),
    INDEX `fk_project_technologies_project_idx` (`project_id` ASC),
    CONSTRAINT `fk_project_technologies_project`
    FOREIGN KEY (`project_id`)
    REFERENCES `project` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_project_technologies_technology`
    FOREIGN KEY (`technology_id`)
    REFERENCES `technology` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `activity` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `project_id` INT NOT NULL,
    PRIMARY KEY (`id`, `project_id`),
    INDEX `fk_activity_project_idx` (`project_id` ASC),
    CONSTRAINT `fk_activity_project`
    FOREIGN KEY (`project_id`)
    REFERENCES `project` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `stage` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `project_id` INT NOT NULL,
    PRIMARY KEY (`id`, `project_id`),
    INDEX `fk_stage_project_idx` (`project_id` ASC),
    CONSTRAINT `fk_stage_project`
    FOREIGN KEY (`project_id`)
    REFERENCES `project` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `priority` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `story` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `content` VARCHAR(100) NOT NULL,
    `is_complete` TINYINT NULL,
    `activity_id` INT NOT NULL,
    `priority_id` INT NOT NULL,
    PRIMARY KEY (`id`, `activity_id`, `priority_id`),
    INDEX `fk_story_activity_idx` (`activity_id` ASC),
    INDEX `fk_story_priority_idx` (`priority_id` ASC),
    CONSTRAINT `fk_story_activity`
    FOREIGN KEY (`activity_id`)
    REFERENCES `activity` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_story_priority`
    FOREIGN KEY (`priority_id`)
    REFERENCES `priority` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `card` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255) NULL,
    `is_complete` TINYINT NULL,
    `stage_id` INT NOT NULL,
    PRIMARY KEY (`id`, `stage_id`),
    INDEX `fk_card_stage_idx` (`stage_id` ASC),
    CONSTRAINT `fk_card_stage`
    FOREIGN KEY (`stage_id`)
    REFERENCES `stage` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `story_cards` (
    `story_id` INT NOT NULL,
    `card_id` INT NOT NULL,
    PRIMARY KEY (`story_id`, `card_id`),
    INDEX `fk_story_cards_card_idx` (`card_id` ASC),
    INDEX `fk_story_cards_story_idx` (`story_id` ASC),
    CONSTRAINT `fk_story_cards_story`
    FOREIGN KEY (`story_id`)
    REFERENCES `story` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_story_cards_card`
    FOREIGN KEY (`card_id`)
    REFERENCES `card` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `task` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `content` VARCHAR(255) NOT NULL,
    `info` VARCHAR(255) NULL,
    `card_id` INT NOT NULL,
    PRIMARY KEY (`id`, `card_id`),
    INDEX `fk_task_card_idx` (`card_id` ASC),
    CONSTRAINT `fk_task_card`
    FOREIGN KEY (`card_id`)
    REFERENCES `card` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
