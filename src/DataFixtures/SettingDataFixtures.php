<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillrossokhin
 * Date: 07.09.2018
 * Time: 11:23
 */

namespace App\DataFixtures;


use App\Entity\Setting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SettingDataFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $settings = [
            [
                'code' => 'main_phone',
                'name' => 'Основной телефон',
                'value' => '8 (888) 888–88–88',
            ],
            [
                'code' => 'address',
                'name' => 'Адресс',
                'value' => 'Санкт-Петербург, ул. Большая Зеленина, д. 13 (вход со двора)',
            ],
            [
                'code' => 'phone',
                'name' => 'Телефон',
                'value' => '8 (812) 44-807-44',
            ],
            [
                'code' => 'email',
                'name' => 'Email',
                'value' => 'help.itworks@yandex.ru',
            ]
        ];

        foreach ($settings as $setting) {
            $s = new Setting();
            $s->setCode($setting['code']);
            $s->setName($setting['name']);
            $s->setValue($setting['value']);

            $manager->persist($s);
        }

        $manager->flush();
    }

}
