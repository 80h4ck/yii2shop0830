<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>商品列表页</title>
	<link rel="stylesheet" href="/static/style/base.css" type="text/css">
	<link rel="stylesheet" href="/static/style/global.css" type="text/css">
	<link rel="stylesheet" href="/static/style/header.css" type="text/css">
	<link rel="stylesheet" href="/static/style/list.css" type="text/css">
	<link rel="stylesheet" href="/static/style/common.css" type="text/css">
	<link rel="stylesheet" href="/static/style/bottomnav.css" type="text/css">
	<link rel="stylesheet" href="/static/style/footer.css" type="text/css">
	
	<script type="text/javascript" src="/static/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/static/js/header.js"></script>
	<script type="text/javascript" src="/static/js/list.js"></script>
</head>
<body>
<!-- 顶部导航 start -->
<?php
include_once Yii::getAlias("@app/views/common/nav.php");
//include_once "../../common/nav.php";
//echo Yii::getAlias("@app/views/common/nav.php")

?>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 头部 start -->
<?php
include_once Yii::getAlias("@app/views/common/header.php");
//include_once "../../common/nav.php";
//echo Yii::getAlias("@app/views/common/nav.php")

?>

	<div style="clear:both;"></div>

	<!-- 列表主体 start -->
	<div class="list w1210 bc mt10">
		<!-- 面包屑导航 start -->
		<div class="breadcrumb">
			<h2>当前位置：<a href="">首页</a> > <a href="">电脑、办公</a></h2>
		</div>
		<!-- 面包屑导航 end -->

		<!-- 左侧内容 start -->
		<div class="list_left fl mt10">
			<!-- 分类列表 start -->
			<div class="catlist">
				<h2>电脑、办公</h2>
				<div class="catlist_wrap">
					<div class="child">
						<h3 class="on"><b></b>电脑整机</h3>
						<ul>
							<li><a href="">笔记本</a></li>
							<li><a href="">超极本</a></li>
							<li><a href="">平板电脑</a></li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>电脑配件</h3>
						<ul class="none">
							<li><a href="">CPU</a></li>
							<li><a href="">主板</a></li>
							<li><a href="">显卡</a></li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>办公打印</h3>
						<ul class="none">
							<li><a href="">打印机</a></li>
							<li><a href="">一体机</a></li>
							<li><a href="">投影机</a></li>
							</li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>网络产品</h3>
						<ul class="none">
							<li><a href="">路由器</a></li>
							<li><a href="">网卡</a></li>
							<li><a href="">交换机</a></li>
							</li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>外设产品</h3>
						<ul class="none">
							<li><a href="">鼠标</a></li>
							<li><a href="">键盘</a></li>
							<li><a href="">U盘</a></li>
						</ul>
					</div>
				</div>
				
				<div style="clear:both; height:1px;"></div>
			</div>
			<!-- 分类列表 end -->
				
			<div style="clear:both;"></div>	

			<!-- 新品推荐 start -->
			<div class="newgoods leftbar mt10">
				<h2><strong>新品推荐</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li>
							<dl>
								<dt><a href=""><img src="/static/images/list_hot1.jpg" alt="" /></a></dt>
								<dd><a href="">美即流金丝语悦白美颜新年装4送3</a></dd>
								<dd><strong>￥777.50</strong></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img src="/static/images/list_hot2.jpg" alt="" /></a></dt>
								<dd><a href="">领券满399减50 金斯利安多维片</a></dd>
								<dd><strong>￥239.00</strong></dd>
							</dl>
						</li>

						<li class="last">
							<dl>
								<dt><a href=""><img src="/static/images/list_hot3.jpg" alt="" /></a></dt>
								<dd><a href="">皮尔卡丹pierrecardin 男士长...</a></dd>
								<dd><strong>￥1240.50</strong></dd>
							</dl>
						</li>
					</ul>
				</div>
			</div>
			<!-- 新品推荐 end -->

			<!--热销排行 start -->
			<div class="hotgoods leftbar mt10">
				<h2><strong>热销排行榜</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li></li>
					</ul>
				</div>
			</div>
			<!--热销排行 end -->

			<!-- 最近浏览 start -->
			<div class="viewd leftbar mt10">
				<h2><a href="">清空</a><strong>最近浏览过的商品</strong></h2>
				<div class="leftbar_wrap">
					<dl>
						<dt><a href=""><img src="/static/images/hpG4.jpg" alt="" /></a></dt>
						<dd><a href="">惠普G4-1332TX 14英寸笔记...</a></dd>
					</dl>

					<dl class="last">
						<dt><a href=""><img src="/static/images/crazy4.jpg" alt="" /></a></dt>
						<dd><a href="">直降200元！TCL正1.5匹空调</a></dd>
					</dl>
				</div>
			</div>
			<!-- 最近浏览 end -->
		</div>
		<!-- 左侧内容 end -->
	
		<!-- 列表内容 start -->
		<div class="list_bd fl ml10 mt10">
			<!-- 热卖、促销 start -->
			<div class="list_top">
				<!-- 热卖推荐 start -->
				<div class="hotsale fl">
					<h2><strong><span class="none">热卖推荐</span></strong></h2>
					<ul>
						<li>
							<dl>
								<dt><a href=""><img src="/static/images/hpG4.jpg" alt="" /></a></dt>
								<dd class="name"><a href="">惠普G4-1332TX 14英寸笔记本电脑 （i5-2450M 2G 5</a></dd>
								<dd class="price">特价：<strong>￥2999.00</strong></dd>
								<dd class="buy"><span>立即抢购</span></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img src="/static/images/list_hot3.jpg" alt="" /></a></dt>
								<dd class="name"><a href="">ThinkPad E42014英寸笔记本电脑</a></dd>
								<dd class="price">特价：<strong>￥4199.00</strong></dd>
								<dd class="buy"><span>立即抢购</span></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img src="/static/images/acer4739.jpg" alt="" /></a></dt>
								<dd class="name"><a href="">宏碁AS4739-382G32Mnkk 14英寸笔记本电脑</a></dd>
								<dd class="price">特价：<strong>￥2799.00</strong></dd>
								<dd class="buy"><span>立即抢购</span></dd>
							</dl>
						</li>
					</ul>
				</div>
				<!-- 热卖推荐 end -->

				<!-- 促销活动 start -->
				<div class="promote fl">
					<h2><strong><span class="none">促销活动</span></strong></h2>
					<ul>
						<li><b>.</b><a href="">DIY装机之向雷锋同志学习！</a></li>
						<li><b>.</b><a href="">京东宏碁联合促销送好礼！</a></li>
						<li><b>.</b><a href="">台式机笔记本三月巨惠！</a></li>
						<li><b>.</b><a href="">富勒A53g智能人手识别鼠标</a></li>
						<li><b>.</b><a href="">希捷硬盘白色情人节专场</a></li>
					</ul>

				</div>
				<!-- 促销活动 end -->
			</div>
			<!-- 热卖、促销 end -->
			
			<div style="clear:both;"></div>
			
			<!-- 商品筛选 start -->
			<div class="filter mt10">
				<h2><a href="">重置筛选条件</a> <strong>商品筛选</strong></h2>
				<div class="filter_wrap">
					<dl>
						<dt>品牌：</dt>
						<dd class="cur"><a href="">不限</a></dd>
						<dd><a href="">联想（ThinkPad）</a></dd>
						<dd><a href="">联想（Lenovo）</a></dd>
						<dd><a href="">宏碁（acer）</a></dd>
						<dd><a href="">华硕（ASUS）</a></dd>
						<dd><a href="">戴尔（DELL）</a></dd>
						<dd><a href="">索尼（SONY）</a></dd>
						<dd><a href="">惠普（HP）</a></dd>
						<dd><a href="">三星（SAMSUNG）</a></dd>
						<dd><a href="">优派（ViewSonic）</a></dd>
						<dd><a href="">苹果（Apple）</a></dd>
						<dd><a href="">富士通（Fujitsu）</a></dd>
					</dl>

					<dl>
						<dt>价格：</dt>
						<dd class="cur"><a href="">不限</a></dd>
						<dd><a href="">1000-1999</a></dd>
						<dd><a href="">2000-2999</a></dd>
						<dd><a href="">3000-3499</a></dd>
						<dd><a href="">3500-3999</a></dd>
						<dd><a href="">4000-4499</a></dd>
						<dd><a href="">4500-4999</a></dd>
						<dd><a href="">5000-5999</a></dd>
						<dd><a href="">6000-6999</a></dd>
						<dd><a href="">7000-7999</a></dd>
					</dl>

					<dl>
						<dt>尺寸：</dt>
						<dd class="cur"><a href="">不限</a></dd>
						<dd><a href="">10.1英寸及以下</a></dd>
						<dd><a href="">11英寸</a></dd>
						<dd><a href="">12英寸</a></dd>
						<dd><a href="">13英寸</a></dd>
						<dd><a href="">14英寸</a></dd>
						<dd><a href="">15英寸</a></dd>
					</dl>

					<dl class="last">
						<dt>处理器：</dt>
						<dd class="cur"><a href="">不限</a></dd>
						<dd><a href="">intel i3</a></dd>
						<dd><a href="">intel i5</a></dd>
						<dd><a href="">intel i7</a></dd>
						<dd><a href="">AMD A6</a></dd>
						<dd><a href="">AMD A8</a></dd>
						<dd><a href="">AMD A10</a></dd>
						<dd><a href="">其它intel平台</a></dd>
					</dl>
				</div>
			</div>
			<!-- 商品筛选 end -->
			
			<div style="clear:both;"></div>

			<!-- 排序 start -->
			<div class="sort mt10">
				<dl>
					<dt>排序：</dt>
					<dd class="cur"><a href="">销量</a></dd>
					<dd><a href="">价格</a></dd>
					<dd><a href="">评论数</a></dd>
					<dd><a href="">上架时间</a></dd>
				</dl>
			</div>
			<!-- 排序 end -->
			
			<div style="clear:both;"></div>

			<!-- 商品列表 start-->
			<div class="goodslist mt10">
				<ul>
					<li>
						<dl>
							<dt><a href=""><img src="/static/images/goods1.jpg" alt="" /></a></dt>
							<dd><a href="">清华同方精锐X2 台式电脑（双核E3500 2G 500G DVD 键鼠）带20英寸显示器</a></dt>
							<dd><strong>￥2399.00</strong></dt>
							<dd><a href=""><em>已有10人评价</em></a></dt>
						</dl>
					</li>

					<li>
						<dl>
							<dt><a href=""><img src="/static/images/goods2.jpg" alt="" /></a></dt>
							<dd><a href="">富士通LH531 14.1英寸笔记本电脑（i3-2350M 2G 320G 第二代核芯显卡 D刻</a></dd>
							<dd><strong>￥2999.00</strong></dd>
							<dd><a href=""><em>已有5人评价</em></a></dd>
						</dl>
					</li>

					<li>
						<dl>
							<dt><a href=""><img src="/static/images/goods3.jpg" alt="" /></a></dt>
							<dd><a href="">三星Galaxy Tab P6800 7.7英寸 3G手机版 蓝牙3.0 魔丽屏 金属银</a></dd>
							<dd><strong>￥4699.00</strong></dd>
							<dd><a href=""><em>已有34人评价</em></a></dd>
						</dl>
					</li>

					<li>
						<dl>
							<dt><a href=""><img src="/static/images/goods4.jpg" alt="" /></a></dt>
							<dd><a href="">宏碁AS4739-382G32Mnkk 14英寸笔记本电脑（i3-380M 2G 320G D刻 LED背</a></dd>
							<dd><strong>￥2799.00</strong></dd>
							<dd><a href=""><em>已有17人评价</em></a></dd>
						</dl>
					</li>

					<li>
						<dl>
							<dt><a href=""><img src="/static/images/goods5.jpg" alt="" /></a></dt>
							<dd><a href="">ThinkPad E42014英寸笔记本电脑（i5-2450M 2G 320G 蓝牙 摄像头）</a></dd>
							<dd><strong>￥4199.00</strong></dd>
							<dd><a href=""><em>已有8人评价</em></a></dd>
						</dl>
					</li>

					<li>
						<dl>
							<dt><a href=""><img src="/static/images/goods6.jpg" alt="" /></a></dt>
							<dd><a href="">惠普G4-1332TX 14英寸笔记本电脑 （i5-2450M 2G 500G 7450M 1G独显 D刻</a></dd>
							<dd><strong>￥2999.00</strong></dd>
							<dd><a href=""><em>已有22人评价</em></a></dd>
						</dl>
					</li>
				</ul>
			</div>
			<!-- 商品列表 end-->

			<!-- 分页信息 start -->
			<div class="page mt20">
				<a href="">首页</a>
				<a href="">上一页</a>
				<a href="">1</a>
				<a href="">2</a>
				<a href="" class="cur">3</a>
				<a href="">4</a>
				<a href="">5</a>
				<a href="">下一页</a>
				<a href="">尾页</a>&nbsp;&nbsp; 
				<span>
					<em>共8页&nbsp;&nbsp;到第 <input type="text" class="page_num" value="3"/> 页</em>
					<a href="" class="skipsearch" href="javascript:;">确定</a>
				</span>
			</div>
			<!-- 分页信息 end -->

		</div>
		<!-- 列表内容 end -->
	</div>
	<!-- 列表主体 end-->

	<div style="clear:both;"></div>
	<!-- 底部导航 start -->
	<div class="bottomnav w1210 bc mt20">
		<div class="bnav1">
			<h3><b></b> <em>购物指南</em></h3>
			<ul>
				<li><a href="">购物流程</a></li>
				<li><a href="">会员介绍</a></li>
				<li><a href="">团购/机票/充值/点卡</a></li>
				<li><a href="">常见问题</a></li>
				<li><a href="">大家电</a></li>
				<li><a href="">联系客服</a></li>
			</ul>
		</div>
		
		<div class="bnav2">
			<h3><b></b> <em>配送方式</em></h3>
			<ul>
				<li><a href="">上门自提</a></li>
				<li><a href="">快速运输</a></li>
				<li><a href="">特快专递（EMS）</a></li>
				<li><a href="">如何送礼</a></li>
				<li><a href="">海外购物</a></li>
			</ul>
		</div>

		
		<div class="bnav3">
			<h3><b></b> <em>支付方式</em></h3>
			<ul>
				<li><a href="">货到付款</a></li>
				<li><a href="">在线支付</a></li>
				<li><a href="">分期付款</a></li>
				<li><a href="">邮局汇款</a></li>
				<li><a href="">公司转账</a></li>
			</ul>
		</div>

		<div class="bnav4">
			<h3><b></b> <em>售后服务</em></h3>
			<ul>
				<li><a href="">退换货政策</a></li>
				<li><a href="">退换货流程</a></li>
				<li><a href="">价格保护</a></li>
				<li><a href="">退款说明</a></li>
				<li><a href="">返修/退换货</a></li>
				<li><a href="">退款申请</a></li>
			</ul>
		</div>

		<div class="bnav5">
			<h3><b></b> <em>特色服务</em></h3>
			<ul>
				<li><a href="">夺宝岛</a></li>
				<li><a href="">DIY装机</a></li>
				<li><a href="">延保服务</a></li>
				<li><a href="">家电下乡</a></li>
				<li><a href="">京东礼品卡</a></li>
				<li><a href="">能效补贴</a></li>
			</ul>
		</div>
	</div>
	<!-- 底部导航 end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt10">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="/static/images/xin.png" alt="" /></a>
			<a href=""><img src="/static/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="/static/images/police.jpg" alt="" /></a>
			<a href=""><img src="/static/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->


</body>
</html>