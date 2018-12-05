<div class="card" id="rule">
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">规则名称</label>
            <input type="text" v-model="rule.name" class="form-control" id="exampleInputEmail1" placeholder="">
        </div>
        <div class="card">
            <div class="card-body">
                {{--<div class="form-group" v-for="(v,k) in rule.keywords">--}}

                {{--<input type="text" v-model="v.key"  class="form-control" id="exampleInputEmail1" placeholder="">--}}
                {{--</div>--}}
                <label for="exampleInputEmail1">关键词</label>
                <div class="input-group mb-3" v-for="(v,k) in rule.keywords">
                    <input type="text" v-model="v.key" class="form-control" aria-label="Amount (to the nearest dollar)">
                    <div class="input-group-append">
                        <span class="input-group-text" style="cursor: pointer" @click="del(k)">删除</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-white" @click="add" type="button" >添加关键词</button>
    </div>
    <textarea  name="rule" id="" cols="30" rows="10">@{{ rule }}</textarea>
</div>
@push('js')
    <script>
        require(['vue'],function (Vue) {
            new Vue({
                el:'#rule',
                data:{
                    rule:{!! json_encode($ruleData) !!},
                    // rule: {
                    //     name: '',
                    //     keywords:[]
                    // },//空的
                },
                methods:{
                    add(){
                        this.rule.keywords.push({key:''})
                    },
                    del(k){
                        this.rule.keywords.splice(k,1)
                    },
                }
            })
        })
    </script>
@endpush

