<span?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container bg-light mt-3 p-5 rounded-4">
    <h3>Profile</h3>
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
    <button class="btn btn-primary">Change password</button>
    <button class="btn btn-danger">Delete account</button>
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