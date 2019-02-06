<?php
/**
 * Created by IntelliJ IDEA.
 * User: LobastovG
 * Date: 10.01.2019
 * Time: 9:01
 */

namespace App\Controller;

use App\Entity\FormDataRequest;
use App\Repository\SettingRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class FormController extends AbstractController
{
    /**
     * @Route("/ajax/sendform", name="send_form")
     * @param Request $request
     * @param ObjectManager $manager
     * @param SettingRepository $settingRepository
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function sendRequest(Request $request, ObjectManager $manager, SettingRepository $settingRepository, \Swift_Mailer $mailer)
    {
        if ($request->isXmlHttpRequest()) {
            $status = true;
            $errors = [];
            $form = [];

            $form_name = $request->get('form_name');

            if ($form_name === 'Отправить заявку на расчет') {
                if (empty($request->get('email'))) {
                    $errors['email'] = 'Вы не ввели E-mail';
                } else {
                    $form['email'] = $request->get('email');
                }
                if (empty($request->get('phone'))) {
                    $errors['phone'] = 'Вы не ввели телефон';
                }
            } else if ($form_name === 'Отправить вопрос'){
                if (empty($request->get('phone'))) {
                    $errors['phone'] = 'Вы не ввели телефон';
                }
                if (empty($request->get('message'))) {
                    $errors['message'] = 'Вы не ввели вопрос';
                } else {
                    $form['message'] = $request->get('message');
                }
            } else {
                if (empty($request->get('phone'))) {
                    $errors['phone'] = 'Вы не ввели телефон';
                }
            }

            if (count($errors) > 0) {
                $status = false;
            } else {
                // save data in db
                $form['form_name'] = $form_name;
                $form['phone'] = $request->get('phone');

                $settings = $settingRepository->findByPage();
                $sendTo = $settings['send_to']->getValue();

                $formData = new FormDataRequest();
                $formData->setRaw($form);
                $manager->persist($formData);
                $manager->flush();

                // send message by email
                $mes = (new \Swift_Message($form_name))
                    ->setFrom(['idomkarkas@yandex.ru' => 'noreply'])
                    ->setTo([$sendTo])
                    ->setBcc(['monitoring@palax.info'])
                    ->setBody(
                        $this->renderView(
                            'email/_email.html.twig',
                            [
                                'form' => $form
                            ]
                        ),
                        'text/html'
                    );
                $mailer->send($mes);
            }

            return $this->json([
                'status' => $status,
                'errors' => $errors,
            ]);
        } else {
            return $this->redirectToRoute('homepage');
        }
    }

}
