<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<link href="logo.jpg" rel="shortcut icon">
	<title>修改头像</title>
	<link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/ys.css">
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
	<script src="js/login.js"></script>
</head>
<body onscroll="bodyScroll();">
	<div class="pg-header">
		<div class="nav">
            <a class="left" href="index.php"><img class="logo" src="logo.jpg" alt="CodeZero"></a>
			<ul>
				<li><a class="left" href="index.php">导图</a></li>
				<li><a class="left" href="search.php">题库</a></li>
				<li><a class="left" href="">比赛</a></li>
				<li><? 
				// session_start();
				// if(isset($_POST['login_out'])){
				// 	unset($_SESSION['admin']);
				// 	unset($_SESSION['nick']);
				// 	unset($_SESSION['user_img_url']);
				// 	session_destroy();
				// }
				// if(!isset($_SESSION['admin'])){
				// 	echo "<script>alert('非法访问!')</script>";
				// 	echo "<script>window.location='index.php'</script>";
				// }
				// else{
				// 	echo "<div class=\"right logout\"><form action=\"\" method=\"POST\"><input class=\"outsubmit\" type=\"submit\" name=\"login_out\" value=\"退出登录\"/></form></div>
				// 	<div class=\"right nickname\"><a href=\"personal.php\">".$_SESSION['nick']."</a></div>";
				
				// }
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
                    <li><a class="left self-item " href="personal.php">个人空间</a></li>
                    <li><a class="left self-item self-selection" href="">信息修改</a></li>
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
                    <li class="self-name">用户名 <?=$_SESSION['admin']?></li>
                    <li class="self-name-"></li>
                </ul>
            </div>
            
            <div class="self-small-item-box clearfix">
            <div class="self-connect"></div>
                <div class="self-small-item">基本资料</div>
                <div class="self-connect"></div>
                <div class="self-small-item self-small-selection">修改头像</div>
                <div class="self-connect"></div>
                <div class="self-small-item">修改密码</div>
				<div class="self-connect"></div>
                <div class="self-small-item">安全中心</div>
            </div>
            
            <div class="self-content clearfix">
				<form style="text-align: center;width: 400px;margin: 0 auto;border: 1px solid #6a6a6a;height: 730px;border-radius: 5px;padding: 20px 216.5px;" action="" method="post" name="form" enctype="multipart/form-data"  onsubmit="return check()">
                <div class="a-upload">
                        <input type="file" name="pic" id="" style="width: 76px;height: 38px;">选择图片
                    </div>
                    <p style="color: #6a6a6a;">仅支持……图片文件，文件小于……</p>
                    <div>
                        <div class="avatar-addr">
                            <img class="change-avatar" src="" alt="">
                        </div>
                    </div>    
                    <div>
                        <input class="self-submit" type="submit" name="query" value="提交查询"/>
                        <input class="self-submit" type="submit" name="query" value="上传"/>
                    </div>                
                    <div class="avatar-preview">
                    <p style="color: #6a6a6a;font-weight:500;font-size:18px;">头像预览</p>
                        <div class="avatar160">
                            <img src="" alt=""><span class="text160">160×160</span>
                        </div>
                        <div class="avatar90">
                            <img src="" alt=""><span class="text90">90×90</span>
                        </div>
                        <div class="avatarc">
                            <img src="" alt=""><span class="textc">120×120</span>
                        </div>
                    </div>
				</form>			
			</div>

        