<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \Cake\ORM\ResultSet<\App\Model\Entity\Survey> $surveys
 */
?>
<div class="container bg-light mt-3 p-5 rounded-4">
    <h3>Profile</h3>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'update'], 'type' => 'post']) ?>
    <div class="input-group mb-3">
        <span class="input-group-text col-1">First name</span>
        <input name="firstname" id="firstname" type="text" class="form-control" value="<?= h($user->firstname) ?>" readonly disabled>
        <span id="firstnameEdit" class="btn btn-primary col-1 rounded-end">Edit</span>
        <button type="submit" id="firstnameSave" class="btn btn-success col-1" style="display: none">Save</button>
    </div>
    <?= $this->Form->end() ?>
    <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'update'], 'type' => 'post']) ?>
    <div class="input-group mb-3">
        <span class="input-group-text col-1">Surname</span>
        <input name="surname" id="surname" type="text" class="form-control" value="<?= h($user->surname) ?>" readonly disabled>
        <span id="surnameEdit" class="btn btn-primary col-1 rounded-end">Edit</span>
        <button type="submit" id="surnameSave" class="btn btn-success col-1" style="display: none">Save</button>
    </div>
    <?= $this->Form->end() ?>
    <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'update'], 'type' => 'post']) ?>
    <div class="input-group mb-3">
        <span class="input-group-text col-1">Email</span>
        <input name="email" id="email" type="email" class="form-control" value="<?= h($user->email) ?>" readonly disabled>
        <span id="emailEdit" class="btn btn-primary col-1 rounded-end">Edit</span>
        <button type="submit" id="emailSave" class="btn btn-success col-1" style="display: none">Save</button>
    </div>
    <?= $this->Form->end() ?>
    <?= $this->Html->link('Change password', ['action' => 'changePassword'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->postLink('Delete account', ['action' => 'delete', $user->id], ['class' => 'btn btn-danger', 'confirm' => 'Are you sure you want to delete your account']) ?>
</div>

<div class="container bg-light mt-3 p-5 rounded-4">
    <div class="d-flex justify-content-between">
        <h3>My surveys</h3>
        <?= $this->Html->link('New survey', ['controller' => 'Surveys', 'action' => 'add'], ['class' => 'btn btn-primary mb-3']) ?>
    </div>
    <div>
        <?php foreach($surveys as $survey): ?>
            <div class="card">
                <h5 class="card-header"><?= $this->Html->link($survey->title, ['controller' => 'Surveys', 'action' => 'view', $survey->id]) ?></h5>
                <div class="card-body">
                    <p class="card-text"><?= $survey->description ?></p>
                </div>
                <div class="card-footer">
                    <div class="position-relative text-center">
                        <span class="position-absolute start-0">Created: <?= $survey->creation_date ?></span>
                        <span class="">Status: <?= ($survey->status == 'Open' ? 'Open' : 'Closed at ' . $survey->completion_date) ?></span>
                        <span class="position-absolute end-0">Visibility: <?= $survey->visibility ?></span>
                    </div>
                    
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="container bg-light mt-3 p-5 rounded-4">
    <h3>My responses</h3>
</div>

<script>
const firstname = document.getElementById('firstname');
const firstnameEdit = document.getElementById('firstnameEdit');
const firstnameSave = document.getElementById('firstnameSave');

const surname = document.getElementById('surname');
const surnameEdit = document.getElementById('surnameEdit');
const surnameSave = document.getElementById('surnameSave');

const email = document.getElementById('email');
const emailEdit = document.getElementById('emailEdit');
const emailSave = document.getElementById('emailSave');

firstnameEdit.addEventListener('click', () => {
    firstname.removeAttribute('readonly');
    firstname.removeAttribute('disabled');
    firstnameEdit.setAttribute('style', 'display:none');
    firstnameSave.setAttribute('style', '');
})

surnameEdit.addEventListener('click', () => {
    surname.removeAttribute('readonly');
    surname.removeAttribute('disabled');
    surnameEdit.setAttribute('style', 'display:none');
    surnameSave.setAttribute('style', '');
})

emailEdit.addEventListener('click', () => {
    email.removeAttribute('readonly');
    email.removeAttribute('disabled');
    emailEdit.setAttribute('style', 'display:none');
    emailSave.setAttribute('style', '');
})
</script>