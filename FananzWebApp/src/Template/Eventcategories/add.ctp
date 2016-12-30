<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="eventcategories form large-9 medium-8 columns content">
    <?= $this->Form->create($eventcategory) ?>
    <fieldset>
        <legend><?= __('Add Eventcategory') ?></legend>
        <?php
            echo $this->Form->input('CatName');
            echo $this->Form->input('CatShortName');
            echo $this->Form->input('HasSubcat');
            echo $this->Form->input('IsActive');
            echo $this->Form->input('CreatedDate', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
