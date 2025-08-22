<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 * @var \Cake\Collection\CollectionInterface|string[] $surveys
 * @var number $surveyID
 * @var number $totalQuestions
 */
?>

<div class="container bg-light mt-3 p-5 rounded-4">
    <h3>Add question</h3>
    <?= $this->Form->create($question) ?>
    <fieldset>
        <?= $this->Form->control('survey_id', ['value' => $surveyID, 'style' => 'display: none', 'label' => false]) ?>
        <div class="input-group mb-3">
            <span class="input-group-text">Title</span>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Question Type</span>
            <select name="type" id="typeSelect" class="form-select">
                <option selected disabled value="">Choose a type</option>
                <option value="Multiple Choice">Multiple Choice</option>
                <option value="Multiple Selection">Multiple Selection</option>
                <option value="True/False">True/False</option>
                <option value="Short Text">Short Text</option>
                <option value="Long Text">Long Text</option>
                <option value="Number Scale">Number Scale</option>
            </select>
        </div>
        <div id="optionsParent" class="mb-3">
            <div class="d-flex justify-content-between mb-3">
                <h5>Options</h5>
                <span id="addOption" class="btn btn-primary">Add option</span>
            </div>
            <div id="optionsDiv">

            </div>
        </div>
        <?= $this->Form->control('position', ['value' => $totalQuestions + 1, 'style' => 'display: none', 'label' => false]) ?>
        <?= $this->Form->control('totalOptions', ['value' => 0, 'style' => 'display: none', 'label' => false, 'id' => 'totalOptions']) ?>
        <div class="input-group mb-3">
            <div class="input-group-text">Required Question</div>
            <div class="input-group-text">
                <input class="form-check-input mt-0" type="checkbox" name="required" aria-label="Checkbox for following text input">
            </div>
        </div>
    </fieldset>
    <?= $this->Form->submit('Add', ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end(); ?>
</div>

<script>
const optionsParent = document.getElementById('optionsParent');
const optionsDiv = document.getElementById('optionsDiv');
const addOption = document.getElementById('addOption');
const typeSelect = document.getElementById('typeSelect');
const totalOptions = document.getElementById('totalOptions');

let options = 0;

typeSelect.addEventListener('change', () => {
    optionsDiv.innerHTML = '';
    options = 0;
    if(typeSelect.value == 'Multiple Choice') {
        optionsParent.style.display = 'block';
        addOption.style.display = 'block';
    } else if(typeSelect.value == 'Multiple Selection') {
        optionsParent.style.display = 'block';
        addOption.style.display = 'block';
    } else if(typeSelect.value == 'Number Scale') {
        optionsParent.style.display = 'block';
        addOption.style.display = 'none';
        optionsDiv.innerHTML = `
            <div class="input-group mb-3">
                <span class="input-group-text">Minimum</span>
                <input type="number" name="min" class="form-control">
                <span class="input-group-text">Maximum</span>
                <input type="number" name="max" class="form-control">
            </div>
        `;
    } else {
        // Question doesn't need options
        optionsParent.style.display = 'none';
    }
})

addOption.addEventListener('click', () => {
    if(options >= 6) return;
    options++;
    totalOptions.value = options;
    optionsDiv.innerHTML += `
        <div class="input-group" id="option-${options}">
            <input type="text" name="option-${options}" class="form-control">
            <span class="btn btn-danger" type="button" id="delete-${options}">Remove</span>
        </div>
    `;
})
</script>