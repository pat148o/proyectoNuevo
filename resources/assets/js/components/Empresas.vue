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
                <i class="fa fa fa-book"></i> Empresa
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
                            <input v-model="buscar" type="text" id="texto" name="texto" class="form-control" placeholder="Empresa a buscar" @keypress="listEmpresa(1, criterio, buscar)">
                            <button type="button" @click="listEmpresa(1, criterio, buscar)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>                                   
                            <th>Propietario</th>                                                               
                            <th>Nit</th>                                   
                            <th>Regimen</th>                                   
                            <th>Direccion</th>                                   
                            <th>Teléfono</th>                                                                                                       
                            <th>Opciones</th>                               
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="objeto in arrayDatos" :key="objeto.id">
                            <td v-text="objeto.nombre"></td>
                            <td v-text="objeto.propietario"></td>
                            <td v-text="objeto.nit"></td>
                            <td v-text="objeto.regimen"></td>
                            <td v-text="objeto.dir"></td>
                            <td v-text="objeto.tel"></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar', objeto)">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="eliminarEmpresa(objeto)">
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
                           
                             <label class="col-md-2 form-control-label" for="text-input">Nombre</label>
                                 <div class="col-md-4">
                                 <input type="text" v-model="nombre" id="nombre" name="nombre" class="form-control" placeholder="Nombre ">
                                 <span class="help-block"><br> </span>
                               </div> 
                            

                            <label class="col-md-2 form-control-label" for="text-input">Propietario</label>
                            <div class="col-md-4">
                                <input type="text" v-model="propietario" id="propietario" name="propietario" class="form-control" placeholder="propietario ">
                                <span class="help-block"> <br></span>
                            </div>

                            

                            <label class="col-md-2 form-control-label" for="text-input">Nit</label>
                            <div class="col-md-4">
                                <input type="text" v-model="nit" id="nit" name="nit" class="form-control" placeholder="nit">
                                <span class="help-block"> <br></span>
                            </div>

                            
                            <label class="col-md-2 form-control-label" for="text-input">Regimen</label>
                            <div class="col-md-4">
                                <input type="text" v-model="regimen" id="regimen" name="regimen" class="form-control" placeholder="regimen">
                                <span class="help-block"><br> </span>
                            </div>

                            

                            <label class="col-md-2 form-control-label" for="text-input">dirección</label>
                            <div class="col-md-4">
                                <input type="text" v-model="dir" id="dir" name="dir" class="form-control" placeholder="direccion">
                                <span class="help-block"><br> </span>
                            </div> 

                            

                            <label class="col-md-2 form-control-label" for="text-input">Teléfono</label>
                            <div class="col-md-4">
                                <input type="text" v-model="tel" id="tel" name="tel" class="form-control" placeholder="telefono">
                                <span class="help-block"> <br></span>
                            </div> 

                        </div>                              
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal" data-dismiss="modal">Cerrar</button>
                    <button v-show="accion==0" type="button" @click="regEmpresa" class="btn btn-primary">Guardar</button>
                    <button v-show="accion" type="button" @click="actEmpresa" class="btn btn-primary">Actualizar</button>
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
                    <h4 class="modal-title">Eliminar Empresa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar la empresa?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cerrar</button>
                    <button type="button" @click="eliminarEmpresa" class="btn btn-danger">Eliminar</button>
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
                nombre:"",
                propietario:"",
                nit:"",
                regimen:"",
                dir:"",
                tel:"",
                idEmp:0,
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
                me.listEmpresa(page,criterio,buscar);
            },

            listEmpresa:function(page,criterio,buscar){
                let me = this;
                var url="/empresas?page="+ page+ "&criterio="+criterio+ "&buscar="+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.empresas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
           
            regEmpresa(){  
                let me = this;
                var url="/empresas/registrar";
                axios.post(url,{
                    nombre:this.nombre,
                    propietario:this.propietario,
                    nit:this.nit,
                    regimen:this.regimen,
                    dir:this.dir,
                    tel:this.tel,       
                })
                .then(function(response){
                    me.listEmpresa(1, me.criterio, me.buscar);
                    me.mensaje('Se guardo correctamente');
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
                
            },
            actEmpresa(){
	                let me = this;
	                var url="/empresas/actualizar";
                    axios.put(url,{
		            id:this.idEmp,
                    nombre :this.nombre,
                    propietario:this.propietario,
                    nit:this.nit,
                    regimen:this.regimen,
                    dir:this.dir,
                    tel:this.tel,
                    
                })
                .then(function(response){
                    me.listEmpresa(1, me.criterio, me.buscar);
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
                this.titulo='Registrar Empresa';
                this.accion=0;
                this.limpiar();
             break;
                case 'editar':
                this.titulo='Editar Empresa';
                this.accion=1;
                this.idEmp=data["id"];
                this.nombre=data["nombre"];
                this.propietario=data["propietario"];
                this.nit=data["nit"];
                this.regimen=data["regimen"];
                this.dir=data["dir"];
                this.tel=data["tel"];
            
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
            this.propietario='';
            this.nit='';
            this.regiment='';
            this.dir='';
            this.tel='';
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
           eliminarEmpresa(data=[]){
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
           var url = "/empresas/eliminar";
            axios.post(url, {
                id: data["id"],
                })
                .then(function (response) {
                me.listEmpresa(1, me.criterio, me.buscar);
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
                    this.listEmpresa(1,this.criterio,this.buscar);
                    
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

