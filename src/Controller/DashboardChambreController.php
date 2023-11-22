<?php

namespace App\Controller;

use App\Model\ImageManager;
use App\Model\OptionManager;
use App\Model\CategorieManager;
use App\Model\DashboardChambreManager;

class DashboardChambreController extends AbstractController
{
    public function index()
    {
        if (
            !isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])
        ) {
            header('Location:/');
        } else {
            $dashboardCManager = new DashboardChambreManager();
            return $this->twig->render(
                'Admin/Chambre/index.html.twig',
                ['stuffs' => $dashboardCManager->selectAllStuff()]
            );
        }
    }
    public function new()
    {
        $categorieManager = new CategorieManager();
        $optionManager = new OptionManager();
        $errors = [];
        $required = ['name', 'prix', 'description'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    $errors[$field] = 'Ce champ est requis';
                }
            }
            if (empty($errors)) {
                $chambre = [];
                $chambre['name'] = $_POST['name'];
                $chambre['id_option'] = $_POST['id_option'];
                $chambre['id_categorie'] = $_POST['id_categorie'];
                $chambre['prix'] = $_POST['prix'];
                $chambre['description'] = $_POST['description'];
                $chambre['id_chambre_img'] = $_POST['id_chambre_img'];

                $dashboardCManager = new DashboardChambreManager();
                $dashboardCManager->insert($chambre);
                header('Location:/admin/Chambre');
                return;
            }
        }
        return $this->twig->render('Admin/Chambre/new.html.twig', [
            'categories' => $categorieManager->selectAll(),
            'options' => $optionManager->selectAll(),
            'errors' => $errors
        ]);
    }

    public function deleteChambre(): void
    {
        $dashboardCManager = new DashboardChambreManager();
        $dashboardCManager->delete($_GET['id']);
        header('Location:/admin/Chambre');
    }

    public function editChambre(int $id)
    {
        $dashboardCManager = new DashboardChambreManager();
        $categorieManager = new CategorieManager();
        $optionManager = new OptionManager();
        $chambre = $dashboardCManager->selectOneById($id);
        $errors = [];
        $required = ['name', 'prix', 'description'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    $errors[$field] = 'Ce champ est requis';
                }
            }
            if (empty($errors)) {
                $chambre = array_map('trim', $_POST);
                $dashboardCManager->update($chambre);
                header('Location:/admin/Chambre');
                return;
            }
        }
        return $this->twig->render('Admin/Chambre/edit.html.twig', [
            'chambre' => $chambre,
            'categories' => $categorieManager->selectAll(),
            'options' => $optionManager->selectAll(),
            'errors' => $errors
        ]);
    }

    public function addFiles()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadDir = __DIR__ . '/../../public/assets/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }
            $chambreId = $_POST['id'];
            $imageManager = new ImageManager();
            foreach ($_FILES['img']['tmp_name'] as $index => $tmpName) {
                $fileName = $_FILES['img']['name'][$index];
                move_uploaded_file($tmpName, $uploadDir . $fileName);
                $imageManager->insertImage($chambreId, $uploadDir . $fileName, $fileName);
            }

            header('Location:/admin/Chambre');
            
            }
    }
}
