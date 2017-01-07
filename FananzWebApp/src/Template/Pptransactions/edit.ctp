<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $pptransaction->TransId],
                ['confirm' => __('Are you sure you want to delete # {0}?', $pptransaction->TransId)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Pptransactions'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="pptransactions form large-9 medium-8 columns content">
    <?= $this->Form->create($pptransaction) ?>
    <fieldset>
        <legend><?= __('Edit Pptransaction') ?></legend>
        <?php
            echo $this->Form->input('PaypalTransId');
            echo $this->Form->input('PaymentStatus');
            echo $this->Form->input('SubscriberId');
            echo $this->Form->input('Currency');
            echo $this->Form->input('Amount');
            echo $this->Form->input('CompletionDate', ['empty' => true]);
            echo $this->Form->input('AccessToken');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
