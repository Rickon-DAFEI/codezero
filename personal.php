<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<link href="logo.jpg" rel="shortcut icon">
	<title>个人中心</title>
	<link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/ys.css">
	<script src="js/vue.js"></script>
	<!-- <script src="js/vue.js"></script> -->
	<script src="js/axios.min.js"></script>
	<script src="js/vue-router.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="layui/css/layui.css"> -->
	<!-- <script scr="layui/layui.js"></script> -->
</head>
<body onscroll="bodyScroll();">
	<div class="pg-header">
		<div class="nav">
            <a class="left" href="index.php"><img class="logo" src="logo.jpg" alt="CodeZero"></a>
			<ul>
				<!-- <li><a class="left nav-selection-xhx" href="">导图</a></li>
				<li><a class="left" href="search.php">题库</a></li>
				<li><a class="left" href="">比赛</a></li> -->
				<li><? 
				// if(!isset($_SESSION['admin'])){
				// 	echo "<input type=\"button\" class=\"right home\" value=\"HOME\" onclick=\"showLogin();\"/></input>";
				// }
				// else{
				// 	echo "<li><div class=\"right logout\"><form action=\"\" method=\"POST\"><input class=\"outsubmit\" type=\"submit\" name=\"login_out\" value=\"退出登录\"/></form></div></li>
				// 	<li><div class=\"right nickname\">个人中心</div></li>";
				// }
				 ?>	
				 </li>
				<li><a class="left" href="index.php">导图</a></li>
				<li><a class="left" href="search.php">题库</a></li>
				<li><a class="left" href="">比赛</a></li>
				 <li><?
				session_start();
				if(isset($_POST['login_out'])){
					unset($_SESSION['admin']);
					unset($_SESSION['nick']);
					unset($_SESSION['user_img_url']);
					session_destroy();
				}
				if(!isset($_SESSION['admin'])){
					echo "<script>alert('请先登陆!')</script>";
					echo "<script>window.location='index.php'</script>";
				}
				else{
					echo "<div class=\"right logout\"><form action=\"\" method=\"POST\"><input class=\"outsubmit\" type=\"submit\" name=\"login_out\" value=\"退出登录\"/></form></div>
					<div class=\"right nickname\"><a href=\"personal.php\">".$_SESSION['nick']."</a></div>";
				
				}
				 ?>	 
				 </li>
			</ul>
		</div>
		
    </div>

    <div class="pg-body form clearfix">

        <div class="self-box-subject clearfix">

            <div class="self-triangle"></div>

		    <div class="self-body-header">		    	 
		    	<div class="self-item-nav">
                    <li><a class="left self-item self-selection" href="">个人空间</a></li>
                    <li><a class="left self-item" href="personMas.php">信息修改</a></li>
                    <li><a class="left self-item" href="">意见反馈</a></li>
	            </div>		   
            </div>

            <div class="self-small-head"></div>

            <div class="avatar">
                <img class="avatarImg" src="<?=$_SESSION['user_img_url']?>" alt="">
            </div>
            <div class="card-text">
                <ul>
                    <li class="self-nickname">昵称 <?=$_SESSION['nick']?></li>
                    <li class="self-nickname-"><??></li>
                    <li class="self-name">用户名 <br><?=$_SESSION['admin']?></li>
                    <li class="self-name-"></li>
                </ul>
            </div>
		<div class="mes_container">
            <div class="self-small-item-box clearfix">
                <div class="self-connect"></div>
                <div class="self-small-item">答题情况</div>
                <div class="self-connect"></div>
                <div class="self-small-item self-small-selection">提交记录</div>
                <div class="self-connect"></div>
                <div class="self-small-item">比赛记录</div>
			</div>
            
			<div id ="mes_table">
			<table class="layui-table">
				<colgroup>
					<col width="150">
					<col width="200">
					<col>
				</colgroup>
				<thead>
					<tr>
					<th>题号</th>
					<th>提交时间</th>
					<th>语言</th>
					<th>提交状态</th>
					<th >代码预览</th>
					</tr> 
				</thead>
				<tbody>
					<tr v-for="each in reslis">
						<!-- <td >{{each.pro_id}}</td>
						<td >{{each.sub_time}}</td>
						<td >{{each.language}}</td>
						<td >{{each.status}}</td>
						<td ><a @click="get_code(each.index)">点击跳转</a></td> -->
						<!-- 不写了不写了 -->
					</tr>
				</tbody>

			</table>
			</div>
		</div>
		<div id="shade" class="shade hide"></div>

		<div id="modal" class="modal hide">
			<span style="margin-top: 10px;cursor: pointer;" class="go-icon-cancal
			 fa fa-times right " aria-hidden="true" onclick="hideLogin();"></span>
			<div class="box">
                <h2>登录</h2>
				<form name = "login_form" action="" method="POST" autocomplete="off" onsubmit = "return login_check()">
                    <div class="inputBox">
						<input type="text" name="account" required=""/>
						<div id ='add_alert1' class = "alert_word"></div>
                        <label>用户名</label>
                    </div>	
                    <div class="inputBox">
						<input type="password" name="password" required=""/>
						<div id ='add_alert2' class = "alert_word"></div>
                        <label>密码</label>
                    </div>
                    <input type="submit" name="" class="left" value="提交"/>
                    <input type="button" name="" class="right Register" value="注册" onclick="showRegister();"/>
				</form>

            </div>
		</div>
        
		<span id="goTop" class="icon fa fa-eject hide" aria-hidden="true" onclick="goTop();"></span>
    </div>
	<script src="js/sub.js"></script>
	<!-- <script src="js/main.js"></script> -->
</body>
</html>