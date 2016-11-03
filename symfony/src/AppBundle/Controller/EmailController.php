<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Email;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;


class EmailController extends FOSRestController
{
    /**
     * Creates a new email from the submitted data.
     *
     *
     * @param Request $request the request object
     *
     */
    public function postEmailsAction(Request $request)
    {

        if ($request->request->get('json')) {
            $emails = json_decode($request->request->get('json'), true);
        } else {
            $json = json_decode($request->getContent(), true);
            $emails = $json;
        }

//        {
//            "from": "…",
//            "to": "…",
//            "subject": "…",
//            "message": "…"
//        }

        if ($emails) {
            foreach ($emails as $emailData) {
                $email = new Email();
                $email->setRecipient($emailData['to']);
                try {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($emailData['subject'])
                        ->setFrom($emailData['from'])
                        ->setTo($emailData['to'])
                        ->setBody(
                            $emailData['message'],
                            'text/html'
                        );
                    $res = $this->get('mailer')->send($message);
                    if ($res == 0) {
                        $email->setResult('Problem sending email');
                    } else {
                        $email->setResult('Email sent ok');
                    }

                } catch (\Exception $e) {
                    $email->setResult('Problem sending email: '.$e->getMessage());
                }

                $this->getDoctrine()->getManager()->persist($email);
                $this->getDoctrine()->getManager()->flush();
            }
        }

        return new JsonResponse(['success' => true]);
    }

    /**
     *
     * Creates a new email from the submitted data.
     *
     *
     * @Annotations\View()
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface[]|View
     */
    public function getEmailsAction(Request $request)
    {

        $emails = $this->getDoctrine()->getRepository('AppBundle:Email')->findBy([],['createdAt'=>'DESC']);
        return [
            'emails' => $emails,
        ];
    }

}
