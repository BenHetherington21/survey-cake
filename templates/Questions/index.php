<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Question> $questions
 */
?>
<div class="questions index content">
    <?= $this->Html->link(__('New Question'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Questions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('survey_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('position') ?></th>
                    <th><?= $this->Paginator->sort('required') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $question): ?>
                <tr>
                    <td><?= $this->Number->format($question->id) ?></td>
                    <td><?= $question->hasValue('survey') ? $this->Html->link($question->survey->title, ['controller' => 'Surveys', 'action' => 'view', $question->survey->id]) : '' ?></td>
                    <td><?= h($question->title) ?></td>
                    <td><?= h($question->type) ?></td>
                    <td><?= $this->Number->format($question->position) ?></td>
                    <td><?= h($question->required) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $question->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $question->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $question->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $question->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>