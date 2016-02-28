<h1>Blog
    Posts</h1>

<?php
$session = $this->request->session()->read('Auth.User.id');

if($session == null){

    echo $this->Html->link(
        'login',
        '/users/login',
        ['class' => 'button', 'target' => '_blank']
    );
} else {
    echo $this->Html->link(
        'logout',
        '/users/logout',
        ['class' => 'button', 'target' => '_blank']
    );
} ?>
<br>
<?php
echo $this->Html->link(
    'sign up',
    '/users/add',
    ['class' => 'button', 'target' => '_blank']
);



