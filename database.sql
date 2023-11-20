-- SQLBook: Code

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@SESSION.UNIQUE_CHECKS, UNIQUE_CHECKS=0;

SET
    @OLD_FOREIGN_KEY_CHECKS = @@SESSION.FOREIGN_KEY_CHECKS,
    FOREIGN_KEY_CHECKS = 0;

SET
    @OLD_SQL_MODE = @@SESSION.SQL_MODE,
    SQL_MODE = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------

-- Schema strasgite

-- -----------------------------------------------------

-- -----------------------------------------------------

-- Schema strasgite

-- -----------------------------------------------------

-- -----------------------------------------------------

-- Table `strasgite`.`image`

-- -----------------------------------------------------

-- -----------------------------------------------------

-- Table `strasgite`.`options`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `options` (
        `id_options` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(45) NOT NULL,
        `is_available` TINYINT NOT NULL,
        `prix` FLOAT NOT NULL,
        PRIMARY KEY (`id_options`)
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `strasgite`.`categories`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `categories` (
        `id_categories` INT NOT NULL AUTO_INCREMENT,
        `nb_personnes` INT NOT NULL,
        `taille` INT NOT NULL,
        `theme` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`id_categories`)
    ) ENGINE = InnoDB;

INSERT INTO
    categories (nb_personnes, taille, theme)
VALUES (2, 15, 'chalet');

-- -----------------------------------------------------

-- Table `strasgite`.`chambre`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `chambre` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(45) NOT NULL,
        `id_option` INT NULL,
        `is_available` TINYINT NOT NULL,
        `id_categorie` INT NOT NULL,
        `prix` FLOAT NOT NULL,
        `description` TEXT NOT NULL,
        PRIMARY KEY (`id`),
        INDEX `id_option_idx` (`id_option` ASC) VISIBLE,
        INDEX `id_categorie_idx` (`id_categorie` ASC) VISIBLE,
        CONSTRAINT `id_option` FOREIGN KEY (`id_option`) REFERENCES `strasgite`.`options` (`id_options`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `id_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `strasgite`.`categories` (`id_categories`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

CREATE TABLE
    IF NOT EXISTS `image` (
        `id_image` INT NOT NULL AUTO_INCREMENT,
        `id_chambre_img` INT NOT NULL,
        `img` TEXT NOT NULL,
        `name` VARCHAR(45) NOT NULL,
        `status` VARCHAR(45) NULL,
        PRIMARY KEY (`id_image`),
        CONSTRAINT `id_chambre_img` FOREIGN KEY (`id_chambre_img`) REFERENCES `strasgite`.`chambre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

INSERT INTO
    chambre (
        name,
        is_available,
        id_categorie,
        prix,
        description
    )
VALUES (
        'chambre1',
        1,
        1,
        90,
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex 
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. Duis aute 
                irure dolor in reprehenderit in voluptate velit esse cillum dolore.'
    ), (
        'chambre2',
        1,
        1,
        80,
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex 
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. Duis aute 
                irure dolor in reprehenderit in voluptate velit esse cillum dolore.'
    );

-- -----------------------------------------------------

-- Table `strasgite`.`user`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `user` (
        `id_user` INT NOT NULL AUTO_INCREMENT,
        `firstname` VARCHAR(150) NOT NULL,
        `lastname` VARCHAR(150) NOT NULL,
        `email` VARCHAR(50) NOT NULL,
        `password` VARCHAR(45) NOT NULL,
        `adresse` VARCHAR(100) NOT NULL,
        `tel` INT NOT NULL,
        `profession` VARCHAR(100) NOT NULL,
        `isadmin` TINYINT NULL,
        PRIMARY KEY (`id_user`)
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `strasgite`.`reservation`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `reservation` (
        `id_reservation` INT NOT NULL AUTO_INCREMENT,
        `chambre_id` INT NOT NULL,
        `id_user` INT NOT NULL,
        `firstname` VARCHAR(255) NOT NULL,
        `lastname` VARCHAR(255) NOT NULL,
        `date_entry` DATE NOT NULL,
        `date_exit` DATE NOT NULL,
        `demand` TEXT,
        PRIMARY KEY (`id_reservation`),
        INDEX `id_chambre_idx` (`chambre_id` ASC) VISIBLE,
        INDEX `id_user_idx` (`id_user` ASC) VISIBLE,
        CONSTRAINT `id_chambre` FOREIGN KEY (`chambre_id`) REFERENCES `strasgite`.`chambre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `strasgite`.`user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `strasgite`.`contact`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `contact` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `lastname` VARCHAR(50) NOT NULL,
        `firstname` VARCHAR(50) NOT NULL,
        `phone` INT NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `reason` VARCHAR(50) NOT NULL,
        `content` TEXT NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `strasgite`.`favoris`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `favoris` (
        `id_favoris` INT NOT NULL AUTO_INCREMENT,
        `favori_id_user` INT NOT NULL,
        `favori_id_chambre` INT NOT NULL,
        `favori` TINYINT NOT NULL,
        `favoriscol` VARCHAR(45) NULL,
        PRIMARY KEY (`id_favoris`),
        INDEX `id_chambre_idx` (`favori_id_chambre` ASC) VISIBLE,
        INDEX `id_user_idx` (`favori_id_user` ASC) VISIBLE,
        CONSTRAINT `favori_id_chambre` FOREIGN KEY (`favori_id_chambre`) REFERENCES `strasgite`.`chambre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `favori_id_user` FOREIGN KEY (`favori_id_user`) REFERENCES `strasgite`.`user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `strasgite`.`avis`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `avis` (
        `id_avis` INT NOT NULL AUTO_INCREMENT,
        `avis_id_chambre` INT NOT NULL,
        `avis_id_user` INT NOT NULL,
        `content` TEXT NOT NULL,
        `rating` INT NOT NULL,
        PRIMARY KEY (`id_avis`),
        INDEX `id_chambre_idx` (`avis_id_chambre` ASC) VISIBLE,
        INDEX `id_user_idx` (`avis_id_user` ASC) VISIBLE,
        CONSTRAINT `avis_id_chambre` FOREIGN KEY (`avis_id_chambre`) REFERENCES `strasgite`.`chambre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `avis_id_user` FOREIGN KEY (`avis_id_user`) REFERENCES `strasgite`.`user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;