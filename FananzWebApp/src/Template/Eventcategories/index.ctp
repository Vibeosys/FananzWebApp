<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventcategories index large-9 medium-8 columns content">
    <h3><?= __('Eventcategories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('CatId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CatName') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CatShortName') ?></th>
                <th scope="col"><?= $this->Paginator->sort('HasSubcat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IsActive') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CreatedDate') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventcategories as $eventcategory): ?>
            <tr>
                <td><?= $this->Number->format($eventcategory->CatId) ?></td>
                <td><?= h($eventcategory->CatName) ?></td>
                <td><?= h($eventcategory->CatShortName) ?></td>
                <td><?= $this->Number->format($eventcategory->HasSubcat) ?></td>
                <td><?= $this->Number->format($eventcategory->IsActive) ?></td>
                <td><?= h($eventcategory->CreatedDate) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $eventcategory->CatId]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eventcategory->CatId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eventcategory->CatId], ['confirm' => __('Are you sure you want to delete # {0}?', $eventcategory->CatId)]) ?>
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
