<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        $team = ['Andrei', 'Kingsley', 'Julia', 'Kacper', 'Rebecca', 'Junaid', 'Jesse', 'Oliver', 'Nathan'];

        return $this->render('home/index.html.twig', [
            'name' => 'BandFarm',
            'team' => $team,
        ]);
    }

    #[Route('/hello/world', name: 'hello')]
    public function world(): Response
    {
        return $this->render('home/hello.html.twig');
    }

    public function hello_wild(string $name): Response
    {
        return $this->render('home/hello_wild.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/increment/{digit}', name: 'increment', requirements: ['digit' => '\d'])]
    public function incrementAction(int $digit): Response
    {
        return $this->render('home/increment.html.twig', [
            'digit'  => $digit,
            'result' => $digit + 1,
        ]);
    }

    #[Route('/{salutation}/{name}', name: 'salutation', requirements: ['salutation' => 'hello|hi|welcome'])]
    public function salutation(string $salutation, string $name): Response
    {
        return $this->render('home/salutation.html.twig', [
            'salutation' => $salutation,
            'name'       => $name,
        ]);
    }

    #[Route('/contacts', name: 'contacts')]
    public function contactsAction(): Response
    {
        $contacts = [
            ['name' => 'Jane Smith', 'email' => 'jane@smith.com'],
            ['name' => 'John Smith', 'email' => 'john@smith.com'],
            ['name' => 'Bill Gates', 'email' => 'bill@microsoft.com'],
        ];

        return $this->render('home/contacts.html.twig', [
            'contacts' => $contacts,
        ]);
    }
}
