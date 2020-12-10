<template>
    <main class="main" >
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li> 
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>            
    <div class="container-fluid">
        <!-- {{-- <example-component></example-component>
        <categoria></categoria> --}} -->
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa fa-book"></i> Proveedores Productos
                <button type="button" class="btn btn-primary" data-toggle="modal" @click="abrirModal('guardar')">
                    <i class="icon-plus"></i>&nbsp;Nuevo 
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-2" id="opcion" name="opcion" >
                              <option value="id">Id</option>
                            </select>
                            <input v-model="buscar" type="text" id="texto" name="texto" class="form-control" placeholder="proveedor producto a buscar" @keypress="listProv_pd( buscar)">
                            <button type="button" @click="listProv_pd( buscar)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>                  
                            <th>Proveedores</th>                                   
                            <th>Productos</th>                                                                    
                            <th>Opciones</th>                               
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="objeto in arrayDatos" :key="objeto.id">
                            <td v-text="objeto.nomProv"></td>
                            <td v-text="objeto.nomProd"></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar', objeto)">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="eliminarProv_pd(objeto)">
                                  <i class="icon-trash"></i>
                                </button>
                            </td>                                                                        
                        </tr>                                                                                                                                
                    </tbody>
                </table>
                
            <nav>
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,)"
                    >Ant</a>
                    </li>
                    <li
                    class="page-item"
                    v-for="page in pagesNumber" 
                    :key="page"
                    :class="[page == isActived ? 'active' : '']"
                    >
                    <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(page,buscar,)"
                    v-text="page"
                    ></a>
                 </li>
                 <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,
                    )"
                    >Sig</a>
                        </li>
                    </ul>
            </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" :class="{'mostrar':modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="titulo"></h4>
                    <button type="button" class="close" @click="cerrarModal" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                    
                                <label class=" col-md-2 ">Proveedores</label>   
                                   <div class="col-md-4 ">  
                                     <select v-model="idProv" class="form-control   " >
                                     <option v-for="objeto in arrayProveedores" :value="objeto.id" :key="objeto.id" v-text="objeto.nombre"></option> 
                                     </select><br>
                                    </div>


                                <label class=" col-md-2 ">Productos</label> 
                                 <div class="col-md-4 ">     
                                <select v-model="idPro" class="form-control " >
                                    <option v-for="objeto in arrayProductos" :value="objeto.id" :key="objeto.id" v-text="objeto.nombre"></option> 
                                </select><br>
                                </div>
                            </div>
                                                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal" data-dismiss="modal">Cerrar</button>
                    <button v-show="accion==0" type="button" @click="regProv_pd" class="btn btn-primary">Guardar</button>
                    <button v-show="accion" type="button" @click="actProv_pd" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    <!-- Inicio del modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Proveedor Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar el proveedor producto?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cerrar</button>
                    <button type="button" @click="eliminarProv_pd" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Fin del modal Eliminar -->
</main>
</template>

<script>
    export default {
        data(){
            return{
                arrayDatos:[],
                arrayProveedores:[],
                arrayProductos:[],
                idProv_pd:0,
                idProv:0,
                idPro:0,
                modal:0,
                titulo:"",
                accion:0,
                

               //variables de pagination
                pagination:{
                    total:0,
                    current_page:0,
                    per_page:0,
                    last_page:0,
                    from:0,
                    to:0
                },
                offset:2,
                buscar:"",
               

            }
        },

        methods: {
            cambiarPagina(page,buscar){
                let me=this;
                //va a la pagina actual
                me.pagination.current_page= page;
                //envia al metodo para traer los datos
                me.listProv_pd(page,buscar);
            },

            listProv_pd:function(page,buscar){
                let me = this;
                var url="/prov_productos?page="+ page+"&buscar="+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.prov_productos.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
           
            getProveedores(){
                let me = this;
                var url= "/getproveedores";
                axios.get(url).then(function(response){
                 var respuesta =response.data;
                 me.arrayProveedores=respuesta.proveedores; 
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            getProductos(){
                let me = this;
                var url= "/getproductos";
                axios.get(url).then(function(response){
                 var respuesta =response.data;
                 me.arrayProductos=respuesta.productos; 
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            
            
            regProv_pd(){  
                let me = this;
                var url="/prov_productos/registrar";
                axios.post(url,{
                    idProv:this.idProv,
                    idPro:this.idPro,
                })
                .then(function(response){
                    me.listProv_pd( me.buscar);
                    me.mensaje('Se guardo correctamente');
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
                
            },
            actProv_pd(){
	                let me = this;
	                var url="/prov_productos/actualizar";
                    axios.put(url,{
		            id:this.idProv_pd,
                    idProv:this.idProv,
                    idPro:this.idPro,
                })
                .then(function(response){
                    me.listProv_pd( me.buscar);
                    me.mensaje('Se actualizo correctamente');
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
             },
            abrirModal(accion,data=[]){
                switch(accion){
                case'guardar':
                this.titulo='Registrar Proveedor Producto';
                this.accion=0;
                this.limpiar();
             break; 
                case 'editar':
                this.titulo='Editar Proveedor producto';
                this.accion=1;
                this.idProv_pd=data["id"];
                this.idProv=data["nomProv"];
                this.idPro=data["nomProd"];
             break;
                default:
                break;
            }
            this.modal=1;
          },
           cerrarModal(){
            this.modal=0;
          },
           limpiar(){
            this.nombre='';
          },
            mensaje(msj){
            Swal.fire({
             position: 'center',
             icon: 'success',
             title: msj,
             showConfirmButton: false,
             timer: 2000
            })
          },
           eliminarProv_pd(data=[]){
                         let me = this;
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Se eliminaran los datos",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar!',
                    confirmButtonText: 'Confirmar!'
             }).then((result) => {
                if (result.isConfirmed) {
           var url = "/prov_productos/eliminar";
            axios.post(url, {
                id: data["id"],
                })
                .then(function (response) {
                me.listProv_pd(me.buscar);
                })
                .catch(function (error) {
                console.log(error);
                });

                Swal.fire(
               'Borrado!',
                'Se elimino correctamente.',
                'success'
                    )
                 }
                })

            },
           
        }, 
            computed:{
            isActived: function() {
            return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
            }

        },
                
         mounted() {
         console.log('Component mounted.')
                    this.listProv_pd(this.buscar);
                    this.getProveedores();
                    this.getProductos();
         }
  }
</script>

<style>

.modal-content{
width: 100% !important;
position: absolute  !important;;

}

.mostrar{
 display:list-item !important;
 opacity: 1 !important;
 position: absolute !important;
 background-color:#9995957a; 
}
</style>

