<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('sitio.login');
});
Route::get('login', function () {
    return view('sitio.login');
})->name('login');

Route::get('index', 'UsuarioController@index')->name('index');
Route::get('menu/{token}', 'AppController@menu')->name('menu');

Route::post('usuario/auth', 'UsuarioController@auth')->name('usuario/auth');
Route::get('usuario/logout', 'UsuarioController@logout')->name('logout');
Route::any('usuario/administrar', 'UsuarioController@administrar')->name('usuario/administrar');
Route::any('usuario/crear', 'UsuarioController@guardar')->name('usuario/crear');
Route::any('usuario/editar/{id_usuario}', 'UsuarioController@guardar')->name('usuario/editar');

Route::any('tercero/administrar', 'TerceroController@administrar')->name('tercero/administrar');
Route::any('tercero/crear', 'TerceroController@crear')->name('tercero/crear');
Route::any('tercero/editar/{id_tercero}', 'TerceroController@crear')->name('tercero/editar');
Route::any('tercero/view/{id_tercero}', 'TerceroController@view')->name('tercero/view');
Route::any('tercero/buscar/{caracteres}', 'TerceroController@buscar')->name('tercero/buscar');

Route::any('factura/crear', 'FacturaController@crear')->name('factura/crear');
Route::post('factura/anular', 'FacturaController@anular')->name('factura/anular');
Route::any('cotizacion/crear', 'FacturaController@crear')->name('factura/crear');
Route::any('factura/finalizar_factura', 'FacturaController@finalizar_factura')->name('factura/finalizar_factura');
Route::any('factura/imprimir/{id_factura}', 'FacturaController@imprimir')->name('factura/imprimir');
Route::any('ticket/imprimir/comanda/{id_factura}', 'FacturaController@imprimir_ticket_comanda')->name('ticket/imprimir/comanda');
Route::any('ticket/imprimir/factura/{id_factura}', 'FacturaController@imprimir_ticket_factura')->name('ticket/imprimir/factura');

Route::any('factura/facturador', 'FacturaController@facturador')->name('factura/facturador');
Route::post('factura/finalizar_factura_facturador', 'FacturaController@finalizar_factura_facturador')->name('factura/finalizar_factura_facturador');
Route::post('factura/pagar_credito', 'FacturaController@pagar_credito')->name('factura/pagar_credito');

Route::any('canales_servicio', 'FacturaController@canales_servicio')->name('canales_servicio');
Route::any('pedidos_pendientes', 'FacturaController@pedidos_pendientes')->name('pedidos_pendientes');

Route::any('producto/buscar/{id_producto}', 'ProductoController@buscar')->name('producto/buscar');
Route::any('producto/administrar', 'ProductoController@administrar')->name('producto/administrar');
Route::any('producto/crear', 'ProductoController@guardar')->name('producto/crear');
Route::any('producto/editar/{id_producto}', 'ProductoController@guardar')->name('producto/editar');
Route::any('producto/view/{id_producto}', 'ProductoController@view')->name('producto/view');

Route::any('categoria/administrar', 'CategoriaController@administrar')->name('categoria/administrar');
Route::any('categoria/crear', 'CategoriaController@guardar')->name('categoria/crear');
Route::any('categoria/editar/{id_producto}', 'CategoriaController@guardar')->name('categoria/editar');

Route::any('mesa/administrar', 'MesaController@administrar')->name('mesa/administrar');
Route::any('mesa/crear', 'MesaController@guardar')->name('mesa/crear');
Route::any('mesa/editar/{id_mesa}', 'MesaController@guardar')->name('mesa/editar');

Route::any('inventario/movimientos', 'InventarioController@administrar')->name('inventario/movimientos');
Route::any('inventario/crear', 'InventarioController@guardar')->name('inventario/crear');
Route::any('inventario/vista/{id_inventario}', 'InventarioController@vista')->name('inventario/vista');
Route::any('inventario/stock_actual', 'InventarioController@stock_actual')->name('inventario/stock_actual');

Route::any('caja/apertura', 'CajaController@apertura')->name('caja/apertura');
Route::any('caja/view/{id_caja}', 'CajaController@view')->name('caja/view');
Route::any('caja/cerrar/{id_caja}', 'CajaController@cerrar_caja')->name('caja/cerrar');
Route::any('caja/documento/nuevo', 'CajaController@nuevo_documento')->name('caja/documento/nuevo');

Route::any('reportes/facturas', 'ReporteController@facturas')->name('reportes/buscar');
Route::any('reportes/auditoria_interna', 'ReporteController@auditoria_interna')->name('reportes/auditoria_interna');
Route::any('reportes/caja', 'ReporteController@cajas')->name('reportes/caja');
Route::any('reportes/facturas_pendientes_pagar', 'ReporteController@facturas_pendientes_pagar')->name('reportes/facturas_pendientes_pagar');
Route::get('factura_email', function () {
    return view('email.factura');
})->name('factura_email');

Route::get('factura_pdf', function () {
    return view('pdf.factura');
})->name('factura_pdf');

Route::any('licencia/menu_clientes', 'LicenciaController@menu_clientes')->name('licencia/menu_clientes');
Route::any('licencia/validar_pedidos_nuevos', 'LicenciaController@validar_pedidos_nuevos')->name('licencia/validar_pedidos_nuevos');
