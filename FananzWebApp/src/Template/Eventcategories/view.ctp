<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Eventcategory'), ['action' => 'edit', $eventcategory->CatId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Eventcategory'), ['action' => 'delete', $eventcategory->CatId], ['confirm' => __('Are you sure you want to delete # {0}?', $eventcategory->CatId)]) ?> </li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eventcategories view large-9 medium-8 columns content">
    <h3><?= h($eventcategory->CatId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('CatName') ?></th>
            <td><?= h($eventcategory->CatName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CatShortName') ?></th>
            <td><?= h($eventcategory->CatShortName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CatId') ?></th>
            <td><?= $this->Number->format($eventcategory->CatId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('HasSubcat') ?></th>
            <td><?= $this->Number->format($eventcategory->HasSubcat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsActive') ?></th>
            <td><?= $this->Number->format($eventcategory->IsActive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CreatedDate') ?></th>
            <td><?= h($eventcategory->CreatedDate) ?></td>
        </tr>
    </table>
</div>
