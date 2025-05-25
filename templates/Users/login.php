<div class="users form border p-5 mt-5 rounded-4 container-sm">
    <h3>Login</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email and password') ?></legend>
        <?= $this->Flash->render() ?>
        <?= $this->Form->control('email', ['required' => true, 'class' => 'form-control']) ?>
        <?= $this->Form->control('password', ['required' => true, 'class' => 'form-control', 'value' => '']) ?>
    </fieldset>
    <?= $this->Form->submit(__('Login'), ['class' => 'btn btn-primary mt-2']); ?>
    <?= $this->Form->end() ?>

    <span>Don't have an account? </span><?= $this->Html->link("Register", ['action' => 'add']) ?>
</div>