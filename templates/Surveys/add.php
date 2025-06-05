<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Survey $survey
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var number $userID
 */
?>

<div class="container bg-light mt-3 p-5 rounded-4">
    <h3>Create survey</h3>
    <?= $this->Form->create($survey) ?>
    <fieldset>
        <?= $this->Form->control('user_id', ['value' => $userID, 'style' => 'display: none', 'label' => false]) ?>
        <div class="input-group mb-3">
            <span class="input-group-text">Title</span>
            <input type="text" name="title" class="form-control">
        </div>
        <label>Description</label>
        <textarea name="description" class="form-control mb-3"></textarea>
        <div class="d-flex justify-content-around mb-3">
            <div class="input-group me-3">
                <span class="input-group-text">Status</span>
                <select name="status" class="form-select">
                    <option value="Open">Open</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>
            <div class="input-group me-3">
                <span class="input-group-text">Visibility</span>
                <select name="visibility" class="form-select">
                    <option value="Public">Public</option>
                    <option value="Private">Private</option>
                    <option value="Unlisted">Unlisted</option>
                </select>
            </div>
            <div class="input-group">
                <span class="input-group-text">Sharable code</span>
                <input id="code" class="form-control" type="text" name="code" readonly>
                <span id="generateCode" class="btn btn-primary rounded-end">Generate</span>
                <span id="copyCode" class="btn btn-primary" style="display: none">Copy</span>
            </div>
        </div>
    </fieldset>
    <?= $this->Form->submit('Save', ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end(); ?>
</div>

<script>
    const generateCode = document.getElementById('generateCode');
    const copyCode = document.getElementById('copyCode');
    const code = document.getElementById('code');

    function generateID() {
        return Math.random().toString(36).substring(2, 10);
    }

    async function copyToClipboard(string) {
        try {
            await navigator.clipboard.writeText(string);
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    }

    generateCode.addEventListener('click', () => {
        const id = generateID();
        code.value = id;

        generateCode.style.display = 'none';
        copyCode.style.display = '';
    });

    copyCode.addEventListener('click', () => {
        copyToClipboard(code.value);
    })
</script>