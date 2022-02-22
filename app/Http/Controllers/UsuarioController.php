<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Tercero;
use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function auth(Request $request)
    {
        $post = $request->all();
        if ($post) {
            $post    = (object) $post;
            $usuario = Usuario::where('usuario', $post->usuario)
                ->where('estado', 1)
                ->first();

            if ($usuario) {
                $clave = md5($post->clave);

                if (trim($usuario->clave) == trim($clave)) {

                    //aca el tercero existe pero hay que mirar el estado
                    if ($usuario->tercero->estado == 0) {
                        return back()->withErrors(['error' => 'Acceso denegado']);
                    }

                    session([
                        'id_usuario'         => $usuario->id_usuario,
                        'id_tercero_usuario' => $usuario->tercero->id_tercero,
                        'id_licencia'        => $usuario->tercero->id_licencia,
                        'nombre_licencia'    => $usuario->tercero->licencia->nombre,
                        'id_perfil'          => $usuario->id_perfil,
                    ]);
                    return redirect()->route('index');
                }
                return back()->withErrors(['error' => 'Credenciales invalidas']);
            } else {
                return back()->withErrors(['error' => 'Credenciales invalidas']);
            }

        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    public function index()
    {
        return redirect()->route('canales_servicio');
    }

    public function administrar($value = '')
    {
        $usuarios = Usuario::join('tercero as t', 't.id_tercero', '=', 'usuario.id_tercero')
            ->where('t.id_licencia', session('id_licencia'))
            ->where('usuario.id_perfil', '<>', 1)
            ->get();

        return view('usuario.administrar', compact(['usuarios']));
    }

    public function guardar(Request $request, $id_usuario = null)
    {
        $post            = $request->all();
        $usuario         = new Usuario;
        $clave_antigua   = null;
        $usuario->estado = null;
        if ($id_usuario != null) {
            $usuario                     = Usuario::find($id_usuario);
            $usuario->clave_confirmacion = $usuario->clave;
            $clave_antigua               = $usuario->clave;
        }

        $empleados = Tercero::all()->where('id_licencia', session('id_licencia'))
            ->where('id_dominio_tipo_tercero', 2); //empleado
        $perfiles = Perfil::all()->where('id_perfil', '<>', 1);
        $errors   = [];
        if ($post) {
            $post = (object) $post;
            $usuario->fill($request->except(['_token']));
            $usuario_nombre = Usuario::join('tercero as t', 't.id_tercero', '=', 'usuario.id_tercero')
                ->where('usuario.usuario', $post->usuario)
                ->where('t.id_licencia', session('id_licencia'))
                ->where('usuario.id_usuario', '<>', $id_usuario)
                ->first();
            if (!$usuario_nombre) {
                if ($post->clave == $post->clave_confirmacion) {
                    if ($this->validar_clave($post->clave)) {
                        if ($id_usuario != null) {
                            if ($post->clave != $clave_antigua) {
                                $usuario->clave = md5($post->clave);
                            }
                        } else {
                            $usuario->clave = md5($post->clave);
                        }

                        if ($usuario->save()) {
                            return redirect()->route('usuario/administrar');
                        } else {
                            $errors = $usuario->errors;
                        }
                    } else {
                        $errors[] = "La contraseña debe contener por lo menos 1 letra, 1 numero y minimo 8 caracteres.";
                    }
                } else {
                    $errors[] = "Las contraseñas no coinciden.";
                }
            } else {
                $errors[] = "El nombre de usuario ya esta registrado.";
            }
        }
        return view('usuario.form', compact(['usuario', 'empleados', 'perfiles', 'errors']));
    }

    public function validar_clave($clave)
    {
        if (strlen($clave) < 8) {
            $error_clave = "La clave debe tener al menos 8 caracteres";
            return false;
        }
        if (!preg_match('`[a-z]`', strtolower($clave))) {
            $error_clave = "La clave debe tener al menos una letra";
            return false;
        }
        if (!preg_match('`[0-9]`', $clave)) {
            $error_clave = "La clave debe tener al menos un caracter numérico";
            return false;
        }
        return true;
    }
}
