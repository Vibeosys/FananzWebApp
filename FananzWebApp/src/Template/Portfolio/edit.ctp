<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $portfolio->PortfolioId],
                ['confirm' => __('Are you sure you want to delete # {0}?', $portfolio->PortfolioId)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Portfolio'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="portfolio form large-9 medium-8 columns content">
    <?= $this->Form->create($portfolio) ?>
    <fieldset>
        <legend><?= __('Edit Portfolio') ?></legend>
        <?php
            echo $this->Form->input('CategoryId');
            echo $this->Form->input('SubcategoryId');
            echo $this->Form->input('FacebookLink');
            echo $this->Form->input('YoutubeLink');
            echo $this->Form->input('AboutPortfolio');
            echo $this->Form->input('MinPrice');
            echo $this->Form->input('MaxPrice');
            echo $this->Form->input('IsActive');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
