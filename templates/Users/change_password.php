<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container bg-light mt-3 p-5 rounded-4">
    <h3>Change password</h3>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create(); ?>
    <div class="input-group mb-3">
        <span class="input-group-text col-2">Old password</span>
        <input type="password" name="oldpassword" id="oldpassword" class="form-control">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text col-2">New password</span>
        <input type="password" name="newpassword" id="oldpassword" class="form-control">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text col-2">Confirm new password</span>
        <input type="password" name="confirm-newpassword" id="oldpassword" class="form-control">
    </div>
    <?= $this->Form->submit('Update password', ['class' => 'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>