<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $portfolioPhoto->PhotoId],
                ['confirm' => __('Are you sure you want to delete # {0}?', $portfolioPhoto->PhotoId)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Portfolio Photos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="portfolioPhotos form large-9 medium-8 columns content">
    <?= $this->Form->create($portfolioPhoto) ?>
    <fieldset>
        <legend><?= __('Edit Portfolio Photo') ?></legend>
        <?php
            echo $this->Form->input('PhotoUrl');
            echo $this->Form->input('IsCoverImage');
            echo $this->Form->input('PortfolioId');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
