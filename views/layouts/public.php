<?php

use yii\helpers\Url;

$identity = Yii::$app->user->identity;
$identity = (Object) $identity;

$account_info = \app\modules\user\models\User::findOne($identity->id);
$username = isset($identity->account) ? $identity->account : 'Guest';
$module = $this->context->module->id;
?>
<?php $this->beginContent('@app/views/layouts/global.php'); ?>
<?php $srcDataPrefix = 'data:image/jpg;base64,'; ?>
<?php $imgUrl = Url::home(true) .'img/'; ?>
    <div id="wrapper" data-url="<?= $_SERVER['REQUEST_URI'] ?>">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" src="<?= $srcDataPrefix . (base64_encode(file_get_contents($imgUrl.'profile_small.jpg'))) ?>" /></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <input type="hidden" title="" id="login-user-id" value="<?= $identity->id ?>">
                                <span class="block m-t-xs"><strong class="font-bold"><?= $username ?></strong></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" href="<?= Url::to(['/user/default/password']) ?>">修改密码</a></li>
                                <li class="divider"></li>
                                <li><a data-method="post" href="<?= Url::to(['/login/default/logout']) ?>">安全退出</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">H+
                        </div>
                    </li>

                    <li class="<?= $module=='home' ? 'active' : '' ?>">
                        <a class="J_menuItem" href="<?= Url::to(['/home/default/index']) ?>"><i class="fa fa-home"></i> <span class="nav-label">主页</span></a>
                    </li>

                    <li class="<?= $module=='task' ? 'active' : '' ?>">
                        <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">任务</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?= Url::to(['/task/task/sent-index']) ?>">已发任务</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/task/task/wait-index']) ?>">待接收任务</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/task/task/received-index']) ?>">已接收任务</a></li>
                        </ul>
                    </li>
                    <li class="<?= $module=='product' ? 'active' : '' ?>">
                        <a href="#"><i class="fa fa-cart-plus"></i> <span class="nav-label">产品</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?= Url::to(['/product/category/root-set']) ?>">根分类设置</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/product/product-category/index']) ?>">产品分类</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/product/product/index']) ?>">产品管理</a></li>
                        </ul>
                    </li>
                    <li class="<?= $module=='customer' ? 'active' : '' ?>">
                        <a href="#"><i class="fa fa-user-secret"></i> <span class="nav-label">客户</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?= Url::to(['/customer/customer/index']) ?>">外部客户</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/customer/group/rate']) ?>">集团公司评级</a></li>
                        </ul>
                    </li>
                    <li class="<?= $module=='finance' ? 'active' : '' ?>">
                        <a href="#"><i class="fa fa-money"></i> <span class="nav-label">财务</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?= Url::to(['/finance/payment/index']) ?>">付款单</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/finance/receipt/index']) ?>">收款单</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/finance/statement/index']) ?>">流水账</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/finance/finance/summary']) ?>">公司账目汇总</a></li>
                        </ul>
                    </li>
                    <li class="<?= $module=='user' ? 'active' : '' ?>">
                        <a href="#"><i class="fa fa-user"></i> <span class="nav-label">用户</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?= Url::to(['/user/user/index']) ?>">用户管理</a>
                            <li><a class="J_menuItem" href="<?= Url::to(['/user/company/index']) ?>">公司管理</a>
                            <li><a class="J_menuItem" href="<?= Url::to(['/user/department/index']) ?>">部门管理</a>
                            <li><a class="J_menuItem" href="<?= Url::to(['/user/posts/index']) ?>">岗位管理</a>
                        </ul>
                    </li>
                    <li class="<?= $module=='system' ? 'active' : '' ?>">
                        <a href="#"><i class="fa fa-gear"></i> <span class="nav-label">系统</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/task/index']) ?>">任务中心</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/payment/index']) ?>">付款中心</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/receipt/index']) ?>">收款中心</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/root-category/index']) ?>">根分类列表</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/product-category/index']) ?>">产品分类中心</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/product/index']) ?>">产品中心</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/group/rate']) ?>">集团公司级别表</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/customer/index']) ?>">外部客户管理</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/money/index']) ?>">货币管理</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/finance-subject/index']) ?>">财务科目管理</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/statement/index']) ?>">流水账中心</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/finance/summary']) ?>">公司账目中心</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/notice/index']) ?>">通知中心</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/login/record']) ?>">登录记灵</a></li>
                            <li><a class="J_menuItem" href="<?= Url::to(['/system/login/ip-lock']) ?>">IP登录锁定</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">

                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <?= $identity->account; ?>(<?= $account_info['company']['name'].'、'.$account_info['department']['name'].'、'.$account_info['posts']['name'] ?>)
                            </a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" href="<?= Url::to(['/user/default/password']) ?>">密码修改</a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" href="<?= Url::to(['/system/notice/user-index']) ?>">
                                <i class="fa fa-bell"></i> <span class="label label-primary" id="message-count"></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row content-tabs">
                <span class="pull-left m-l-xs">当前位置：</span>
                <a>
                    <?php
                        echo \yii\widgets\Breadcrumbs::widget([
                            //'tag'=>'h2',
                            // 'homeLink'=>[
                            //    'label'=>'后台首页>>', 修改默认的Home
                            //    'url'=>Url::to(['index/index']), 修改默认的Home指向的url地址
                            // ],

                            'homeLink'=>false, // 若设置false 则 可以隐藏Home按钮
                            //'homeLink'=>['label' => '主 页','url' => Yii::$app->homeUrl.'home/'], // 若设置false 则 可以隐藏Home按钮
                            'itemTemplate'=>"<span>{link} > </span>",
                            'activeItemTemplate'=>"<span>{link}</span>",
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ])
                    ?>
                </a>
                <a data-method="post" href="<?= Url::to(['/login/default/logout']) ?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main" style="overflow: auto">
                <?= isset($content) ? $content : '' ?>
            </div>
            <div class="footer">
                <div class="pull-right">Yii: <?= Yii::getVersion() ?> &copy; 2016-2017 <a href="#" target="_blank">oa-system</a>
                </div>
            </div>
        </div>
        <!--右侧部分结束-->
        <!--右侧边栏开始-->

        <!--右侧边栏结束-->
        <!--mini聊天窗口开始-->
        <!--mini聊天窗口结束-->
    </div>
<?php $this->endContent(); ?>

