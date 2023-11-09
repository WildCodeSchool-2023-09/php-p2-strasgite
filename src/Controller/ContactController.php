<?php

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{
    public function index(): string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $contact = array_map('trim', $_POST);
            if ($contact['lastname'] === "") {
                $errors['lastname'] = "veuillez remplir votre nom";
            }
            if ($contact['firstname'] === "") {
                $errors['firstname'] = "veuillez remplir votre Prénom";
            }
            if ($contact['phone'] === "") {
                $errors['phone'] = "veuillez remplir votre numéro";
            }
            if ($contact['email'] === "") {
                $errors['email'] = "veuillez remplir votre adresse e-mail";
            }
            if (empty($errors)) {
                $contactManager = new ContactManager();
                $contact = $contactManager->insert($contact);
                header('Location: /');
            }
        }
        return $this->twig->render('contact/_contact.html.twig', [
          'errors' => $errors
        ]);
    }
}
