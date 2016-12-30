<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Portfolio Photo'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="portfolioPhotos index large-9 medium-8 columns content">
    <h3><?= __('Portfolio Photos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('PhotoId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IsCoverImage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PortfolioId') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($portfolioPhotos as $portfolioPhoto): ?>
            <tr>
                <td><?= $this->Number->format($portfolioPhoto->PhotoId) ?></td>
                <td><?= $this->Number->format($portfolioPhoto->IsCoverImage) ?></td>
                <td><?= $this->Number->format($portfolioPhoto->PortfolioId) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $portfolioPhoto->PhotoId]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $portfolioPhoto->PhotoId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $portfolioPhoto->PhotoId], ['confirm' => __('Are you sure you want to delete # {0}?', $portfolioPhoto->PhotoId)]) ?>
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
