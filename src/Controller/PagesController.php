<?php

declare(strict_types=1);

namespace App\Controller;

class PagesController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        // methods name we can pass here which we want to allow without login
        parent::beforeFilter($event);
        /* https://book.cakephp.org/4/en/controllers/components/authentication.html#AuthComponent::allow */
        $this->viewBuilder()->setLayout('backend');
        if (!in_array($this->Auth->user('role'), [1])) {
            $this->redirect('/users/logout');
        }
    }
    public function initialize(): void
    {
        parent::initialize();
    }

    /* open new popup on ajax request */
    public function openPop($id = null)
    {
        $this->autoRender = false;
        $getData = $this->request->getData();
        if (isset($getData['url']) && !empty($getData['url'])) {
            if ($id == 1) {
                echo "<script> $.magnificPopup.open({items: { src: '" . urldecode($getData['url']) . "',type: 'ajax'}, closeOnContentClick: false, closeOnBgClick: false, showCloseBtn: false, enableEscapeKey: false, }); </script>";
            } else {
                echo "<script> $.magnificPopup.open({items: { src: '" . urldecode($getData['url']) . "',type: 'ajax'}, closeMarkup: '<button class=\"mfp-close mfp-new-close\" type=\"button\" title=\"Close\">x</button>', closeOnContentClick: false, closeOnBgClick: false, showCloseBtn: true, enableEscapeKey: false}); </script>";
            }
        }
    }

    public function index()
    {
        $menu_act = 'index';
        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->fetchTable('Reports')->find('all'));
        $this->set(compact('data'));
    }


    public function wallet()
    {
        $menu_act = 'wallet';
        $this->set(compact('menu_act'));
        $this->paginate = ['contain' => ['Users'], 'limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->fetchTable('Wallets')->find('all'));
        $this->set(compact('data'));
    }

    public function updateStatus()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $post_data = $this->request->getData();
            $getData = $this->fetchTable('Reports')->findById($post_data['id'])->first();
            if (!empty($getData)) {
                $getData->status = $post_data['status'];
                $this->fetchTable('Reports')->save($getData);
            }
        }
        exit;
    }

    public function viewUnbondings($id = null)
    {
        if (!empty($id)) {
            $data = $this->fetchTable('Unbondings')->find('all')->where(['Unbondings.wallet_id' => $id])->all();
            $this->set(compact('data'));
        }
    }

    public function contact()
    {
        $menu_act = 'contact';
        $this->set(compact('menu_act'));
        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->fetchTable('Users')->find('all'));
        $this->set(compact('data'));
    }

    public function chat($id = null)
    {

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
            }
            exit;
        }


        if (!empty($id)) {
            $user = $this->fetchTable('Users')->find()->where(['id' => $id])->first();
            $photos = $this->fetchTable('Photos')->find()->where(['user_id' => $id])->limit(100)->all();
            $messages = $this->fetchTable('Messages')->find()->where(['user_id' => $id])->contain(['Users'])->limit(100)->all();
            $this->set(compact('photos', 'messages', 'user'));
        }
    }

    public function settings()
    {
        
        $this->set('menu_act', 'settings');
        $postData = $this->request->getData();
        $tbl_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            
            if (isset($postData['id']) && !empty($postData['id'])) {
                $getBlog = $this->fetchTable('Settings')->get($postData['id']);
                $chkBlog = $this->fetchTable('Settings')->patchEntity($getBlog, $postData, ['validate' => true]);
            } else {
                echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                exit;
            }
            if ($chkBlog->getErrors()) {
                $st = null;
                foreach ($chkBlog->getErrors() as $elist) {
                    foreach ($elist as $k => $v); {
                        $st .= "<div class='alert alert-danger'>" . ucwords($v) . "</div>";
                    }
                }
                echo $st;
                exit;
            } else {
                if ($this->fetchTable('Settings')->save($chkBlog)) {
                    $u = SITEURL . "pages/settings";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }
        $tbl_data = $this->fetchTable('Settings')->findById('1')->firstOrFail();
        $this->set(compact('tbl_data'));
    }
}
