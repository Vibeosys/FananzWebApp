<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Portfolio Photo'), ['action' => 'edit', $portfolioPhoto->PhotoId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Portfolio Photo'), ['action' => 'delete', $portfolioPhoto->PhotoId], ['confirm' => __('Are you sure you want to delete # {0}?', $portfolioPhoto->PhotoId)]) ?> </li>
        <li><?= $this->Html->link(__('List Portfolio Photos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Portfolio Photo'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="portfolioPhotos view large-9 medium-8 columns content">
    <h3><?= h($portfolioPhoto->PhotoId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PhotoId') ?></th>
            <td><?= $this->Number->format($portfolioPhoto->PhotoId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsCoverImage') ?></th>
            <td><?= $this->Number->format($portfolioPhoto->IsCoverImage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PortfolioId') ?></th>
            <td><?= $this->Number->format($portfolioPhoto->PortfolioId) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('PhotoUrl') ?></h4>
        <?= $this->Text->autoParagraph(h($portfolioPhoto->PhotoUrl)); ?>
    </div>
</div>
