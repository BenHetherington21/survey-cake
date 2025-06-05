<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Survey> $surveys
 */
?>
<div class="surveys index content">
    <?= $this->Html->link(__('New Survey'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Surveys') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('visibility') ?></th>
                    <th><?= $this->Paginator->sort('creation_date') ?></th>
                    <th><?= $this->Paginator->sort('completion_date') ?></th>
                    <th><?= $this->Paginator->sort('code') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($surveys as $survey): ?>
                <tr>
                    <td><?= $this->Number->format($survey->id) ?></td>
                    <td><?= $survey->hasValue('user') ? $this->Html->link($survey->user->email, ['controller' => 'Users', 'action' => 'view', $survey->user->id]) : '' ?></td>
                    <td><?= h($survey->title) ?></td>
                    <td><?= h($survey->description) ?></td>
                    <td><?= h($survey->status) ?></td>
                    <td><?= $this->Number->format($survey->visibility) ?></td>
                    <td><?= h($survey->creation_date) ?></td>
                    <td><?= h($survey->completion_date) ?></td>
                    <td><?= h($survey->code) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $survey->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $survey->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $survey->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $survey->id),
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