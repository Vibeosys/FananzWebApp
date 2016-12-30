<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subscriber'), ['action' => 'edit', $subscriber->SubscriberId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subscriber'), ['action' => 'delete', $subscriber->SubscriberId], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriber->SubscriberId)]) ?> </li>
        <li><?= $this->Html->link(__('List Subscribers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscriber'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subscribers view large-9 medium-8 columns content">
    <h3><?= h($subscriber->SubscriberId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('SubscriberName') ?></th>
            <td><?= h($subscriber->SubscriberName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('BusinessContactPerson') ?></th>
            <td><?= h($subscriber->BusinessContactPerson) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('EmailId') ?></th>
            <td><?= h($subscriber->EmailId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('WebsiteUrl') ?></th>
            <td><?= h($subscriber->WebsiteUrl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CountryOfResidence') ?></th>
            <td><?= h($subscriber->CountryOfResidence) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AboutUs') ?></th>
            <td><?= h($subscriber->AboutUs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($subscriber->Password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nickname') ?></th>
            <td><?= h($subscriber->Nickname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SubscriberId') ?></th>
            <td><?= $this->Number->format($subscriber->SubscriberId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stype') ?></th>
            <td><?= $this->Number->format($subscriber->Stype) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TelephoneNo') ?></th>
            <td><?= $this->Number->format($subscriber->TelephoneNo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('MobileNo') ?></th>
            <td><?= $this->Number->format($subscriber->MobileNo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsSubscribed') ?></th>
            <td><?= $this->Number->format($subscriber->IsSubscribed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsActive') ?></th>
            <td><?= $this->Number->format($subscriber->IsActive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SubscriptionDate') ?></th>
            <td><?= h($subscriber->SubscriptionDate) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('TradeCertificateUrl') ?></h4>
        <?= $this->Text->autoParagraph(h($subscriber->TradeCertificateUrl)); ?>
    </div>
</div>
