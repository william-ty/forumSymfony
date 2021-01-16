<?php

namespace App\Controller;

use App\Entity\Topic;
use App\Entity\Message;
use App\Form\TopicFormType;
use App\Form\MessageFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/forum")
 */
class TopicController extends AbstractController
{
    /**
     * @Route("/topics", name="topics")
     */
    public function index(): Response
    {
        $topics = $this->getDoctrine()
            ->getRepository(Topic::class)
            ->getAll();

        return $this->render('topic/index.html.twig', [
            'topics' => $topics
        ]);

        // return new JsonResponse(Json_encode($topics));
    }

    /**
     * @Route("/topic/create", name="topics_create")
     * @Route("/{id}/edit", name="topic_edit", methods="GET")
     */
    public function createTopic(Request $request, Topic $topic = null): Response
    {
        if (!$topic) {
            $topic = new Topic();
        }

        $form = $this->createForm(TopicFormType::class, $topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $topic->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($topic);
            $entityManager->flush();

            return $this->redirectToRoute('topics');
        }

        return $this->render('topic/create.html.twig', [
            'topicForm' => $form->createView(),
            'editMode' => $topic->getId() !== null
        ]);
    }

    /**
     * @Route("/topic/{id}", name="topic_show")
     * @Route("/topic/{id}/create_message/", name="messages_create")
     * @Route("/{id}/message_edit", name="message_edit", methods="GET")
     */
    public function showTopicAddMessage(Request $request, Topic $topic)
    {
        $message = new Message();
        $form = $this->createForm(MessageFormType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $message = $form->getData();

            $message->setUser($this->getUser());
            $message->setTopic($topic);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('topic_show', ['id' => $topic->getId()]);
        }

        return $this->render('topic/show.html.twig', [
            'topic' => $topic,
            'messageForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/lock", name="topic_lock")
     */
    public function lockedTopic(Topic $topic = null)
    {

        $entityManager = $this->getDoctrine()->getManager();

        if (!$topic->getLocked()) {
            $topic->setLocked(true);
        } else {
            $topic->setLocked(false);
        }

        $entityManager->persist($topic);
        $entityManager->flush();

        return $this->redirectToRoute('topics');
    }

    /**
     * @Route("/{id}/delete", name="topic_delete")
     */
    public function deleteTopic(Topic $topic = null)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($topic);
        $entityManager->flush();

        return $this->redirectToRoute('topics');
    }

    /**
     * @Route("/{id}/message_delete", name="message_delete")
     */
    public function deleteMessage(Message $message = null, Topic $topic)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($message);
        $entityManager->flush();

        return $this->redirectToRoute('topic_show', ['id' => $message->getTopic()->getId()]);
    }
}
