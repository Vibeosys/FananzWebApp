<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Portfolio'), ['action' => 'edit', $portfolio->PortfolioId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Portfolio'), ['action' => 'delete', $portfolio->PortfolioId], ['confirm' => __('Are you sure you want to delete # {0}?', $portfolio->PortfolioId)]) ?> </li>
        <li><?= $this->Html->link(__('List Portfolio'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Portfolio'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="portfolio view large-9 medium-8 columns content">
    <h3><?= h($portfolio->PortfolioId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PortfolioId') ?></th>
            <td><?= $this->Number->format($portfolio->PortfolioId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CategoryId') ?></th>
            <td><?= $this->Number->format($portfolio->CategoryId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SubcategoryId') ?></th>
            <td><?= $this->Number->format($portfolio->SubcategoryId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('MinPrice') ?></th>
            <td><?= $this->Number->format($portfolio->MinPrice) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('MaxPrice') ?></th>
            <td><?= $this->Number->format($portfolio->MaxPrice) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsActive') ?></th>
            <td><?= $this->Number->format($portfolio->IsActive) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('FacebookLink') ?></h4>
        <?= $this->Text->autoParagraph(h($portfolio->FacebookLink)); ?>
    </div>
    <div class="row">
        <h4><?= __('YoutubeLink') ?></h4>
        <?= $this->Text->autoParagraph(h($portfolio->YoutubeLink)); ?>
    </div>
    <div class="row">
        <h4><?= __('AboutPortfolio') ?></h4>
        <?= $this->Text->autoParagraph(h($portfolio->AboutPortfolio)); ?>
    </div>
</div>
