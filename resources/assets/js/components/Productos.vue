
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
                <i class="fa fa fa-book"></i> Productos
                <button type="button" class="btn btn-primary" data-toggle="modal" @click="abrirModal('guardar')">
                    <i class="icon-plus"></i>&nbsp;Agregar 
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-2" id="opcion" name="opcion" v-model="criterio">
                              <option value="nombre">Nombre</option>
                            </select>
                            <input v-model="buscar" type="text" id="texto" name="texto" class="form-control" placeholder="productos a buscar" @keypress="listProducto(1, criterio, buscar)">
                            <button type="button" @click="listProducto(1, criterio, buscar)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Codigo</th>                                   
                            <th>Nombre</th>                                   
                            <th>Cantidad</th>                                   
                            <th>Precio</th>                                   
                            <th>Precio Venta</th> 
                            <th>Insumo</th>                                                               
                            <th>Tipo Producto</th>                                                                    
                            <th>Opciones</th>                               
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="objeto in arrayDatos" :key="objeto.id">
                            <td v-text="objeto.codigo"></td>
                            <td v-text="objeto.nombre"></td>
                            <td v-text="objeto.cant"></td>
                            <td v-text="objeto.precio"></td>
                            <td v-text="objeto.prec_venta"></td>
                            <td>
                                <template v-if="objeto.is_insumo==0">
                                    <span class="badge badge-success">Producto</span>
                                </template>
                                <template v-else>
                                    <span class="badge badge-dark">Insumo</span>
                                </template>
                            </td>
                            <td v-text="objeto.nomTpro"></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar', objeto)">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="eliminarProducto(objeto)">
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
                    @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)"
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
                    @click.prevent="cambiarPagina(page,buscar,criterio)"
                    v-text="page"
                    ></a>
                 </li>
                 <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)"
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

                            <label class="col-md-2 form-control-label" for="text-input">Código</label>
                            <div class="col-md-4">
                                <input type="text" v-model="codigo" id="codigo" name="codigo" class="form-control" placeholder="codigo productos">
                                <span class="help-block"> <br></span>
                            </div>
                           
                             <label class="col-md-2 form-control-label" for="text-input">Nombre</label>
                                 <div class="col-md-4">
                                 <input type="text" v-model="nombre" id="nombre" name="nombre" class="form-control" placeholder="Nombre productos">
                                 <span class="help-block"><br> </span>
                               </div> 

                            <label class="col-md-2 form-control-label" for="text-input">Cantidad</label>
                            <div class="col-md-4">
                                <input type="number" v-model="cant" id="cant" name="cant" class="form-control" placeholder="Cantidad producto">
                                <span class="help-block"> <br></span>
                            </div>

                            
                            <label class="col-md-2 form-control-label" for="text-input">Precio</label>
                            <div class="col-md-4">
                                <input type="text" v-model="precio" id="precio" name="precio" class="form-control" placeholder="Precio">
                                <span class="help-block"><br> </span>
                            </div>

                            

                            <label class="col-md-2 form-control-label" for="text-input">Precio Venta</label>
                            <div class="col-md-4">
                                <input type="text" v-model="prec_venta" id="prec_venta" name="prec_venta" class="form-control" placeholder="Precio venta">
                                <span class="help-block"><br> </span>
                            </div>
                    

                            <label class="col-md-2 form-control-label" for="text-input">Insumo</label>
                            <div class="col-md-4">
                                <input type="text" v-model="is_insumo" id="is_insumo" name="is_insumo" class="form-control" placeholder="Insumo">
                                <span class="help-block"><br> </span>
                            </div>
                        </div>
                            <div class="form-group row">
                           
                                <label class="col-md-2 ">Tipo Producto</label>
                                <div class="col-md-4">    
                                  <select v-model="idTi_pro" class="form-control" >
                                        <option v-for="objeto in arrayTipo_prod" :value="objeto.id" :key="objeto.id" v-text="objeto.nombre"></option> 
                                  </select><br>
                                </div>

                            </div>
                                                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal" data-dismiss="modal">Cerrar</button>
                    <button v-show="accion==0" type="button" @click="regProducto" class="btn btn-primary">Guardar</button>
                    <button v-show="accion" type="button" @click="actProducto" class="btn btn-primary">Actualizar</button>
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
                    <h4 class="modal-title">Eliminar  Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar  Producto?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cerrar</button>
                    <button type="button" @click="eliminarProducto" class="btn btn-danger">Eliminar</button>
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
                arrayTipo_prod:[],
                codigo:"",
                nombre:"",
                cant:"",
                precio:"",
                prec_venta:"",
                is_insumo:"",
                idPro:"",
                idTi_pro:0,
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
                criterio:"nombre"

            }
        },

        methods: {
            cambiarPagina(page,buscar,criterio){
                let me=this;
                //va a la pagina actual
                me.pagination.current_page= page;
                //envia al metodo para traer los datos
                me.listProducto(page,criterio,buscar);
            },

            listProducto:function(page,criterio,buscar){
                let me = this;
                var url="/productos?page="+ page+ "&criterio="+criterio+ "&buscar="+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.productos.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            getTipo_productos(){
                let me = this;
                var url= "/gettipo_productos";
                axios.get(url).then(function(response){
                 var respuesta =response.data;
                 me.arrayTipo_prod=respuesta.tipo_productos; 
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            
            regProducto(){  
                let me = this;
                var url="/productos/registrar";
                axios.post(url,{
                    codigo:this.codigo,
                    nombre:this.nombre,
                    cant:this.cant,
                    precio:this.precio,
                    prec_venta:this.prec_venta,
                    is_insumo:this.is_insumo,
                    idTi_pro:this.idTi_pro
                })
                .then(function(response){
                    me.listProducto(1, me.criterio, me.buscar);
                    me.mensaje('Se guardo correctamente');
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
                
            },
            actProducto(){
	                let me = this;
	                var url="/productos/actualizar";
                    axios.put(url,{
		            id:this.idPro,
                    codigo:this.codigo,
                    nombre :this.nombre,
                    cant:this.cant,
                    precio:this.precio,
                    prec_venta:this.prec_venta,
                    is_insumo:this.is_insumo,
                   idTi_pro:this.idTi_pro,
                })
                .then(function(response){
                    me.listProducto(1, me.criterio, me.buscar);
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
                this.titulo='Registrar Producto';
                this.accion=0;
                this.limpiar();
             break;
                case 'editar':
                this.titulo='Editar Producto';
                this.accion=1;
                this.idPro=data["id"];
                this.codigo=data["codigo"];
                this.nombre=data["nombre"];
                this.cant=data["cant"];
                this.precio=data["precio"];
                this.prec_venta=data["prec_venta"];
                this.is_insumo=data["is_insumo"];
                this.idTi_pro=data["nomTpro"];
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
            this.codigo='';
            this.nombre='';
            this.cant='';
            this.precio='';
            this.prec_venta='';
            this.is_insumo='',
            this.idTi_pro=''
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
           eliminarProducto(data=[]){
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
           var url = "/productos/eliminar";
            axios.post(url, {
                id: data["id"],
                })
                .then(function (response) {
                me.listProducto(1, me.criterio, me.buscar);
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
                    this.listProducto(1,this.criterio,this.buscar);
                    this.getTipo_productos();
                    
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
