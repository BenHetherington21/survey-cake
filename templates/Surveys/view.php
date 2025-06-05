<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Survey $survey
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Survey'), ['action' => 'edit', $survey->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Survey'), ['action' => 'delete', $survey->id], ['confirm' => __('Are you sure you want to delete # {0}?', $survey->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Surveys'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Survey'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="surveys view content">
            <h3><?= h($survey->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $survey->hasValue('user') ? $this->Html->link($survey->user->email, ['controller' => 'Users', 'action' => 'view', $survey->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($survey->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($survey->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($survey->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($survey->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($survey->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Visibility') ?></th>
                    <td><?= $this->Number->format($survey->visibility) ?></td>
                </tr>
                <tr>
                    <th><?= __('Creation Date') ?></th>
                    <td><?= h($survey->creation_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Completion Date') ?></th>
                    <td><?= h($survey->completion_date) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Questions') ?></h4>
                <?php if (!empty($survey->questions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Survey Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Options') ?></th>
                            <th><?= __('Position') ?></th>
                            <th><?= __('Required') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($survey->questions as $question) : ?>
                        <tr>
                            <td><?= h($question->id) ?></td>
                            <td><?= h($question->survey_id) ?></td>
                            <td><?= h($question->title) ?></td>
                            <td><?= h($question->type) ?></td>
                            <td><?= h($question->options) ?></td>
                            <td><?= h($question->position) ?></td>
                            <td><?= h($question->required) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Questions', 'action' => 'view', $question->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Questions', 'action' => 'edit', $question->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Questions', 'action' => 'delete', $question->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $question->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Responses') ?></h4>
                <?php if (!empty($survey->responses)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Survey Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Time') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($survey->responses as $response) : ?>
                        <tr>
                            <td><?= h($response->id) ?></td>
                            <td><?= h($response->user_id) ?></td>
                            <td><?= h($response->survey_id) ?></td>
                            <td><?= h($response->type) ?></td>
                            <td><?= h($response->data) ?></td>
                            <td><?= h($response->time) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Responses', 'action' => 'view', $response->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Responses', 'action' => 'edit', $response->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Responses', 'action' => 'delete', $response->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $response->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>