<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Questions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Question'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="questions view content">
            <h3><?= h($question->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Survey') ?></th>
                    <td><?= $question->hasValue('survey') ? $this->Html->link($question->survey->title, ['controller' => 'Surveys', 'action' => 'view', $question->survey->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($question->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($question->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($question->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($question->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Required') ?></th>
                    <td><?= $question->required ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Options') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($question->options)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>