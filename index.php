<?php
	/*
	* FlyingSky-CN / NodeStatus
	*
	* @index.php
	*/
	
	/* Config */
	$site = "";//站点名
	$title = "Status";//页面名
	$icon = "";//图标
	$gtag = "";//Google统计代码
	$headpic = "";//头图
	
	/* Get Data */
	$data = json_decode(file_get_contents("info.json"));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="shortcut icon" href="<?=$icon?>" />
        <title><?=$title?> - <?=$site?></title>
        <link rel="stylesheet" href="/sources/style.min.css" />
        <link rel="stylesheet" href="/sources/style.css" />
    </head>
    <body class="head-fixed">
        <!--[if lt IE 9]>
            <div class="browsehappy">当前网页可能 <strong>不支持</strong> 您正在使用的浏览器. 为了正常的访问, 请 <a href="https://api.i-meto.com/chrome.page">升级您的浏览器</a>.</div>
        <![endif]-->
        <header id="header">
            <div class="container clearfix">
                <div class="site-name">
                    <h1>
                        <a id="logo" href="https://board.fsky7.com/" style="margin-left: 8px;">
                        <?=$site?></a>
                    </h1>
                </div>
                <div id="nav"> 
                    <ul class="nav-menu"> 
                        <li><a href="/" target="_blank">Some item here</a></li>
                    </ul> 
                </div>
            </div>
        </header>
        <div id="body">
            <div class="container clearfix">
                <div id="main">
                    <article class="post">
                        <h2 class="post-title"><a href="/"><?=$title?></a></h2>
                        <ul class="post-meta">
                            <li>Some item here</li>
                        </ul>
                        <div class="post-content">
                            <p class="thumb"><img src="<?=$headpic?>" /></p>
                            <p style="margin-bottom: 0px;">Some words here</p>
                        </div>
                    </article>
					<?php
						if($data->status == 'OK') {
							foreach( $data->data[0] as $value ) {
								//更新时间
								$uptime = date('Y-m-d H:i:s',$value->update_time);
								//内存
								$ram_total = round($value->ram_total / 1024 / 1024);
								$ram_use = round($value->ram_usage / 1024 / 1024);
								$ram_percent = @round($value->ram_usage / $value->ram_total * 100);
								//磁盘
								$disk_total = round($value->disk_total / 1024 / 1024 / 1024);
								$disk_usage = sprintf("%.1f", $value->disk_usage / 1024 / 1024 / 1024); 
								$disk_percent = @round($value->disk_usage / $value->disk_total * 100);
								//网络
								$network_rx = round($value->current_rx / 1024 / 180);
								$network_tx	= round($value->current_tx / 1024 / 180);
								//可用性
								if($value->status == 'active') {
									$color = 'green';
									$status = '正常';
								}
								else {
									$color = 'red';
									$status = $value->status;
								}
					?>
					<article class="post">
						<h2 class="post-title"><?=$value->name?></h2>
						<ul class="post-meta">
							<li><a style="color:<?=$color?>;"><?=$status?></a></li>
						</ul>
						<div class="post-content">
							<p><div class="fs-go"><div class="fs-go-inner" style="width:32%;"></div></div></p>
							<p>
								<b>CPU</b> <?=$value->load_percent?>% <br/>
								<b>负载</b> <?=$value->load_average?> <br/>
								<b>内存</b> <?php echo $ram_use."MB/".$ram_total."MB"; ?> <br/>
								<b>磁盘</b> <?php echo $disk_usage."GB/".$disk_total."GB"; ?> <br/>
								<b>网络</b> ↑<?php echo $network_tx."kb/s"; ?> ↓<?php echo $network_rx."kb/s"; ?> <br/>
								<b>可用性</b> <?php echo $value->availability; ?> </p>
						</div>
					</article>
					<?php
							}
						}
					?>
				</div>
                <div id="secondary">
                    <section class="widget">
                        <h3 class="widget-title">侧边栏</h3>
                        <ul class="widget-list">
                            <li><a href="/">随便写点啥</a></li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
        <footer id="footer">
            <div class="container">
				<p>Copyright &copy; 2019 <a href="/"><?=$title?></a>. Desinged by <a href="http://www.offodd.com/17.html" target="_blank">Initial</a>.</p>
            </div>
        </footer>
        <div id="cornertool">
            <ul>
                <li id="top" class="hidden"></li>
            </ul>
        </div>
        <script>
        window.onscroll=function(){var a=document.documentElement.scrollTop||document.body.scrollTop;var b=document.getElementById("top");if(a>=200){b.removeAttribute("class")}else{b.setAttribute("class","hidden")}b.onclick=function totop(){var a=document.documentElement.scrollTop||document.body.scrollTop;if(a>0){requestAnimationFrame(totop);window.scrollTo(0,a-(a/5))}else{cancelAnimationFrame(totop)}};var d=document.getElementById("header");if(a>0&&a<30){d.style.padding=(15-a/2)+"px 0"}else if(a>=30){d.style.padding=0}else{d.removeAttribute("style")};}
        </script>
		<?php
			if ($gtag) {
		?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?=$gtag?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?=$gtag?>');
        </script>
		<?php
			}
		?>
    </body>
</html>