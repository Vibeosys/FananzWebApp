<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('UserId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FirstName') ?></th>
                <th scope="col"><?= $this->Paginator->sort('LastName') ?></th>
                <th scope="col"><?= $this->Paginator->sort('EmailId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('MobileNo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IsFacebookUser') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IsActive') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->UserId) ?></td>
                <td><?= h($user->FirstName) ?></td>
                <td><?= h($user->LastName) ?></td>
                <td><?= h($user->EmailId) ?></td>
                <td><?= h($user->Password) ?></td>
                <td><?= h($user->MobileNo) ?></td>
                <td><?= $this->Number->format($user->IsFacebookUser) ?></td>
                <td><?= $this->Number->format($user->IsActive) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->UserId]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->UserId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->UserId], ['confirm' => __('Are you sure you want to delete # {0}?', $user->UserId)]) ?>
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
