<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Subcategories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="subcategories form large-9 medium-8 columns content">
    <?= $this->Form->create($subcategory) ?>
    <fieldset>
        <legend><?= __('Add Subcategory') ?></legend>
        <?php
            echo $this->Form->input('SubCatName');
            echo $this->Form->input('SubCatShortName');
            echo $this->Form->input('CatId');
            echo $this->Form->input('IsActive');
            echo $this->Form->input('DateCreated', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
