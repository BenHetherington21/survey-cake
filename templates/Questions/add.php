<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 * @var \Cake\Collection\CollectionInterface|string[] $surveys
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Questions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="questions form content">
            <?= $this->Form->create($question) ?>
            <fieldset>
                <legend><?= __('Add Question') ?></legend>
                <?php
                    echo $this->Form->control('survey_id', ['options' => $surveys]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('type');
                    echo $this->Form->control('options');
                    echo $this->Form->control('position');
                    echo $this->Form->control('required');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
