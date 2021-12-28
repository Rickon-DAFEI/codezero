function checkForm(){
    var Form = document.getElementById("myform");
    var bool = true;
    if(!check1())bool=false;
    if(!check2())bool=false;
    if(!check3())bool=false;
    if(!check4())bool=false;
    if (bool==true) {
        Form.submit();
    }
    return bool;

}
function check1(){
    //nickname
    if(myform.nickname.value==""){
        add_alert3.innerHTML = "昵称不能为空";
        return false;
        // myform.nickname.focus();
    }else{
        add_alert3.innerHTML = "o";
        return true;
    }
}
function check2(){
    //login_account
    var pattern = /^[A-Za-z]+/;
    str = document.getElementById("login_account").value;
    // console.log(pattern.test(str));
    // console.log(str.length);
    if(myform.login_account.value==""){
        add_alert4.innerHTML = "用户名不能为空";
        return false;
        // myform.login_account.focus();
    }else{
        if(!pattern.test(str) || str.length<6 || str.length>15){
            add_alert4.innerHTML = "用户名需要在6~15位且以字母为首";
            return false;
            // myform.login_account.focus();
        }else{
            add_alert4.innerHTML = "o";
            return true;
        }
        
    }

}
function check3(){
    //login_password
    if(myform.login_password.value==""){
        add_alert5.innerHTML = "密码不能为空";
        return false;
        // myform.login_password.focus();
    }else{
        str = document.getElementById("login_password").value;
        if(str.length<6){
            add_alert5.innerHTML = "密码过短";
            return false;
            
        }
        else if(str.length>15){
            add_alert5.innerHTML = "密码过长";
            return false;
        }
        else{
            var pattern1 = /[0-9]/;
            var pattern2 = /[A-Za-z]/;
            var pattern3 = /[@_^%&',;=?$]/;
            var n = 0;//n为密码强度判断
            if(pattern1.test(str)){
                n++;
            }
            if(pattern2.test(str)){
                n++;
            }
            if(pattern3.test(str)){
                n++;
            }
            if(n==1){
                // add_alert2.innerHTML='请输入正确的密码';
                add_alert5.innerHTML = "密码强度低";
                return false;
            }else if(n==2){
                add_alert5.innerHTML = "密码强度中";
                return true;
            }else{
                add_alert5.innerHTML = "密码强度高";
                return true;
            }
        }
        
    }

    
    
}
function check4(){
    if(myform.login_password_re.value != myform.login_password.value){
        add_alert6.innerHTML = "两次密码不一致";
        return false;
        // myform.login_password_re.focus();
    }else if(myform.login_password_re.value==""){
        add_alert6.innerHTML = "不能为空";
        return false;
    }else{
        add_alert6.innerHTML = "o";
        return true;
    }
}