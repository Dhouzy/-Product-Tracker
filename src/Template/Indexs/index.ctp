<h1>Blog
    Posts</h1>

<?php
$session = $this->request->session()->read('Auth.User.id');

if($session == null){

    echo $this->Html->link(
        'login',
        ['controller' => 'Users', 'action' => 'login'],
        ['class' => 'button']
    );
} else {
    echo $this->Html->link(
        'logout',
        ['controller' => 'Users', 'action' => 'logout'],
        ['class' => 'button']
    );
} ?>
<br>
<?php
echo $this->Html->link(
    'sign up',
    ['controller' => 'Users', 'action' => 'add'],
    ['class' => 'button']
);



