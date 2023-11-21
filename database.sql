
-- -----------------------------------------------------

-- Schema strasgite

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `options` (
        `id_options` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(45) NOT NULL,
        `is_available` TINYINT NOT NULL,
        `prix` FLOAT NOT NULL,
        PRIMARY KEY (`id_options`)
    ) ENGINE = InnoDB;
INSERT INTO
    options (name, is_available, prix) VALUES ('Petit déjeuner', 1, 10), ('Demi-pension', 1, 20), ('Pension complète', 1, 30);


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

INSERT INTO
    `chambre` (
        name,
        is_available,
        id_categorie,
        prix,
        description
    )
VALUES (
        'Chambre Chalet',
        1,
        1,
        90,
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex 
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. Duis aute 
                irure dolor in reprehenderit in voluptate velit esse cillum dolore.'
    ), (
        'Chambre Pierre',
        1,
        1,
        80,
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex 
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. Duis aute 
                irure dolor in reprehenderit in voluptate velit esse cillum dolore.'
    ), (
        'Chambre Chic',
        1,
        1,
        100,
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex 
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. Duis aute 
                irure dolor in reprehenderit in voluptate velit esse cillum dolore.'
    ), (
        'Chambre Botanique',
        1,
        1,
        80,
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex 
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. Duis aute 
                irure dolor in reprehenderit in voluptate velit esse cillum dolore.'
    );


-- -----------------------------------------------------

-- Table `strasgite`.`image`

-- -----------------------------------------------------

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

INSERT INTO `image` (
    id_chambre_img,
    img,
    name
) VALUES (
    1,
    'assets/images/chambre-chalet.jpg',
    'Chambre Chalet'
), (
    1,
    'assets/images/deux-petits-lits.jpg',
    'Chambre Chalet deux petits lits'
), (
    2,
    'assets/images/chambre-pierre.jpg',
    'Chambre en Pierre'
), (
    2,
    'assets/images/salle-de-bain-pierre.jpg',
    'Salle de bain de la chambre en pierre'
), (
    2,
    'assets/images/deux-lits3.jpg',
    'Chambre en Pierre deux petits lits'
), (
    3,
    'assets/images/pexels-max-rahubovskiy-6587907.jpg',
    'Chambre Chic'
), (
    3,
    'assets/images/salon-moderne2.jpg',
    'Salon chambre chic'
), (
    4,
    'assets/images/chambre-botanique.jpg',
    'Chambre Botanique'
), (
    4,
    'assets/images/salon-avec-plantes.jpg',
    'Salon de la chambre botanique'
), (
    1,
    'assets/images/salle-a-manger-chalet.jpg',
    'Salle à manger de la chambre chalet'
), (
    1,
    'assets/images/cuisine-chalet.jpg',
    'Cuisine de la chambre chalet'
), (
    1,
    'assets/images/salle-de-bain-chalet.jpg',
    'Salle de bain de la chambre chalet'
), (
    1,
    'assets/images/salon-chalet.jpg',
    'Salon de la chambre chalet'
), (
    1,
    'assets/images/bureau-chalet.jpg',
    'Bureau de la chambre chalet'
), (
    1,
    'assets/images/toilette-chalet.jpg',
    'Toilettes de la chambre chalet'
), (
    2,
    'assets/images/douche-pierre.jpg',
    'Douche de la chambre en pierre'
), (
    2,
    'assets/images/salle-a-manger-pierre.jpg',
    'Salle à manger de la chambre en pierre'
), (
    2,
    'assets/images/salon-pierre.jpg',
    'Salon de la chambre en pierre'
), (
    2,
    'assets/images/toilette-pierre.jpg',
    'Toilettes de la chambre en pierre'
), (
    2,
    'assets/images/cuisine-pierre.jpg',
    'Cuisine de la chambre en pierre'
), (
    3,
    'assets/images/salle-manger-chic.jpg',
    'Salle à manger de la chambre chic'
), (
    3,
    'assets/images/bureau-chic.jpg',
    'Bureau de la chambre chic'
), (
    3,
    'assets/images/toilette-chic.jpg',
    'Toilettes de la chambre chic'
), (
    3,
    'assets/images/cuisine-chic.jpg',
    'Cuisine de la chambre chic'
), (
    3,
    'assets/images/salle-de-bain-chic.webp',
    'Salle de bain de la chambre chic'
), (
    4,
    'assets/images/cuis-sallem-bot.jpg',
    'Cuisine et salle à manger de la ch. botanique'
), (
    4,
    'assets/images/salle-de-bain-botanique.jpg',
    'Salle de bain de la chambre botanique'
), (
    4,
    'assets/images/toilette-botanique.jpg',
    'Toilettes de la chambre botanique'
), (
    4,
    'assets/images/bureau-botanique.webp',
    'Bureau de la chambre botanique'
);


-- -----------------------------------------------------

-- Table `strasgite`.`options`

-- -----------------------------------------------------
-- -----------------------------------------------------

-- Table `strasgite`.`categories`

-- -----------------------------------------------------



-- -----------------------------------------------------

-- Table `strasgite`.`user`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `user` (
        `id_user` INT NOT NULL AUTO_INCREMENT,
        `firstname` VARCHAR(150) NOT NULL,
        `lastname` VARCHAR(150) NOT NULL,
        `email` VARCHAR(50) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `adresse` VARCHAR(100) NOT NULL,
        `tel` INT NOT NULL,
        `profession` VARCHAR(100) NOT NULL,
        `isadmin` TINYINT NULL,
        PRIMARY KEY (`id_user`)
    ) ENGINE = InnoDB;

INSERT INTO `user` (`firstname`, `lastname`, `email`, `password`, `adresse`, `tel`, `profession`, `isadmin`) VALUES
 ('yavuz', 'yavuz', 'yavuz@yavuz.com', '$2y$10$/RTidqukVvJGUsTvAZSrK.ovYHT5u6QEVusap7pCohiONW7wZZep2', 'yavuz', 123456789, 'Autres', 1);

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
