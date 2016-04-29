<li>
    <?= $this->Html->link($username . "&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-user'></span>",
        ['controller' => 'Users', 'action' => 'profile'], ['escape' => false]) ?></li>
<li>
    <?= $this->Html->link("<span class='glyphicon glyphicon-log-out'></span>",
        ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]) ?>
</li>