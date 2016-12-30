<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Portfolio'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="portfolio index large-9 medium-8 columns content">
    <h3><?= __('Portfolio') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('PortfolioId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CategoryId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SubcategoryId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('MinPrice') ?></th>
                <th scope="col"><?= $this->Paginator->sort('MaxPrice') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IsActive') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($portfolio as $portfolio): ?>
            <tr>
                <td><?= $this->Number->format($portfolio->PortfolioId) ?></td>
                <td><?= $this->Number->format($portfolio->CategoryId) ?></td>
                <td><?= $this->Number->format($portfolio->SubcategoryId) ?></td>
                <td><?= $this->Number->format($portfolio->MinPrice) ?></td>
                <td><?= $this->Number->format($portfolio->MaxPrice) ?></td>
                <td><?= $this->Number->format($portfolio->IsActive) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $portfolio->PortfolioId]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $portfolio->PortfolioId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $portfolio->PortfolioId], ['confirm' => __('Are you sure you want to delete # {0}?', $portfolio->PortfolioId)]) ?>
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
