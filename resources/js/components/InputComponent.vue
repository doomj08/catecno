<template>
    <div class="componente" >
        <div class="form">
            <li>{{label}}</li>
            <select class="campo col-10" v-if="type=='Select'" :value="value" :type="type" v-model="value"
                   v-on:input="$emit('input', $event.target.value)"

            >

                <option>...</option>
                <option v-for="(item,key) in lista" :value="item">{{key}}</option>
            </select>

            <input class="campo" v-else :value="value" :type="type"
                    v-on:input="$emit('input', $event.target.value)"
            >
            <button v-if="type=='Select'" class="col-1 btn-sm btn-info" @click="consultar">
                <i class="fa fa fa-spinner"></i>
            </button>
            <slot></slot>
        </div>
    </div>
</template>

<style scoped>
    .componente{
        padding: 2px 0px 2px 2px;
    }
    .form{
        border: 1px solid gray;
        margin: 3px 10px 3px 10px;
        padding: 10px 10px 10px 10px;
        background: transparent;
    }

    .form li{
        list-style: none;
        color: rgba(29, 104, 167, 0.81);
        font-weight: bold;
        text-transform: uppercase;
        font-size: 11px;
    }
    .campo{
        width: 100%;
        height: 25px;
        color: #363b40;
        font-size: 14px;
        border-style: solid;
        border-color:  rgba(29, 104, 167, 0.81);
        background: transparent;

    }
    input{
        border-top: 0px;
        border-left: 0px;
        border-right: 0px;
    }
    select{
        border-top: 0px;
        border-left: 0px;
        border-right: 0px;
        border-bottom: 2px;
    }
    .span{
        display: block;
    }

</style>

<script>
    export default{
        props:{
            label:'',
            value:'',
            type:{
                type:String,
                default:''
            },
            lista:{
                type:String,
                default:''
            },
            errores:{
                type:'',
                default:''
            },
            url:{
                type:String,
                default:''
            },


        },
        data(){
            return {


            }
        },
        methods:{
            changevalue() {
                this.$emit('updatemodel', this.value)  // 1. Emitting
            },
            consultar(){
                axios.get('lista/'+this.url)
                    .then((res)=>{
                        this.lista=res.data
                        this.cargando=false;
                        toast.fire({
                            title: 'Lista actualizada',
                            text: "Lista de opciones actualizada",
                            type:'success'
                        })
                    })
                    .catch(e => {
                        this.errores=e.response.data.errors;
                    });
            },
        },
    }
</script>