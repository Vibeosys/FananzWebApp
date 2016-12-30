<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Subscriber'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subscribers index large-9 medium-8 columns content">
    <h3><?= __('Subscribers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('SubscriberId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SubscriberName') ?></th>
                <th scope="col"><?= $this->Paginator->sort('BusinessContactPerson') ?></th>
                <th scope="col"><?= $this->Paginator->sort('EmailId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Stype') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TelephoneNo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('MobileNo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('WebsiteUrl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CountryOfResidence') ?></th>
                <th scope="col"><?= $this->Paginator->sort('AboutUs') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IsSubscribed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SubscriptionDate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IsActive') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nickname') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subscribers as $subscriber): ?>
            <tr>
                <td><?= $this->Number->format($subscriber->SubscriberId) ?></td>
                <td><?= h($subscriber->SubscriberName) ?></td>
                <td><?= h($subscriber->BusinessContactPerson) ?></td>
                <td><?= h($subscriber->EmailId) ?></td>
                <td><?= $this->Number->format($subscriber->Stype) ?></td>
                <td><?= $this->Number->format($subscriber->TelephoneNo) ?></td>
                <td><?= $this->Number->format($subscriber->MobileNo) ?></td>
                <td><?= h($subscriber->WebsiteUrl) ?></td>
                <td><?= h($subscriber->CountryOfResidence) ?></td>
                <td><?= h($subscriber->AboutUs) ?></td>
                <td><?= $this->Number->format($subscriber->IsSubscribed) ?></td>
                <td><?= h($subscriber->SubscriptionDate) ?></td>
                <td><?= $this->Number->format($subscriber->IsActive) ?></td>
                <td><?= h($subscriber->Password) ?></td>
                <td><?= h($subscriber->Nickname) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $subscriber->SubscriberId]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subscriber->SubscriberId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subscriber->SubscriberId], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriber->SubscriberId)]) ?>
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
