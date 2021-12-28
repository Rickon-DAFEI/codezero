var storage=window.localStorage;
var root = new Vue({
    el:".big-item-nav",
    mounted(){
        this.getroot()
    },
    data:{
        json:{
            page_index:'main',
        },
        se:storage['root_index'],
        rootlist:[],
        types:[]
    },
    methods:{
        select:function(index){
            var temp_root = this;
            temp_root.se = index;
            storage['back_son_index'] = 0;
            storage['back_root_index'] = temp_root.se;
        },
        getroot:function(){
            var that = this;
            axios.post('web.php',this.json).then(function (response) {
                datas = response['data'];
                // console.log(datas)
                that.rootlist = datas.split(",");
                that.rootlist.shift();
                for(i=0;i<that.rootlist.length;i++){
                    that.types.push({
                        index:i,
                        type:that.rootlist[i],
                    })
                    // console.log(that.rootlist[i]);
                }
                // console.log(that.rootlist)
        }).catch(function (error) {
        　　alert(error);
        });
        }
    }
});
var son = new Vue({
    el:".small-item-box",
    mounted(){
        this.getsonlis()
    },
    data:{
        query_data:{
            page_index:'son',
            son_index:storage.root_index,
        },
        sonse:storage['son_index'],
        sonlist:[],
        sontypes:[]
    },
    methods:{
        se:function(k){
            var temp2 = this;
            temp2.sonse = k;
            storage['back_son_index'] = k;
            storage['back_root_index'] = root.se;
        },
        getsonlis:function(){
            var that_son = this;
            axios.post('web.php',that_son.query_data).then(function (response) {
                sonlis = response['data'];
                // console.log(sonlis);
                that_son.sontypes = [];
                that_son.sonlist = sonlis.split(",");
                that_son.sonlist.shift();
                for(i=0;i<that_son.sonlist.length;i++){
                    // console.log(that_son.sonlist[i]),
                    that_son.sontypes.push({
                        index:i,
                        type:that_son.sonlist[i],
                    })
                }

        }).catch(function (error) {
        　　alert(error);
        });
    }
}
})
var pro_main = new Vue({
    el:'#pro_describe',
    mounted(){
        this.getsonlis()
    },
    data:{
        id:storage.pro_id,
        title:storage.pro_title,
        limit:'',
        des:'',
        input:'',
        output:'',
        sample_input:'',
        sample_output:'',
        hint:'',
        resource:'',
        query_post:{
            page_index:'pro_main',
            pro_id:storage.pro_id
        }
    },
    methods:{
        getsonlis:function(){
            var tp = this;
            axios.post('pro_server.php',tp.query_post).then(function (response) {
                sonlis = response['data'];
                // console.log(sonlis);
                tp.limit = sonlis[1];
                tp.des = sonlis[2];
                tp.input = sonlis[3];
                tp.output = sonlis[4];
                tp.sample_input = sonlis[5];
                tp.sample_output = sonlis[6];
                tp.resource = sonlis[7];
                tp.hint = sonlis[8];
        }).catch(function (error) {
        　　alert(error);
        });
    }
    }

})
var editer_body = new Vue({
    el: '.bd_sr',
    data: {
        selected: 'c_cpp',
        th_selected:'xcode',
        th_options: [
            { text: 'xcode', value: 'xcode' },
            { text: 'clouds', value: 'clouds' },
            { text: 'kuroir', value: 'kuroir' },
            { text: 'eclipse', value: 'eclipse' },
            { text: 'terminal', value: 'terminal' },
            { text: 'monokai', value: 'monokai' },
            
            ],
        options: [
        { text: 'C++', value: 'c_cpp',index:1},
        { text: 'Python3', value: 'python',index:2 },
        { text: 'Java', value: 'java',index:3 }
        ],
        status:'',
        inputTemp:'',
        outputTemp:'',
        self_input:'',
        username:'',
        self_input_sit:0,
        InputActive:true,
        ResActive:true,
    },
    methods:{
        change_lan:function(){
            var that = this;
            // console.log(this.selected);
            editor.session.setMode("ace/mode/" + that.selected);
            editor.setValue('');
        },
        change_th:function(){
            var that_t = this;
            // console.log(that_t.th_selected);
            editor.setTheme("ace/theme/" + that_t.th_selected);
        },
        set_empty:function(){
            editor.setValue('');
        },
        changeVal(val) {
            this.inputText = val.target.innerText;
            this.self_input = this.inputText;
        },
        getFocus (val) {
            this.inputTemp='';
            if (!this.inputText) {
                val.target.innerText = '';
                // this.placeholderText = '';
            }
        },
        get_value:function(e){
            
            var that = this;
            axios.post('user_server.php').then(function (response) {
                res = response['data'];
                if(res.isLogin=='no'){
                    alert("请先登录");
                    this.stopTimer;
                    // location.reload();
                    return ;
                }
                else{
                    that.username = res.user;
                    let param = new URLSearchParams();
                    res = editor.getValue();
                    if(res==''){
                        return ;
                    }
                    that.self_input_sit=e;
                    that.status="";
                    if(this.selected=='python'){
                        param.append('lan_index','2');
                    }
                    else if(this.selected=='java'){
                        param.append('lan_index','3');
                    }
                    else{
                        param.append('lan_index','1');
                    }
                    param.append('title',storage.pro_id);
                    param.append('code_body',res);
                    // param.append('case_in',that.inputTemp);
                    if(e==0){
                        that.ResActive=true;
                        that.InputActive=true;
                        that.inputTemp=pro_main.sample_input;
                        param.append('case_in',pro_main.sample_input);
                    }
                    else{
                        if(that.self_input!="")
                            param.append('case_in',that.self_input);
                        else{
                            that.inputTemp=pro_main.sample_input;
                            param.append('case_in',pro_main.sample_input);
                        }
                    }
                    param.append('self_sit',e);
                    param.append('username',that.username);
                    // console.log(param);
                    axios.post('http://localhost:8080/codezero_war_exploded/ReturnAnser',param).then(function (response) {
                        sonlis = response.data;
                        // console.log(sonlis);
                        if(e==1){
                            if(sonlis.weave_sit==1){
                                that.status="Compilation Error";
                                that.outputTemp=sonlis.weave_error;
                                that.ResActive=false;
                                that.InputActive=true;
                            }
                            else {
                                that.ResActive=false;
                                that.InputActive = false;
                                that.inputTemp = sonlis.case_in;
                                that.outputTemp = sonlis.case_out;
                            }
                        }
                        else{
                            if(sonlis.weave_sit==1){
                                that.status="Compilation Error";
                                // that.status="Compilation Error";
                                that.outputTemp=sonlis.weave_error;
                                that.ResActive=false;
                                that.InputActive=true;
                            }
                            else{
                                that.status=sonlis.run_status;
                            }
                        }
                      
                    }).catch(function (error) {
                        alert(error);
                    });
                }
        }).catch(function (error) {
        　　alert(error);
        });
          
            // console.log(this.finnal_prarm);
            // console.log(res);
            // var that = this;
            // let param = new URLSearchParams();
            // param.append('back','111');
            // param.append('now','222');
            // axios.post('http://localhost:8080/codezero_war_exploded/ReturnAnser',param).then(function (response) {
            //     sonlis = response;
            //     console.log(sonlis.data);
            // }).catch(function (error) {
            //     alert(error);
            // });
        }
    }
})
editor = ace.edit("code");
            //设置风格和语言（更多风格和语言，请到github上相应目录查看）
            theme = "clouds"
            language = "c_cpp"
            editor.setTheme("ace/theme/" + theme);
            editor.session.setMode("ace/mode/" + language);
            
            //字体大小
            editor.setFontSize(18);
            
            //设置只读（true时只读，用于展示代码）
            editor.setReadOnly(false); 
            
            //自动换行,设置为off关闭
            editor.setOption("wrap", "free")
            
            //启用提示菜单
            ace.require("ace/ext/language_tools");
            editor.setOptions({
                    enableBasicAutocompletion: true,
                    enableSnippets: true,
                    enableLiveAutocompletion: true
                });