<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form border p-5 mt-5 rounded-4 container-sm">
    <h3>Register</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Flash->render() ?>
        <?= $this->Form->control('firstname', ['required' => true, 'class' => 'form-control']) ?>
        <?= $this->Form->control('surname', ['required' => true, 'class' => 'form-control']) ?>
        <?= $this->Form->control('email', ['required' => true, 'class' => 'form-control']) ?>
        <?= $this->Form->control('password', ['required' => true, 'class' => 'form-control', 'value' => '']) ?>
        <?= $this->Form->control('confirm-password', ['required' => true, 'class' => 'form-control', 'value' => '', 'type' => 'password']) ?>
    </fieldset>
    <?= $this->Form->submit(__('Register'), ['class' => 'btn btn-primary mt-2']); ?>
    <?= $this->Form->end() ?>

    <span>Already have an account? </span><?= $this->Html->link("Login", ['action' => 'login']) ?>
</div>