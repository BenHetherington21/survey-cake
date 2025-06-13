<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Survey $survey
 */
?>
<div class="container bg-light mt-3 p-5 rounded-4">
    <div class="card mb-3">
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
        <div class="card-footer">
            <span><?= ($survey->code ? 'Unqiue Code: ' . $survey->code : $this->Form->postLink('Generate code', ['controller' => 'Surveys' ,'action' => 'generate-code'], ['class' => 'btn btn-primary', 'data' => ['id' => $survey->id]])) ?></span>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <h3>Questions</h3>
        <?= $this->Html->link('Add question', ['controller' => 'Questions', 'action' => 'add', $survey->id], ['class' => 'btn btn-primary mb-3']) ?>
    </div>
    <div>
        <?php foreach ($survey->questions as $question) : ?>
            <div class="card mb-3">
                <h5 class="card-header"><?= $question->position . '. ' . $question->title ?></h5>
                <?php if($question->options): ?>
                <div class="card-body">
                    <?php if($question->type == 'Multiple Choice'): ?>
                        <ol class="card-text">
                            <?php foreach(json_decode($question->options) as $option) : ?>
                                <li><?= $option ?></li>
                            <?php endforeach; ?>
                        </ol>
                    <?php elseif($question->type == 'Multiple Selection'): ?>
                        <ul class="card-text">
                            <?php foreach(json_decode($question->options) as $option) : ?>
                                <li><?= $option ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php elseif($question->type == 'Number scale'): ?>
                        <input type="range" class="card-text form-range" disabled min="<?= json_decode($question->options)[0] ?>" max="<?= json_decode($question->options)[1] ?>">
                        <div class="d-flex justify-content-around">
                            <?php for($i = json_decode($question->options)[0]; $i <= json_decode($question->options)[1]; $i++): ?>
                                <span><?= $i ?></span>
                            <?php endfor; ?>
                        </div>
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
</div>

<style>
input[type=range]::-webkit-slider-thumb {
  visibility: hidden;
}

input[type=range]::-moz-range-thumb {
  visibility: hidden;
}

input[type=range]::-ms-thumb {
  visibility: hidden;
}
</style>