<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Survey $survey
 */
?>
<div class="container bg-light mt-3 p-5 rounded-4">
    <div class="card mb-3">
        <h5 class="card-header"><?= $this->Html->link($survey->title, ['controller' => 'Surveys', 'action' => 'survey', $survey->id]) ?></h5>
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
        <div class="card-footer">
            <span><?= ($survey->code ? 'Unqiue Code: ' . $this->Html->link($survey->code, ['controller' => 'Surveys', 'action' => 'share', $survey->code]) : $this->Form->postLink('Generate code', ['controller' => 'Surveys' ,'action' => 'generate-code'], ['class' => 'btn btn-primary', 'data' => ['id' => $survey->id]])) ?></span>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <h3>Questions</h3>
    </div>
    <div>
        <?= $this->Form->create(null, [
            'url' => ['controller' => 'Responses', 'action' => 'save', $survey->id],
            'type' => 'post'
        ]) ?>
        <?php foreach ($survey->questions as $question) : ?>
            <div class="card mb-3">
                <h5 class="card-header"><?= $question->position . '. ' . $question->title ?></h5>
                <?php if($question->options): ?>
                <div class="card-body">
                    <?php if($question->type == 'Multiple Choice'): ?>
                        <?php foreach(json_decode($question->options) as $i=>$option) : ?>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="answers[<?=$question->position?>]" id="radio-<?=$question->position?>-<?=$i+1?>" value="<?= $option ?>">
                                <label for="radio-<?=$question->position?>-<?=$i+1?>" class="form-check-label"><?= $option ?></label>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif($question->type == 'Multiple Selection'): ?>
                        <?php foreach(json_decode($question->options) as $i=>$option) : ?>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="answers[<?=$question->position?>][]" id="check-<?=$question->position?>-<?=$i+1?>" value="<?= $option ?>">
                                <label for="check-<?=$question->position?>-<?=$i+1?>" class="form-check-label"><?= $option ?></label>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif($question->type == 'Number Scale'): ?>
                        <input name="answers[<?= $question->position ?>]" type="range" class="card-text form-range" value="" min="<?= json_decode($question->options)[0] ?>" max="<?= json_decode($question->options)[1] ?>">
                        <div class="d-flex justify-content-around">
                            <?php for($i = json_decode($question->options)[0]; $i <= json_decode($question->options)[1]; $i++): ?>
                                <span><?= $i ?></span>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php else: ?>
                <div class="card-body">
                    <?php if($question->type == 'True/False'): ?>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="answers[<?= $question->position ?>]" id="radio-<?=$question->position?>-1" value="true">
                            <label for="radio-<?=$question->position?>-1" class="form-check-label">True</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="answers[<?= $question->position ?>]" id="radio-<?=$question->position?>-2" value="false">
                            <label for="radio-<?=$question->position?>-2" class="form-check-label">False</label>
                        </div>
                    <?php elseif($question->type == 'Short Text'): ?>
                        <input type="text" class="form-control" name="answers[<?=$question->position?>]" placeholder="Enter text here...">
                    <?php elseif($question->type == 'Long Text'): ?>
                        <textarea name="answers[<?=$question->position?>]" class="form-control"></textarea>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <span>Question Type: <?= $question->type ?></span>
                        <span><i><?= ( $question->required ? 'Required' : '') ?></i></span>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <?= $this->Form->submit('Submit', ['class' => 'btn btn-lg btn-success']) ?>
    <?= $this->Form->end() ?>
</div>