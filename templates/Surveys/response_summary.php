<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Survey $survey
 * @var ArrayObject $questions
 */
?>
<div class="container bg-light mt-3 p-5 rounded-4">
    <div class="card mb-3">
        <h5 class="card-header"><?= $this->Html->link($survey->title, ['controller' => 'Surveys', 'action' => 'manage', $survey->id]) ?></h5>
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
        <div>
            <?= $this->Html->link('View all responses', ['controller' => 'Responses', 'action' => 'list', $survey->id], ['class' => 'btn btn-primary mb-3']) ?>
            <?= $this->Html->link('Hide response summary', ['action' => 'manage', $survey->id], ['class' => 'btn btn-primary mb-3']) ?>
            <?= $this->Html->link('Add question', ['controller' => 'Questions', 'action' => 'add', $survey->id], ['class' => 'btn btn-primary mb-3']) ?>
        </div>
    </div>
    <div>
        <?php foreach ($survey->questions as $question) : ?>
            <div class="card mb-3">
                <h5 class="card-header"><?= $question->position . '. ' . $question->title ?></h5>
                <?php //if($question->options): ?>
                <div class="card-body">
                    <?php if($question->type == 'Multiple Choice'): ?>
                        <ol class="card-text">
                            <?php $counts = array_count_values($questions[$question->position]); ?>
                            <?php foreach(json_decode($question->options) as $option) : ?>
                                <li><?= $option ?> - <?= ($counts[$option] ?? '0') . ' ' . ($counts[$option] ?? 0 == 1 ? 'response' : 'responses')?></li>
                            <?php endforeach; ?>
                        </ol>
                    <?php elseif($question->type == 'Multiple Selection'): ?>
                        <ul class="card-text">
                            <?php $counts = array_count_values($questions[$question->position]); ?>
                            <?php foreach(json_decode($question->options) as $option) : ?>
                                <li><?= $option ?> - <?= ($counts[$option] ?? '0') . ' ' . ($counts[$option] ?? 0 == 1 ? 'response' : 'responses')?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php elseif($question->type == 'Number Scale'): ?>
                        <?php $counts = array_count_values($questions[$question->position]); ?>
                        <input type="range" class="card-text form-range" disabled min="<?= json_decode($question->options)[0] ?>" max="<?= json_decode($question->options)[1] ?>">
                        <div class="d-flex justify-content-around">
                            <?php for($i = json_decode($question->options)[0]; $i <= json_decode($question->options)[1]; $i++): ?>
                                <span><?= $i ?> - <?= ($counts[$i] ?? '0') . ' ' . ($counts[$i] ?? 0 == 1 ? 'response' : 'responses') ?></span>
                            <?php endfor; ?>
                        </div>
                    <?php elseif($question->type == 'True/False'): ?>
                        <ul class="card-text">
                            <?php $counts = array_count_values($questions[$question->position]); ?>
                            <?php foreach($counts as $option => $count) : ?>
                                <li><?= ucfirst($option) ?> - <?= ($count ?? '0') . ' ' . ($count == 1 ? 'response' : 'responses') ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <ul class="card-text">
                            <?php foreach($questions[$question->position] as $response): ?>
                                <li><?= $response ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <?php //endif; ?>
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