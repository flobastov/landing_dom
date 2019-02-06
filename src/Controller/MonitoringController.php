<?php
/**
 * Created by IntelliJ IDEA.
 * User: LobastovG
 * Date: 18.01.2019
 * Time: 10:11
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MonitoringController extends AbstractController
{

    /**
     * @Route("/monitoring", name="monitoring")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function startMonitoring(Request $request)
    {
        if ($request->isMethod('POST')) {
            $pass = $request->request->get('pass');
            $excluded = $request->request->get('exclude');

            $version = 2;

            $errors = array();
            $result = '';

            if (empty($pass)) {
                $errors[] = 'Не указан пароль доступа';
            } elseif (!empty($pass) && md5($pass) != '766e9681d3f4a86e5dc50004fc91f7f7') {
                $errors[] = 'Неверный пароль доступа';
            }

            if (empty($errors)) {

                // мониторинг
                if (isset($_POST['monitoring'])) {
                    try {
                        $filter = array();
                        if (isset($excluded) && is_array($excluded)) {
                            foreach ($excluded as $val) {
                                $exclude = explode('|', $val);
                                $path = array_shift($exclude);
                                $filter[$_SERVER['DOCUMENT_ROOT'] . $path] = $exclude;
                            }
                        }
                        $files = $this->getDirectoryTree($_SERVER['DOCUMENT_ROOT'], $filter);
                        //добавляет корневую папку в начало
                        array_unshift($files, $this->getInfo($_SERVER['DOCUMENT_ROOT']));
                        $result = $files;
                    } catch (\Exception $e) {
                        $errors[] = $e->getMessage();
                    }
                }
            }

            return $this->json([
                'version' => $version,
                'errors' => $errors,
                'result' => $result,
            ]);
        } else {
            return $this->redirectToRoute('homepage');
        }



    }

    // ----------- функции
    public function getDirectoryTree($dir, $filter = array())
    {
        $result = array();
        if (!is_dir($dir)) return $result;
        if (!is_readable($dir)) {
            $result[] = $this->getInfo($dir);
            return $result;
        }
        $dirs = array_diff(scandir($dir), array('.', '..'));
        foreach ($dirs as $value) {
            $path = $dir . DIRECTORY_SEPARATOR . $value;
            foreach ($filter as $key => $val) {
                if (strpos($path, $key) === 0) {
                    if (empty($val)) {
                        continue 2;
                    } elseif (is_file($path) && !in_array(pathinfo($path, PATHINFO_EXTENSION), $val)) {
                        continue 2;
                    }
                }
            }
            if (is_dir($path)) {
                foreach ($this->getDirectoryTree($path, $filter) as $value) {
                    $result[] = $value;
                }
            } else {
                $result[] = $this->getInfo($path);
            }
        }
        return $result;
    }

    public function getInfo($path)
    {
        $stat = stat($path);
        $result = array(
            'path' => $path,
            'size' => $stat['size'],
            'mtime' => date('d.m.Y H:i:s', $stat['mtime'])
        );
        return $result;
    }
}
