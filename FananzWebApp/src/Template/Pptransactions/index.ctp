<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pptransaction'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pptransactions index large-9 medium-8 columns content">
    <h3><?= __('Pptransactions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('TransId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PaymentStatus') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SubscriberId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CompletionDate') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pptransactions as $pptransaction): ?>
            <tr>
                <td><?= h($pptransaction->TransId) ?></td>
                <td><?= $this->Number->format($pptransaction->PaymentStatus) ?></td>
                <td><?= $this->Number->format($pptransaction->SubscriberId) ?></td>
                <td><?= h($pptransaction->Currency) ?></td>
                <td><?= $this->Number->format($pptransaction->Amount) ?></td>
                <td><?= h($pptransaction->CompletionDate) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pptransaction->TransId]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pptransaction->TransId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pptransaction->TransId], ['confirm' => __('Are you sure you want to delete # {0}?', $pptransaction->TransId)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
