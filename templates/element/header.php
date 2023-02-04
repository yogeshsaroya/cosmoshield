<?php
//pr($this->request->getParam('controller'));
//pr($this->request->getParam('action'));

$auth = $this->request->getSession()->read('Auth.User');
?>
<header>
  <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand me-5" href="<?= SITEURL; ?>dashboard"><img src="<?= SITEURL; ?>v1/images/cosmo-recovery.png" alt="logo" style="max-height: 32px;" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav  my-2 my-lg-0 w-100 navbar-nav-scroll">
          <li class="nav-item">
            <a class="nav-link <?= ($this->request->getParam('action') == 'dashboard' ? 'active' : null); ?>" aria-current="page" href="<?= SITEURL; ?>dashboard">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($this->request->getParam('action') == 'contact' ? 'active' : null); ?>" href="<?= SITEURL; ?>contact">Contact</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= ($this->request->getParam('action') == 'wallet' ? 'active' : null); ?>" href="<?= SITEURL; ?>wallet">Wallet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($this->request->getParam('action') == 'knowledge' ? 'active' : null); ?>" href="<?= SITEURL; ?>knowledge">FAQ</a>
          </li>

          <li class="ms-auto nav-item d-flex">
            <?php if (isset($auth->username)) {
              echo $this->Html->link('Logout', '/users/logout', ['class' => 'logBtn nav-link ms-2 clrltpurp']);
            } else {
              echo $this->Html->link('Login', '/login', ['class' => 'btn btn-primary nav-link ']);
              echo $this->Html->link('Sign up', '/register', ['class' => 'btn btn-secondary nav-link ms-2 ']);
            } ?>
          </li>

        </ul>

      </div>
    </div>
  </nav>
</header>