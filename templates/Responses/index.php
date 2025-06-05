<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Response> $responses
 */
?>
<div class="responses index content">
    <?= $this->Html->link(__('New Response'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Responses') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('survey_id') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('time') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responses as $response): ?>
                <tr>
                    <td><?= $this->Number->format($response->id) ?></td>
                    <td><?= $response->hasValue('user') ? $this->Html->link($response->user->email, ['controller' => 'Users', 'action' => 'view', $response->user->id]) : '' ?></td>
                    <td><?= $response->hasValue('survey') ? $this->Html->link($response->survey->title, ['controller' => 'Surveys', 'action' => 'view', $response->survey->id]) : '' ?></td>
                    <td><?= h($response->type) ?></td>
                    <td><?= h($response->time) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $response->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $response->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $response->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $response->id),
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