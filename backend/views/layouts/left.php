<?php

use mdm\admin\components\MenuHelper;
$callback = function($menu){
    $data = eval($menu['data']);

    return [
        'label' => $menu['name'],
        'icon' => isset($data['icon']) ? $data['icon'] : '',
        'url' => [$menu['route']],
        'options' => is_array($data) ? $data : [],
        'items' => $menu['children'],
    ];
};

$items = MenuHelper::getAssignedMenu(Yii::$app->user->id, 1, $callback, true);
array_unshift($items, ['label' => 'MAIN NAVIGATION', 'options' => ['class' => 'header']]);
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->userProfile->getName()?></p>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu treeview', 'data-widget'=> 'tree'],
                'items' => $items
            ]
        ) ?>

    </section>

</aside>
