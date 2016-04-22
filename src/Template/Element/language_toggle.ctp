<?php
    $session = $this->request->session();
    $switchLanguage = ($session->read('Config.language') == 'fr' ? 'en' : 'fr');
    $languageDisplay = strtoupper($switchLanguage);
    echo $this->Html->link($languageDisplay,
                           ['controller' => 'Langs',
                            'action' => 'switchLang',
                            'l' => $switchLanguage,
                            'fromUrl' => $this->request->here]);
?>