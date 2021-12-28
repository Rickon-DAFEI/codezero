function showLogin(){
				document.getElementById("modal-Register").classList.add("hide");
				document.getElementById("shade").classList.remove("hide");
				document.getElementById("modal").classList.remove("hide");
			}
			function hideLogin(){
				document.getElementById("shade").classList.add("hide");
				document.getElementById("modal").classList.add("hide");
			}
			function showRegister(){
				document.getElementById("modal").classList.add("hide");
				document.getElementById("shade").classList.remove("hide");
				document.getElementById("modal-Register").classList.remove("hide");
			}
			function hideRegister(){
				document.getElementById("shade").classList.add("hide");
				document.getElementById("modal-Register").classList.add("hide");
			}
function goTop() {
	document.documentElement.scrollTop = 0;
}
function goSetting() {
	document.documentElement.scrollTop = 130;
}
function goAvatar() {
	document.documentElement.scrollTop = 550;
}
function goPassword() {
	document.documentElement.scrollTop = 1340;
}
function goEmail() {
	document.documentElement.scrollTop = 1600;
}
function bodyScroll() {
	var s = document.documentElement.scrollTop;
	var t = document.getElementById('goTop');
	var n = document.getElementById('nav');
	if(s >= 225){
		t.classList.remove('hide');
	}else{
		t.classList.add('hide');
	}
	if(s >= 210){
		n.classList.add('fixed');
		// n.classList.remove('self-small-item-box');
	}else{
		// n.classList.add('self-small-item-box');
		n.classList.remove('fixed');
	}
}
function login_check()
{
	var ac_str = login_form.account.value;
	var ps_str = login_form.password.value;
	var ac_len = ac_str.length;
	var ps_str = ps_str.length;
	if(ac_len>15||ac_len<6)
	{
		login_form.account.focus();	
		add_alert1.innerHTML='请输入正确的用户名';
		return false;
	}
	if(ps_str>15||ps_str<6)
	{
		login_form.account.focus();	
		add_alert2.innerHTML='请输入正确的密码';
		return false;
	}
	return true;
}
function sign_check()
{
	var name_str = sign_form.nickname.value;
	var login_ac_str = sign_form.login_account.value;
	var login_ps_str = sign_form.login_password.value;
	var loginRe_ps_str = sign_form.login_password_re.value;
	if(loginRe_ps_str!=login_ps_str){
		sign_form.login_password.value ='';
		sign_form.login_password_re.value='';
		sign_form.login_password.focus();	
		add_alert5.innerHTML='两次输入的密码不统一';
		return false;
	}
	var patrn=/^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){6,15}$/;
	var patrn2 = /^([0-9a-zA-Z]+){6,15}$/;
	if (!patrn.exec(login_ac_str)){
		add_alert3.innerHTML='用户名需要在6~15位且以字母为首';
		return false;
	}
	if (!patrn2.exec(login_ps_str)){
		add_alert5.innerHTML='请输入6~13位包含字母和数字的密码';
		return false;
	}
	return true;
}

