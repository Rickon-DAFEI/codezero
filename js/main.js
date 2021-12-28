var storage=window.localStorage;
var root = new Vue({
    el:".big-item-nav",
    mounted(){
        this.getroot()
        storage['flag'] = 0;
    },
    data:{
        json:{
            page_index:'main',
        },
        se:storage['back_root_index'],
        rootlist:[],
        types:[]
    },
    methods:{
        select:function(index){
            var k = this;
            k.se = index;
            sontype = index;
            son.query_data.son_index = index;
            prolis.query_type.root_typename = index
            son.sonse = 0;
            prolis.query_type.son_typename=0;
            storage['back_son_index'] = 0;
            storage['back_root_index'] = 0;
            son.getsonlis();
            prolis.getprolis();
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
            son_index:storage['back_root_index'],
        },
        sonse:storage['back_son_index'],
        sonlist:[],
        sontypes:[]
    },
    methods:{
        se:function(k){
            var temp2 = this;
            temp2.sonse=k;
            prolis.query_type.son_typename = k;
            prolis.getprolis();
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
});
var prolis = new Vue({
    el:".table-box",
    mounted(){
        this.getprolis()
    },
    data:{
        pro_page:1,
        templis:[],
        query_type:{
            page_index:'prolis',
            root_typename:storage['back_root_index'],
            son_typename:storage['back_son_index']
        },
        prolis:[{
            id:1,
            title:1,
            per:1,
            level:1
        }],
    },
    methods:{
        link:function(index_num,index_title){
            storage["root_index"]=root.se;
            storage["son_index"]=son.sonse;
            storage["pro_id"]=index_num;
            storage["pro_title"]=index_title;
        },
        getprolis:function(){
            var that_prolis = this;
            that_prolis.prolis=[];
            if(that_prolis.query_type.son_typename==undefined){
                that_prolis.query_type.son_typename=0;
                that_prolis.query_type.root_typename=0;
            }
            axios.post('web.php',that_prolis.query_type).then(function (response) {
                sonlis = response['data'];
                // console.log(sonlis);
                that_prolis.templis =  sonlis.split('{{}}');
                for(i=0;i<that_prolis.templis.length-1;i++){
                    var k = that_prolis.templis[i].split('{,}');
                    var div_str = "<div class=\"level"+k[4]+"\"></div>";
                    that_prolis.prolis.push({
                        id:k[0],
                        title:k[1],
                        per:k[2]+'/'+k[3],
                        level:div_str
                    })
                }
        }).catch(function (error) {
        　　alert(error);
        });
    }
    }
})
