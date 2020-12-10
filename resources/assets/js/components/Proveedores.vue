<template>
<main class="main" >
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol> 
    <div class="container-fluid">        
        <div class="card">
            <div class="card-header">
                <i class="fa fa fa-user"></i> Proveedores
                <button type="button" class="btn btn-primary" data-toggle="modal" @click="abrirModal ('guardar')">
                    <i class="icon-plus"></i>&nbsp;Agregar
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion" v-model="criterio">
                              <option value="nombre">Nombre</option>
                            </select>
                            <input v-model="buscar" type="text" id="texto" name="texto"  class="form-control" placeholder="Texto a buscar" @keypress="listProveedores(1, criterio, buscar)">
                            <button type="button" @click="listProveedores(1, criterio, buscar)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
 
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>                                                                     
                            <th>Dirección</th>                                                                     
                            <th>Telefono</th>                                                                     
                            <th>Nombre Empresa</th>                                                                     
                            <th>Email</th>                                                                     
                            <th>Persona Contacto</th>                                                                     
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr v-for="objeto in arrayDatos" :key="objeto.id">
                            <td v-text="objeto.nombre"></td>
                            <td v-text="objeto.dir"></td>
                            <td v-text="objeto.tel"></td>
                            <td v-text="objeto.nom_empresa"></td>
                            <td v-text="objeto.email"></td>
                            <td v-text="objeto.perso_contac"></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar',objeto)">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="eliminarProveedores(objeto)">
                                  <i class="icon-trash"></i>
                                </button>
                            </td>                                                                        
                        </tr>                                                                                                                                
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)" >Ant</a>
                        </li>
                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                        </li>
                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link"  href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                        </li>
                    </ul>
                </nav>                
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" :class="{'mostrar': modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre">
                            </div>
                        </div>
                        <div class="form-group row">    
                            <label class="col-md-2 form-control-label" for="text-input">Dirección</label>
                            <div class="col-md-9">
                                <input type="text" v-model="dir" id="dir" name="dir" class="form-control" placeholder="Ingrese la dirección">
                            </div>
                        </div>
                        <div class="form-group row">    
                            <label class="col-md-2 form-control-label" for="text-input">Telefono</label>
                            <div class="col-md-9">
                                <input type="text" v-model="tel" id="tel" name="tel" class="form-control" placeholder="Ingrese el telefono">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-label" for="text-input">Nombre Empresa</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nom_empresa" id="nom_empresa" name="nom_empresa" class="form-control" placeholder="Nombre Empresa">
                            </div>
                        </div>
                        <div class="form-group row">    
                            <label class="col-md-2 form-control-label" for="text-input">Email</label>
                            <div class="col-md-9">
                                <input type="text" v-model="email" id="email" name="email" class="form-control" placeholder="Ingrese el email">
                            </div>
                        </div>                               
                        <div class="form-group row">    
                            <label class="col-md-2 form-control-label" for="text-input">Persona Contacto</label>
                            <div class="col-md-9">
                                <input type="text" v-model="perso_contac" id="perso_contac" name="perso_contac" class="form-control" placeholder="Persona de Contacto">
                            </div>
                        </div>                               
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="cerrarModal" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button v-show="accion==0" type="button" @click="regProveedores" class="btn btn-primary">Guardar</button>
                    <button v-show="accion" type="button" @click="actProveedores" class="btn btn-primary">Actualizar</button>
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
                    <h4 class="modal-title">Eliminar Proveedores</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar este Proveedor?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" @click="eliminarProveedores" class="btn btn-danger">Eliminar</button>
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
                nombre:'',
                nom_empresa:'',
                dir:'',
                tel:'',
                email:'',
                perso_contac:'',
                idProv:0,                
                modal:0,
                accion:0,
                titulo:'',
                // variables paguinacion
                pagination:{
                    total:0,
                    current_page:0,
                    per_page:0,
                    last_page:0,
                    from:0,
                    to:0,
                },
                offset:3,
                buscar:'',
                criterio:'nombre',
            }
        },

        methods: {

            cambiarPagina(page,buscar,criterio){
                let  me = this;
                //va a la pag actual
                me.pagination.current_page= page;
                //envia el metodo para traer los datos
                me.listProveedores(page,criterio,buscar);
            },

            listProveedores:function(page,criterio,buscar){
                let me = this;
                var url="/proveedores?page="+ page + '&criterio='+criterio +'&buscar='+ buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.proveedores.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                })
            },
            regProveedores(){
                let me = this;
                var url="/proveedores/registrar";
                axios.post(url,{
                    nombre: this.nombre,
                    dir: this.dir,
                    tel: this.tel,
                    nom_empresa: this.nom_empresa,
                    email: this.email,
                    perso_contac: this.perso_contac,
                })
                .then(function(response){
                    me.listProveedores(1, me.criterio, me.buscar);
                    me.mensaje('Se guardo correctamente');
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            actProveedores(){
                let me = this;
                var url="/proveedores/actualizar";
                axios.put(url,{
                    id:this.idProv,
                    nombre: this.nombre,
                    dir: this.dir,
                    tel: this.tel,
                    nom_empresa: this.nom_empresa,
                    email: this.email,
                    perso_contac: this.perso_contac,
                })
                .then(function(response){
                    me.listProveedores(1, me.criterio, me.buscar);
                    me.mensaje('Se actualizo correctamente');
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
            },
             
            eliminarProveedores(data=[]){
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
                        var url="/proveedores/eliminar";
                            axios.post(url,{
                            id:data["id"],
                        })
                        .then(function(response){
                            me.listProveedores(1, me.criterio, me.buscar);
                        })
                            .catch(function(error){
                            console.log(error);
                        }); 
                        Swal.fire(
                                'Eliminado!',
                                'Se elimino correctamente.',
                                'success'
                                 )                       
                    }
                })                 
            },
            abrirModal(accion,data=[]){

                switch (accion) {
                    case 'guardar':
                        this.titulo='Registrar Proveedores'
                        this.accion=0;
                        this.limpiar();
                        break;
                    case 'editar':
                        this.titulo='Editar Proveedores'
                        this.accion=1;
                        this.idProv = data ['id'];
                        this.nombre=data['nombre'];
                        this.dir=data['dir'];
                        this.tel=data['tel'];
                        this.nom_empresa=data['nom_empresa'];
                        this.email=data['email'];
                        this.perso_contac=data['perso_contac'];
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
                this.dir='';
                this.tel='';
                this.nom_empresa='';
                this.email='';
                this.perso_contac='';
            },
            mensaje(msj){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: msj,
                    showConfirmButton: false,
                    timer: 1500
                })
            },
        },
        computed: {
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
            this.listProveedores(1,this.criterio,this.buscar);
        }
    }
</script>

<style>

.modal-content{
    width: 100% !important;
    position: absolute;
}

.mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
}

</style>