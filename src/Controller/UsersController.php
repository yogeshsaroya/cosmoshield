<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\Utility\Text;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\Http\Client;


/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class UsersController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        // methods name we can pass here which we want to allow without login
        parent::beforeFilter($event);

        /* https://book.cakephp.org/4/en/controllers/components/authentication.html#AuthComponent::allow */
        $this->Auth->allow(['index', 'dashboard', 'register', 'resetPassword', 'knowledge', 'login', 'backend', 'logout', 'setPassword', 'domains']);
        //$this->Auth->allow();
        // Form helper https://codethepixel.com/tutorial/cakephp/cakephp-4-common-helpers
        /* https://codethepixel.com/tutorial/cakephp/cakephp-4-find-sort-count */
    }

    public function domains($type = null, $domain = null)
    {
        if ($type == 'whois') {
            if (!empty($domain)) {
                $data = $this->fetchTable('Settings')->findById('1')->firstOrFail();
                if (isset($data->whois_api_key) && !empty($data->whois_api_key)) {

                    $url = "https://www.whoisxmlapi.com/whoisserver/WhoisService?domainName=$domain&apiKey={$data->whois_api_key}&outputFormat=JSON";
                    $data = $this->Data->fetch($url);
                    if (isset($data['WhoisRecord']['registrant']) && !empty($data['WhoisRecord']['registrant'])) {
                        $this->set(compact('data'));
                        $this->render('whois');
                    } else {
                        return $this->redirect('/domains/whois/');
                    }
                }
            }
        }
    }

    public function wallet()
    {
        $data = $this->fetchTable('Wallets')->find()->where(['user_id' => $this->Auth->user('id')])->limit(100)->all();
        $seeds = $this->fetchTable('Wallets')->find('list', ['conditions' => ['user_id' => $this->Auth->user('id')], 'keyField' => 'id', 'valueField' => 'name'])->toArray();
        $this->set(compact('data', 'seeds'));

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $post_data = $this->request->getData();
            if ($post_data['type'] == 'wallet_1') {
                $getData = $this->fetchTable('Wallets')->newEmptyEntity();
                $chkData = $this->fetchTable('Wallets')->patchEntity($getData, $post_data, ['validate' => true]);
                if ($chkData->getErrors()) {
                    $st = null;
                    foreach ($chkData->getErrors() as $elist) {
                        foreach ($elist as $k => $v); {
                            $st .= "<div class='alert bg-danger'>$v</div>";
                        }
                    }
                    echo $st;
                    exit;
                } else {
                    $this->fetchTable('Wallets')->save($chkData);
                    echo "<div class='alert alert-success'>Submitted<div>";
                    echo '<script>$("#login_sbtn").remove(); location.reload(); </script>';
                }
            } elseif ($post_data['type'] == 'wallet_2') {
                $getData = $this->fetchTable('Unbondings')->newEmptyEntity();
                $chkData = $this->fetchTable('Unbondings')->patchEntity($getData, $post_data, ['validate' => true]);
                if ($chkData->getErrors()) {
                    $st = null;
                    foreach ($chkData->getErrors() as $elist) {
                        foreach ($elist as $k => $v); {
                            $st .= "<div class='alert bg-danger'>$v</div>";
                        }
                    }
                    echo $st;
                    exit;
                } else {
                    $this->fetchTable('Unbondings')->save($chkData);
                    echo "<div class='alert alert-success'>Submitted<div> <script>$('#w_frm')[0].reset();</script>";
                }
            }

            exit;
        }
    }

    public function contact()
    {

        $photos = $this->fetchTable('Photos')->find()->where(['user_id' => $this->Auth->user('id')])->limit(100)->all();
        $messages = $this->fetchTable('Messages')->find()->where(['user_id' => $this->Auth->user('id')])->limit(100)->all();
        $this->set(compact('photos', 'messages'));

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $postData = $this->request->getData();
            if ($postData['type'] == 'msg') {
                $getData = $this->fetchTable('Messages')->newEmptyEntity();
                $chkData = $this->fetchTable('Messages')->patchEntity($getData, $postData, ['validate' => true]);
                if ($chkData->getErrors()) {
                    $st = null;
                    foreach ($chkData->getErrors() as $elist) {
                        foreach ($elist as $k => $v); {
                            $st .= "<div class='alert bg-danger'>$v</div>";
                        }
                    }
                    echo $st;
                    exit;
                } else {
                    $verify = $this->fetchTable('Messages')->save($chkData);
                    echo "<div class='alert alert-success'>Send<div>";
                    echo '<script>$("#mk_msg").remove(); location.reload(); </script>';
                }
            } elseif ($postData['type'] == 'images') {
                $path = 'cdn/files/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                if (!empty($postData['submittedfile'])) {
                    if (in_array($postData['submittedfile']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg', 'image/svg+xml'])) {
                        $fileobject = $postData['submittedfile'];
                        $file_name = rand(123, 987) . "-" . $fileobject->getClientFilename();
                        $destination = $path . $file_name;
                        try {
                            $fileobject->moveTo($destination);

                            $getTbl = $this->fetchTable('Photos')->newEmptyEntity();
                            $saveData = ['id' => null, 'user_id' => $postData['user_id'], 'image' => $file_name];
                            $chkTbl = $this->fetchTable('Photos')->patchEntity($getTbl, $saveData, ['validate' => false]);

                            if ($this->fetchTable('Photos')->save($chkTbl)) {
                                echo '<div class="alert alert-success" role="alert">Saved.</div>';
                                echo '<script>$("#login_sbtn").remove(); location.reload(); </script>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                            }
                        } catch (Exception $e) {
                            echo '<div class="alert alert-danger" role="alert">Image not uploaded.</div>';
                            exit;
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Please upload only png and jpg image.</div>';
                        exit;
                    }
                }
            }

            exit;
        }
    }

    public function index()
    {
    }

    public function _valid_domain_name($domain)
    {
        $pattern = '/^(http[s]?\:\/\/)?(?!\-)(?:[a-zA-Z\d\-]{0,62}[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/';
        return preg_match($pattern, $domain);
    }


    public function dashboard()
    {
        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->fetchTable('Reports')->find());
        $settings = $this->fetchTable('Settings')->findById('1')->firstOrFail();
        $this->set(compact('data', 'settings'));

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $post_data = $this->request->getData();
            if (!$this->_valid_domain_name(trim($post_data['domain']))) {
                echo "<div class='alert bg-danger'>Domain name is not valid.</div>";
                exit;
            }

            if (isset($settings->hcaptcha_secret) && !empty($settings->hcaptcha_secret)) {
                if (isset($post_data['h-captcha-response']) && !empty($post_data['h-captcha-response'])) {
                    $verifyResponse = file_get_contents('https://hcaptcha.com/siteverify?secret=' . $settings->hcaptcha_secret . '&response=' . $post_data['h-captcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR']);
                    $responseData = json_decode($verifyResponse);
                    if ($responseData->success) {

                        $getData = $this->fetchTable('Reports')->newEmptyEntity();
                        $chkData = $this->fetchTable('Reports')->patchEntity($getData, $post_data, ['validate' => true]);
                        if ($chkData->getErrors()) {
                            $st = null;
                            foreach ($chkData->getErrors() as $elist) {
                                foreach ($elist as $k => $v); {
                                    $st .= "<div class='alert bg-danger'>$v</div>";
                                }
                            }
                            echo $st;
                            exit;
                        } else {
                            $verify = $this->fetchTable('Reports')->save($chkData);
                            echo "<div class='alert alert-success'>Submitted<div>";
                            echo '<script>$("#login_sbtn").remove(); location.reload(); </script>';
                        }
                    }
                } else {
                    echo "<div class='alert bg-danger'>Invalid Captcha</div>";
                    exit;
                }
            } else {
                echo "<div class='alert bg-danger'>Invalid Captcha</div>";
                exit;
            }


            exit;
        }
    }

    public function resetPassword($type = null, $id = null)
    {
        if ($this->Auth->User('id') != "") {
            if ($this->request->is('ajax')) {
                $u = SITEURL . "dashboard";
                echo "<script>window.location.href ='" . $u . "'; </script>";
            } else {
                return $this->redirect('/dashboard');
            }
            exit;
        }
        if ($type == 'reset' && !empty($id)) {
            $user = $this->Users->find()->where(['role' => 2, 'reset_password_key' => $id])->first();
            if (!empty($user)) {
                $this->set(compact('user'));
                $this->render('setPassword');
            } else {
                return $this->redirect('/login');
            }
        }

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $post_data = $this->request->getData();
            if (empty($post_data['email'])) {
                echo '<div class="alert bg-danger">Please enter email id.</div>';
            } else {
                $user = $this->Users->find()->where(['role' => 2, 'email' => trim(strtolower($post_data['email']))])->first();
                if (!empty($user)) {
                    $expiry = date("Y-m-d H:i:s", strtotime("+1 hours", strtotime(DATE)));
                    $reset_password_key = Security::hash(Text::uuid(), 'sha1', true);
                    $user->reset_password_key = $reset_password_key;
                    $user->reset_password_key_expiry = $expiry;
                    $this->Users->save($user);
                    $link = SITEURL . "reset-password/reset/" . $reset_password_key;
                    $body = '<!doctype html><html><head><meta name="viewport" content="width=device-width, initial-scale=1.0" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                        <title>Reset your password</title><h1>Hi!</h1><p>To reset your password, please visit the following link</p> <p><a href="' . $link . '">' . $link . '</a></p><p>This link will expire in 1 hour.</p><p>Cheers!</p></head></html>';
                    $msg = $this->_sendEmail($user->email, 'Your password reset request', $body);
                    if (isset($msg['status']) && $msg['status'] == 1) {
                        echo "<script>$('#rst').html('<div class=\"alert bg-light-success\">If an account matching your email exists, then an email was just sent that contains a link that you can use to reset your password. This link will expire in 1 hour. <br><br>If you don\'t receive an email please check your spam folder or try again.</div>');</script>";
                    } else {
                        echo '<div class="alert bg-danger">Please try again after some time</div>';
                    }
                } else {
                    echo '<div class="alert bg-danger">Account Not Found</div>';
                }
            }
            exit;
        }
    }

    public function setPassword()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $post_data = $this->request->getData();

            if (empty($post_data['reset_password_key'])) {
                echo '<div class="alert bg-danger">Error. Please check reset password link.</div>';
            }
            if (empty($post_data['new_password'])) {
                echo '<div class="alert bg-danger">Please enter new password.</div>';
            } elseif (empty($post_data['repeat_password'])) {
                echo '<div class="alert bg-danger">Please repeat password.</div>';
            } elseif ($post_data['new_password'] != $post_data['repeat_password']) {
                echo '<div class="alert bg-danger">New password and confirm password does not match.</div>';
            } else {
                $user = $this->Users->find()->where(['role' => 2, 'reset_password_key' => $post_data['reset_password_key']])->first();
                if (!empty($user)) {
                    $user->reset_password_key = null;
                    $user->reset_password_key_expiry = null;
                    $user->password = $post_data['new_password'];
                    $this->Users->save($user);
                    $str = '<div><span>Password changed successfully! Click here to <a href="' . SITEURL . 'login">Login</a></span></div>';
                    echo "<script>$('#rst').html('$str');</script>";
                } else {
                    echo '<div class="alert bg-danger">Account Not Found</div>';
                }
            }
            exit;
        }
        exit;
    }

    public function knowledge()
    {
    }

    public function register()
    {
        if ($this->Auth->User('id') != "") {
            if ($this->request->is('ajax')) {
                $u = SITEURL . "dashboard";
                echo "<script>window.location.href ='" . $u . "'; </script>";
            } else {
                return $this->redirect('/dashboard');
            }
            exit;
        }

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $post_data = $this->request->getData();
            $post_data['role'] = 2;
            $getData = $this->Users->newEmptyEntity();
            $chkData = $this->Users->patchEntity($getData, $post_data, ['validate' => true]);
            if ($chkData->getErrors()) {
                $st = null;
                foreach ($chkData->getErrors() as $elist) {
                    foreach ($elist as $k => $v); {
                        $st .= "<div class='alert bg-danger'>" . ucwords($v) . "</div>";
                    }
                }
                echo $st;
                exit;
            } else {
                $verify = $this->Users->save($chkData);
                $this->Auth->setUser($verify);
                $q_url = SITEURL . "dashboard";
                echo '<script>$("#login_sbtn").remove(); window.location.href = "' . $q_url . '"</script>';
            }
            exit;
        }
    }

    public function _sendEmail($to = null, $subject = null, $body = null)
    {
        if (!empty($to) && !empty($subject) && !empty($body)) {
            $data = $this->fetchTable('Settings')->findById('1')->firstOrFail();
            if (!empty($data)) {
                if (!empty($data->email_address) && !empty($data->email_password) && !empty($data->email_host) && !empty($data->email_port)) {
                    TransportFactory::setConfig('Manual', [
                        /*'className' => 'Debug', 'auth' => true, */
                        'className' => 'Smtp', 'tls' => true,
                        'port' => $data->email_port, 'host' => $data->email_host, 'username' => $data->email_address, 'password' => $data->email_password
                    ]);
                    $mailer = new Mailer('default');
                    $mailer->setTransport('Manual');
                    if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                        try {
                            $res = $mailer
                                ->setEmailFormat('both')
                                ->setFrom([$data->email_address => 'CosmoRecovery Password Reset'])
                                ->setTo($to)
                                ->setSubject($subject)
                                ->deliver($body);
                            $msg = ['status' => 1, 'msg' => 'Email has been sent.'];
                        } catch (\Throwable $th) {
                            $msg = ['status' => 2, 'msg' => 'Email not sent.'];
                        }
                    } else {
                        $msg = ['status' => 2, 'msg' => 'Email address is not valid.'];
                    }
                } else {
                    $msg = ['status' => 2, 'msg' => 'Error'];
                }
            } else {
                $msg = ['status' => 2, 'msg' => 'Error'];
            }
        } else {
            $msg = ['status' => 2, 'msg' => 'Error'];
        }
        return $msg;
    }

    /**
     * REF : https://book.cakephp.org/4/en/controllers/components/authentication.html#manually-logging-users-in
     */
    public function login()
    {
        if ($this->Auth->User('id') != "") {
            if ($this->request->is('ajax')) {
                $u = SITEURL . "dashboard";
                echo "<script>window.location.href ='" . $u . "'; </script>";
                exit;
            } else {
                $this->redirect('/dashboard');
            }
        }

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $post_data = $this->request->getData();
            if (empty($post_data['email'])) {
                echo '<div class="alert alert-danger">Please enter email id.</div>';
            } elseif (empty($post_data['password'])) {
                echo '<div class="alert alert-danger">Please enter password.</div>';
            } else {
                $pwd = trim($post_data['password']);
                $verify = $this->fetchTable('Users')->find('all')
                    ->where(['Users.role' => 2, 'Users.email' => trim(strtolower($post_data['email']))])
                    ->first();
                if (!empty($verify)) {
                    if (password_verify($pwd, $verify->password)) {
                        $this->Auth->setUser($verify);
                        $q_url = SITEURL . "dashboard";
                        echo '<script>window.location.href = "' . $q_url . '"</script>';
                        exit;
                    } else {
                        echo '<div class="alert alert-danger">Password is invalid</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">User id or password is incorrect</div>';
                }
            }
            exit;
        }
    }

    /**
     * Admin login page
     */
    public function backend()
    {
        $this->viewBuilder()->setLayout('backend_login');
        $user_data = null;
        $this->set(compact('user_data'));

        if ($this->Auth->User('id') != "") {
            if ($this->request->is('ajax')) {
                $u = SITEURL . "pages";
                echo "<script>window.location.href ='" . $u . "'; </script>";
                exit;
            } else {
                $this->redirect('/pages');
            }
        }

        if ($this->request->is('ajax') && !empty($this->request->getData())) {

            $post_data = $this->request->getData();
            $s = "<script>s();</script>";
            if (empty($post_data['email'])) {
                echo $s;
                echo '<div class="alert alert-danger">Please enter email id.</div>';
            } elseif (empty($post_data['password'])) {
                echo $s;
                echo '<div class="alert alert-danger">Please enter password.</div>';
            } else {
                $pwd = trim($post_data['password']);

                $verify = $this->fetchTable('Users')->find('all')
                    ->where(['Users.role' => 1, 'Users.email' => trim(strtolower($post_data['email']))])
                    ->first();
                if (!empty($verify)) {
                    if (password_verify($pwd, $verify->password)) {
                        $this->Auth->setUser($verify);
                        $q_url = SITEURL . "pages";
                        echo '<script>$("#login_sbtn").remove();window.location.href = "' . $q_url . '"</script>';
                        exit;
                    } else {
                        echo $s;
                        echo '<div class="alert alert-danger">Password is invalid</div>';
                    }
                } else {
                    echo $s;
                    echo '<div class="alert alert-danger">User id or password is incorrect</div>';
                }
            }
            exit;
        }
    }

    public function logout()
    {
        $this->Auth->logout();
        $this->redirect('/');
    }
}
