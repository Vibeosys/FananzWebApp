<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pptransaction'), ['action' => 'edit', $pptransaction->TransId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pptransaction'), ['action' => 'delete', $pptransaction->TransId], ['confirm' => __('Are you sure you want to delete # {0}?', $pptransaction->TransId)]) ?> </li>
        <li><?= $this->Html->link(__('List Pptransactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pptransaction'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pptransactions view large-9 medium-8 columns content">
    <h3><?= h($pptransaction->TransId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('TransId') ?></th>
            <td><?= h($pptransaction->TransId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($pptransaction->Currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PaymentStatus') ?></th>
            <td><?= $this->Number->format($pptransaction->PaymentStatus) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SubscriberId') ?></th>
            <td><?= $this->Number->format($pptransaction->SubscriberId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($pptransaction->Amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CompletionDate') ?></th>
            <td><?= h($pptransaction->CompletionDate) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('PaypalTransId') ?></h4>
        <?= $this->Text->autoParagraph(h($pptransaction->PaypalTransId)); ?>
    </div>
    <div class="row">
        <h4><?= __('AccessToken') ?></h4>
        <?= $this->Text->autoParagraph(h($pptransaction->AccessToken)); ?>
    </div>
</div>
