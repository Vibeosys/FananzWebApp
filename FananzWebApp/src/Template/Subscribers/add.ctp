<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Subscribers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="subscribers form large-9 medium-8 columns content">
    <?= $this->Form->create($subscriber) ?>
    <fieldset>
        <legend><?= __('Add Subscriber') ?></legend>
        <?php
            echo $this->Form->input('SubscriberName');
            echo $this->Form->input('BusinessContactPerson');
            echo $this->Form->input('EmailId');
            echo $this->Form->input('Stype');
            echo $this->Form->input('TelephoneNo');
            echo $this->Form->input('MobileNo');
            echo $this->Form->input('WebsiteUrl');
            echo $this->Form->input('CountryOfResidence');
            echo $this->Form->input('AboutUs');
            echo $this->Form->input('TradeCertificateUrl');
            echo $this->Form->input('IsSubscribed');
            echo $this->Form->input('SubscriptionDate', ['empty' => true]);
            echo $this->Form->input('IsActive');
            echo $this->Form->input('Password');
            echo $this->Form->input('Nickname');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
