<?php
$router->get('/', function () use ($router) {
    return $router->app->version();
});



//@get usuarios
$router->get('usuarios',  [ 'uses' => 'UsuarioController@get_usuarios']);
//@get usuarios
$router->get('usuarios/{id}',  [ 'uses' => 'UsuarioController@get_usuario_by_id']);
//@post usuarios
$router->post('crearusuarios',  [ 'uses' => 'UsuarioController@crear_usuario']);
//@put usuarios
$router->put('actualizarusuario',  [ 'uses' => 'UsuarioController@actualizar_usuario']);
//@put usuarios admin
$router->post('actualizarusuarioadmin', ['uses' => 'UsuarioController@actualizar_usuario_admin']);





//@get establecimientos
$router->get('establecimientos',  [ 'uses' => 'EstablecimientoController@get_establecimientos']);
//@get establecimiento_by_id
$router->get('establecimientos/{id}',  [ 'uses' => 'EstablecimientoController@get_establecimiento_by_id']);
//@put actualizar establecimiento
$router->put('establecimientos',  [ 'uses' => 'EstablecimientoController@actualizar_establecimiento']);

//@post crear establecimiento
$router->post('establecimientos',  [ 'uses' => 'EstablecimientoController@crear_establecimiento']);



//@get canchas
$router->get('canchas',  [ 'uses' => 'CanchasController@get_canchas']);
//@get canchas 
$router->get('canchas/{id}',  [ 'uses' => 'CanchasController@get_cancha_by_id']);
//@get canchas por id establecimiento
$router->get('canchasEstablecimiento/{establecimiento_id}', ['uses' => 'CanchasController@get_canchas_by_establecimiento']);


//@post actualizar canchas
$router->put('canchas',['uses' => 'CanchasController@actualizar_cancha']);
//@post canchas 
$router->post('canchas',  [ 'uses' => 'CanchasController@crear_cancha']);

$router->post('canchascercanas', ['uses' => 'CanchasController@get_canchas_location']);





//@get reservas
$router->get('reservas',  [ 'uses' => 'ReservasController@get_reservas']);
//@get reservas
$router->get('reservas/{id}',  [ 'uses' => 'ReservasController@get_reserva_by_id']);
//@get reservas activas por establecimiento
$router->get('reservasAEstablecimiento/{establecimiento_id}', ['uses' => 'ReservasController@get_reservas_activas_by_establecimiento']);
//@get reservas inactivas por establecimiento
$router->get('reservasINEstablecimiento/{establecimiento_id}', ['uses' => 'ReservasController@get_reservas_inactivas_by_establecimiento']);
//@get reservas activas
$router->get('reservasActivas', ['uses' => 'ReservasController@get_reservas_activas']);
//@get reservas inactivas
$router->get('reservasInactivas', ['uses' => 'ReservasController@get_reservas_inactivas']);
//@get canchas mas reservadas
$router->get('canchasMasReservadas', ['uses' => 'ReservasController@get_canchas_mas_reservadas']);
//@get usuarios mas frecuentes
$router->get('usuariosMasFrecuentes', ['uses' => 'ReservasController@get_usuarios_mas_frecuentes']);    
//@get usuarios mas frecuentes
$router->get('ReservasEstablecimiento/{establecimiento_id}', ['uses' => 'ReservasController@get_reservas_by_establecimiento']); 

//@crear reserva admin
$router->post('reservas',  [ 'uses' => 'ReservasController@crear_reserva']);
//@cancelar reserva
$router->post('cancelarreserva',  [ 'uses' => 'ReservasController@cancelar_reserva']);
//@cancelar reserva admin
$router->post('cancelarreservaadmin',  [ 'uses' => 'ReservasController@cancelar_reserva_admin']);
//@editar reserva
$router->post('editarreserva', ['uses' => 'ReservasController@editar_reserva']);
//@crear reserva usuario logueado
$router->post('reservar', ['uses' => 'ReservasController@crear_reserva_usuario_logueado']);








$router->get('/canchasdestacadas', 'CanchasDestacadasController@get_canchasDestacadas');

//LOGIN
$router->post('/login', 'JwtAuthController@Login');

$router->get('/nodos', 'NodoController@get_nodos');


$router->get('/fichas/nodo/{nodoId}', 'FichaController@get_fichas_by_nodoid');

$router->get('pathways', ['uses' => 'PathwayController@get_pathways']);

$router->get('/constancias/instructor/{pathway}/{ficha}', ['uses' => 'ConstanciaController@get_constancias_instructor']);

$router->group(['middleware'=>'auth:api'],function($router){
    $router->get('usuario',  [ 'uses' => 'UsuarioController@get_usuario']);
    //@Obtener reservas del usuario logueado
    $router->get('reservasuser', ['uses' => 'ReservasController@get_reservas_usuario']);
    $router->get('constancias', ['uses' => 'ConstanciaController@get_user_constancias']);
    $router->get('user/pathways', ['uses' => 'PathwayController@get_user_pathways']);
    $router->post('user/crearconstancia', ['uses' => 'ConstanciaController@create_user_constancia']);
    $router->get('user/constancia/eliminar/{id}', ['uses' => 'ConstanciaController@eliminarConstancia']);

    $router->get('user/ficha',['uses' => 'FichaController@get_user_ficha']);

    $router->put('constancia/estado', ['uses' => 'ConstanciaController@set_estado_constacia']);

    $router->get('aprendices/ficha/{ficha}', ['uses' => 'AprendicesController@get_aprendices_by_ficha_and_instructor']);

    $router->put('aprendices/estado/{id}', ['uses' => 'AprendicesController@activar_desactivar_aprendiz']);

    $router->put('nodos/estado/{id}', ['uses' => 'NodoController@activar_desactivar_nodo']);

    $router->post('nodos/crear', ['uses' => 'NodoController@crear_nodo']);


    //INSTRUCTOR


    $router->get('instructor/fichas', ['uses' => 'FichasInstructorController@get_instructor_fichas']);

});

$router->get('rol/{id}', ['uses' => 'RolController@get_rol']);

$router->post('googlesingup', 'googleAuthController@googleSingUp');
