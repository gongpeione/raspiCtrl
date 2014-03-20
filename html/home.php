<?php include('functions/functions.php'); ?>        

        <div class="logined">

            <header>
                <h1 class="logined-logo"><i class="fa fa-gears"> </i> Pi</h1>
                <nav class="menu">
                    <ul>
                        <li><a href="#">状态</a></li>
                        <li><a href="#">控制</a></li>
                    </ul>
                </nav>
            </header>
        
            <div class="content">
                <article class="status">
                    <h2>基本信息</h2>
                    <div class="basic-info">
                        <span class="name"><i class="fa fa-desktop"> </i> 主机名：<span><?php getName(); ?></span></span>
                        <span class="os"><i class="fa fa-linux"> </i> 操作系统：<span><?php getVersion(); ?></span></span>
                        <span class="time"><i class="fa fa-clock-o"> </i> 运行时间：<span><?php getUptime(); ?></span></span>
                        <span class="temp"><i class="fa fa-tasks"> </i> 温度：<span><?php getTemp(); echo "&#176;C" ?></span></span>
                    </div>

                    <div class="memory">
                        <div class="num">内存：共 <span class="total"><?php getMemTotal(); echo 'MB'; ?></span> , 已用 <span class="used"><?php getMemUsed(); echo 'MB'; ?></span></div>
                        <div class="line"><div class="now" style="width: <?php getMemPer(); ?>%"></div></div>
                        <div class="num">SWAP：共 <span class="swaptotal"><?php getSwapTotal(); echo 'MB'; ?></span> , 已用 <span class="swapused"><?php getSwapUsed(); echo 'MB'; ?></span></div>
                        <div class="line"><div class="swapnow"></div></div>
                    </div>

                </article>
            </div>
        </div>