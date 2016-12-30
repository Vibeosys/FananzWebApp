<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subcategory'), ['action' => 'edit', $subcategory->SubCatId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subcategory'), ['action' => 'delete', $subcategory->SubCatId], ['confirm' => __('Are you sure you want to delete # {0}?', $subcategory->SubCatId)]) ?> </li>
        <li><?= $this->Html->link(__('List Subcategories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subcategory'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subcategories view large-9 medium-8 columns content">
    <h3><?= h($subcategory->SubCatId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('SubCatName') ?></th>
            <td><?= h($subcategory->SubCatName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SubCatShortName') ?></th>
            <td><?= h($subcategory->SubCatShortName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SubCatId') ?></th>
            <td><?= $this->Number->format($subcategory->SubCatId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CatId') ?></th>
            <td><?= $this->Number->format($subcategory->CatId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsActive') ?></th>
            <td><?= $this->Number->format($subcategory->IsActive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DateCreated') ?></th>
            <td><?= h($subcategory->DateCreated) ?></td>
        </tr>
    </table>
</div>
