<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ::::::::::::::
// 1. creo las rutas
// Route::get('/', function () {
//     return view('principal');
// });



Route::get('/','Auth\LoginController@mostrarLogin');
Route::post('/login','Auth\LoginController@login')->name('login');

Route::get('/main', function () {
    return view('contenido/contenido');
})->name('main');



Route::get('cargos','cargosController@index');
Route::get('getcargo','cargosController@getCargo');
Route::post('/cargos/registrar','cargosController@store');
Route::put('/cargos/actualizar','cargosController@update');
Route::post('/cargos/eliminar','cargosController@destroy');

Route::get('clientes','clientesController@index');
Route::get('getclientes','clientesController@getClientes');
Route::post('/clientes/registrar','clientesController@store');
Route::put('/clientes/actualizar','clientesController@update');
Route::post('/clientes/eliminar','clientesController@destroy');

Route::get('empleados','empleadosController@index');
Route::get('getempleados ','empleadosController@get');
Route::post('/empleados /registrar','empleadosController@store');
Route::put('/ empleados/actualizar','empleadosController@update');
Route::post('/empleados /eliminar','empleadosController@destroy');


Route::get('empresas','empresasController@index');
Route::get('getempresas  ','empresasController@get');
Route::post('/ empresas/registrar','empresasController@store');
Route::put('/empresas /actualizar','empresasController@update');
Route::post('/ empresas/eliminar','empresasController@destroy');


Route::get('ent_produc  ','ent_productosController@index');
Route::get('getent_productos','ent_productosController@get');
Route::post('/ ent_productos/registrar','ent_productosController@store');
Route::put('/ent_productos /actualizar','ent_productosController@update');
Route::post('/ent_productos /eliminar','ent_productosController@destroy');


Route::get('facturas ','facturasController@index');
Route::get('getfacturas  ','facturasController@get');
Route::post('/ facturas/registrar','facturasController@store');
Route::put('/ facturas/actualizar','facturasController@update');
Route::post('/ facturas/eliminar','facturasController@destroy');


Route::get('mesas ','mesasController@index');
Route::get('get  ','mesasController@get');
Route::post('/mesas /registrar','mesasController@store');
Route::put('/ mesas/actualizar','mesasController@update');
Route::post('/ mesas/eliminar','mesasController@destroy');


Route::get('pedidos','pedidosController@index');
Route::get('get  ','pedidosController@get');
Route::post('/pedidos /registrar','pedidosController@store');
Route::put('/ pedidos/actualizar','pedidosController@update');
Route::post('/ pedidos/eliminar','pedidosController@destroy');


Route::get('productos','productosController@index');
Route::get('getproductos  ','productosController@get');
Route::post('/productos /registrar','productosController@store');
Route::put('/productos /actualizar','productosController@update');
Route::post('/productos /eliminar','productosController@destroy');


Route::get('prov_productos ','prov_productosController@index');
Route::get('getprov_productos  ','prov_productosController@get');
Route::post('/prov_productos /registrar','prov_productosController@store');
Route::put('/ prov_productos/actualizar','prov_productosController@update');
Route::post('/prov_productos /eliminar','prov_productosController@destroy');


Route::get('proveedores ','proveedoresController@index');
Route::get('getproveedores  ','proveedoresController@get');
Route::post('/ proveedores/registrar','proveedoresController@store');
Route::put('/proveedores /actualizar','proveedoresController@update');
Route::post('/proveedores /eliminar','proveedoresController@destroy');


Route::get('sali_productos','sali_productosController@index');
Route::get('getsali_productos  ','sali_productosController@get');
Route::post('/sali_productos /registrar','sali_productosController@store');
Route::put('/sali_productos /actualizar','sali_productosController@update');
Route::post('/sali_productos /eliminar','sali_productosController@destroy');


Route::get('tipo_productos ','tipo_productosController@index');
Route::get('gettipo_productos  ','tipo_productosController@get');
Route::post('/tipo_productos /registrar','tipo_productosController@store');
Route::put('/tipo_productos /actualizar','tipo_productosController@update');
Route::post('/tipo_productos /eliminar','tipo_productosController@destroy');


Route::get('users','usersController@index');
Route::get('getusers','UserController@getUsers');
Route::post('/users/registrar','usersController@store');
Route::put('/users/actualizar','UsersController@update');
Route::post('/users/eliminar','usersController@destroy');


Route::get('det_entradas','det_entradasController@index');
Route::get('getdet_entradas','det_entradasController@getDet_entradas');
Route::post('/det_entradas/registrar','det_entradasController@store');
Route::post('/det_entradas /eliminar','det_entradasController@destroy');


Route::get('det_facturas','det_facturasController@index');
Route::get('getdet_facturas','det_facturasController@getDet_facturas');
Route::post('/det_facturas/registrar','det_facturasController@store');
Route::post('/det_facturas/eliminar','det_facturasController@destroy');


Route::get('det_pedidos','det_pedidossController@index');
Route::get('getdet_pedidos','det_pedidosController@getDet_facturas');
Route::post('/det_pedidos/registrar','det_pedidosController@store');
Route::post('/det_pedidos/eliminar','det_pedidossController@destroy');



Route::get('det_salidas','det_salidasController@index');
Route::get('getdet_salidas','det_salidasController@getDet_salidas');
Route::post('/det_salidas/registrar','det_salidasController@store');
Route::post('/det_salidas/eliminar','det_salidasController@destroy');






