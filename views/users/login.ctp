<div id='login_form'>
<h1><?php __('Login'); ?></h1>
<?php
    $session->flash('auth');
?>
<?php
    echo $form->create('User', array('action' => 'login'));
    echo $form->input('username');
    echo $form->input('password');
    echo $form->end('Login');
?>
</div>
