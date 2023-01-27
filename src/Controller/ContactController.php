<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @Route("api/contact", name="create_contact", methods={"POST"})
     */
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $messageForDay = $this->contactRepository
                              ->findMessagesByDay($data['email']);
        if ($messageForDay) {
            return new JsonResponse(['status' => 'only one message per day!'], Response::HTTP_IM_USED);
        }
        
        $this->contactRepository->create($data);

        return new JsonResponse(['status' => 'Contact created!'], Response::HTTP_CREATED);
    }
}
