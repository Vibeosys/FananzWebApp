<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->UserId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->UserId], ['confirm' => __('Are you sure you want to delete # {0}?', $user->UserId)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->UserId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('FirstName') ?></th>
            <td><?= h($user->FirstName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LastName') ?></th>
            <td><?= h($user->LastName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('EmailId') ?></th>
            <td><?= h($user->EmailId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->Password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('MobileNo') ?></th>
            <td><?= h($user->MobileNo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UserId') ?></th>
            <td><?= $this->Number->format($user->UserId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsFacebookUser') ?></th>
            <td><?= $this->Number->format($user->IsFacebookUser) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsActive') ?></th>
            <td><?= $this->Number->format($user->IsActive) ?></td>
        </tr>
    </table>
</div>
