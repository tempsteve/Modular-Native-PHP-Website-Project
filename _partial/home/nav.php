<nav class='navbar navbar-home navbar-fixed-top'>
    <div class='container'>
        <div class='navbar-header'>
            <button class='navbar-toggle collapsed' data-toggle='collapse' data-target='#pnlMainNav' aria-expanded='false'>
                網頁選單
                <span class='glyphicon glyphicon-list'></span>
            </button>
        </div>
        <div class='collapse navbar-collapse' id='pnlMainNav'>
            <ul class='nav navbar-nav'>
                <li <?=(strpos(strtolower($_SERVER['REQUEST_URI']), 'news') !== false)?'class="active"':''?>><a href='<?=SITE_DOMAIN_NAME?>index.php'>最新消息</a></li>
                <li <?=(strpos(strtolower($_SERVER['REQUEST_URI']), 'page1') !== false)?'class="active"':''?>><a href='<?=SITE_DOMAIN_NAME?>page1.php'>Page 1</a></li>
            </ul>
            <?php if ($_SESSION[SITE_CODE]['user']['type'] == 'admin') : ?>
                <ul class='nav navbar-nav navbar-right'>
                    <li><a href='<?=SITE_URL?>Manage/'>管理系統</a></li>
                    <li><a href='<?=SITE_URL?>Logout.php'>登出</a></li>
                </ul>
            <?php else : ?>
                <ul class='nav navbar-nav navbar-right'>
                    <li><a href='<?=SITE_URL?>Manage/login.php'>登入</a></li>
                </ul>
            <?php endif ?>
        </div>
    </div>
</nav>
