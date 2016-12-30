<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('FirstName');
            echo $this->Form->input('LastName');
            echo $this->Form->input('EmailId');
            echo $this->Form->input('Password');
            echo $this->Form->input('MobileNo');
            echo $this->Form->input('IsFacebookUser');
            echo $this->Form->input('IsActive');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
