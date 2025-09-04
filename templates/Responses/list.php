<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Response> $responses
 */
?>
<div class="container bg-light mt-3 p-5 rounded-4">
    <h3>Responses</h3>
    <h5>Survey: <?= $this->Html->link($responses[0]->survey->title, ['controller' => 'Surveys', 'action' => 'manage', $responses[0]->survey_id]) ?></h3>
    
    <div class="accordion" id="accordionResponses">
    <?php foreach($responses as $responseIndex => $response): ?>
        <div class="accordion-item">
            <h5 class="accordion-header" id="heading<?=$responseIndex?>">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$responseIndex?>" aria-expanded="false" aria-controls="collapse<?=$responseIndex?>">
                    <?= $response->type == 'public' ? $response->user->firstname . ' ' . $response->user->surname : 'Anonymous User' ?>
                </button>
            </h5>
            <div id="collapse<?=$responseIndex?>" class="accordion-collapse collapse show" aria-labelledby="heading<?=$responseIndex?>" data-bs-parent="#accordionResponses">
                <div class="accordion-body">
                    <ul class="list-group">
                    <?php foreach(json_decode($response->data)->answers as $index => $answer): ?>
                        <li class="list-group-item">
                            <p><?= $index . '. ' . $questions[$index]->title . ' - ' . $questions[$index]->type . ($questions[$index]->required ? ' <i>*required</i>' : '')?></p>
                            <?php if($questions[$index]->type == 'Multiple Choice'): ?>
                                <ul>
                                    <?php foreach(json_decode($questions[$index]->options) as $option): ?>
                                        <li><?php if($option == $answer): ?>
                                            <b><?= $option ?></b>
                                        <?php else: ?>
                                            <?= $option ?>
                                        <?php endif; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php elseif($questions[$index]->type == 'Multiple Selection'): ?>
                                <ul>
                                    <?php foreach(json_decode($questions[$index]->options) as $option): ?>
                                        <li><?php if(in_array($option, $answer)): ?>
                                            <b><?= $option ?></b>
                                        <?php else: ?>
                                            <?= $option ?>
                                        <?php endif; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php elseif($questions[$index]->type == 'Number Scale'): ?>
                                <input type="range" class="card-text form-range" disabled value="<?= $answer ?>" min="<?= json_decode($questions[$index]->options)[0] ?>" max="<?= json_decode($questions[$index]->options)[1] ?>">
                                <div class="d-flex justify-content-around">
                                    <?php for($i = json_decode($questions[$index]->options)[0]; $i <= json_decode($questions[$index]->options)[1]; $i++): ?>
                                        <span><?= $i == $answer ? '<b>' . $i . '</b>' : $i ?></span>
                                    <?php endfor; ?>
                                </div>
                            <?php elseif($questions[$index]->type == 'True/False'): ?>
                                <p><?= ucfirst($answer) ?></p>
                            <?php else: ?>
                                <p><?= $answer ?></p>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    </div>
</div>