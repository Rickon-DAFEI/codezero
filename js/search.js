var storage=window.localStorage;
var pageBar = new Vue({
    el: '.page-bar',
    mounted(){
        this.page_array=[]
        this.getpageNum()
    },
    data: {
        now:1,
        all: 8, //总页数//当前页码
        query_type:{
            ask:"page_num",
            word:storage['search_word'],
        },
        page_array:[],
    },  
	methods: {
    page_init:function(){
        that = this;
        // console.log(that.all);
        if(that.all<15){
            for(i=1;i<=that.all;i++){
                that.page_array.push(i);
            }
        }
        else{
            for(i=1;i<=15;i++){
                that.page_array.push(i);
            }
        }
        // console.log(that.page_array);
    },
    btnClick: function(data){//页码点击事件
        var that = this;
        that.now = data;
        jump_vue.page_index=data;
        get_lis.getprolis();
	},
	pageClick: function(e){
        ar = this.page_array;
        if(e==-1&&this.now>1){
            this.now--;
        }
        else if(e==1&&this.now!=this.all){
            this.now++;
        }
        if(e==1&&this.all>15&&(this.all-this.now)>7&&ar[ar.length-1]<this.all){
            ar.shift();
            ar.push(ar[ar.length-1]+1);
        }
        if(e==-1&&this.all>15&&(ar[0])>1){
            ar.pop();
            ar.unshift(ar[0]-1);
        }
        // console.log('现在在'+this.cur+'页');
        get_lis.getprolis();
    },
    page_jump:function(e){
        var that2 = this;
        that2.now = e;
        st = Number(e)-7;
        end = Number(e)+7;
        that2.page_array=[];
        for(i=st;i<=end;i++){
            if(i>=1&&i<=that2.all)
                that2.page_array.push(i);
        }

    },
    getpageNum:function(){
            var that_prolis = this;
            axios.post('search_server.php',that_prolis.query_type).then(function (response) {
            sonlis = response['data'];
            that_prolis.all = sonlis;
            that_prolis.page_init();
        }).catch(function (error) {
        　　alert(error);
        });
    },
    indexs: function(){
        var that = this;
        var mid = that.all/2;
        var ar = that.page_array;
        if(that.all<5){
            for(i =1;i<=that.all;i++){
                ar.push(i);
            }
        }
        else if(that.all<=15){
            for(i =1;i<=Math.min(that.all,15);i++){
                ar.push(i);
            }
        }
        else{
            for(i =1;i<=15;i++){
                ar.push(i);
            }
        }
        return ar;
       }
    },
})



var get_lis = new Vue({
    el:"#pro_main",
    mounted(){
        this.getprolis()
    },
    data:{
        prolis:[{
            id:1,
            title:1,
            per:1,
            level:1,
            resource:'',

        }],
        query_type:{
            ask:"body",
            word:storage['search_word'],
            page:0,
        },
    },
    methods:{
        link:function(index_num,index_title){
            storage["pro_id"]=index_num;
            storage["pro_title"]=index_title;
        },
        getprolis:function(){
            var that_prolis = this;
            that_prolis.prolis=[];
            that_prolis.query_type['page'] = pageBar.now-1;
            // console.log(that_prolis.query_type);
            axios.post('search_server.php',that_prolis.query_type).then(function (response) {
                sonlis = response['data'];
                // console.log(sonlis);
                that_prolis.templis =  sonlis.split('{{}}');
                for(i=0;i<that_prolis.templis.length-1;i++){
                    var k = that_prolis.templis[i].split('{,}');
                    var div_str = "<div class=\"level"+k[3]+"\"></div>";
                    that_prolis.prolis.push({
                        id:k[0],
                        title:k[1],
                        per:k[2],
                        level:div_str,
                        resource:k[4]
                    })
                }
        }).catch(function (error) {
        　　alert(error);
        });
    }
    }
})

var jump_vue = new Vue({
    el:'.jump_con',
    data:{
        page_index:'1',
    },
    methods:{
        jump:function(){
            var that_j=this;
            if(that_j.page_index<=pageBar.all&&that_j.page_index>=1){
                // pageBar.now=that_j.page_index;
                get_lis.getprolis();
                pageBar.page_jump(that_j.page_index);
            }
            else{
                alert("页码超出范围！")
            }
        },
    }
})