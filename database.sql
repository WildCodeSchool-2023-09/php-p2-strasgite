-- Active: 1698143962948@@127.0.0.1@3306
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;

SET
    @OLD_FOREIGN_KEY_CHECKS = @ @FOREIGN_KEY_CHECKS,
    FOREIGN_KEY_CHECKS = 0;

SET
    @OLD_SQL_MODE = @ @SQL_MODE,
    SQL_MODE = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------

-- Schema strasgite

-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS strasgite DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
-- -----------------------------------------------------

-- Schema strasgite

-- -----------------------------------------------------

USE `strasgite` ;

-- -----------------------------------------------------

-- Table `strasgite`.`image`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `strasgite`.`image` (
        `id_image` INT NOT NULL AUTO_INCREMENT,
        `img` TEXT NOT NULL,
        `name` VARCHAR(45) NOT NULL,
        `status` VARCHAR(45) NULL,
        PRIMARY KEY (`id_image`)
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `strasgite`.`options`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `strasgite`.`options` (
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
    IF NOT EXISTS `strasgite`.`categories` (
        `id_categories` INT NOT NULL AUTO_INCREMENT,
        `nb_personnes` INT NOT NULL,
        `taille` INT NOT NULL,
        `theme` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`id_categories`)
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `strasgite`.`chambre`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `strasgite`.`chambre` (
        `id_chambre` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(45) NOT NULL,
        `id_option` INT NULL,
        `is_available` TINYINT NOT NULL,
        `id_categorie` INT NOT NULL,
        `prix` FLOAT NOT NULL,
        `id_image` INT NOT NULL,
        PRIMARY KEY (`id_chambre`),
        INDEX `id_image_idx` (`id_image` ASC) VISIBLE,
        INDEX `id_option_idx` (`id_option` ASC) VISIBLE,
        INDEX `id_categorie_idx` (`id_categorie` ASC) VISIBLE,
        CONSTRAINT `id_image` FOREIGN KEY (`id_image`) REFERENCES `strasgite`.`image` (`id_image`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `id_option` FOREIGN KEY (`id_option`) REFERENCES `strasgite`.`options` (`id_options`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `id_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `strasgite`.`categories` (`id_categories`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `strasgite`.`user`

... (99 lignes restantes)