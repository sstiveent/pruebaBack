<?php

namespace App\Http\Controllers;

use App\Mail\CotizacionMail;
use App\Models\cotizacion;
use App\Models\departamento;
use App\Models\municipio;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;

class api extends Controller
{
    public static function getDepartamentos()
    {
        return  departamento::all(['id', 'nombre'])->toJson();
    }

    public static function getMunicipios(Request $request)
    {
        if (isset($request->departamento) && is_numeric($request->departamento)) {
            $id  = $request->departamento;
        } else {
            return response(['error' => 1, 'msj' => "Error al recibir los datos"]);
        }
        return  municipio::select(['id', 'nombre'])
            ->where('id_departamento', $id)
            ->get()
            ->toJson();
    }

    public static function storeCotizacion(Request $request)
    {
        $rules = [
            'modelo' => 'required|string|min:3|max:50',
            'nombre' => 'required|string|min:3|max:50',
            'email' => 'required|email',
            'telefono' => 'required|digits:10|numeric',
            'ciudad' => 'required|numeric',
            'tratamiento' => 'required|boolean',
        ];
        $messages = [
            'required' => 'El :attribute es requerido.',
            'digits' => 'El :attribute debe tener una longitud de :size.',
            'min' => 'El :attribute con entrada :input debe tener minimo :min caracteres.',
            'max' => 'El :attribute con entrada :input debe tener maximo :max caracteres.',
            'email' => 'El :attribute debe ser un email.',
            'numeric' => 'El :attribute debe ser un numero.',
            'boolean' => 'El :attribute debe ser verdadero o falso.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $primerError = $validator->errors()->first();
            return response(['error' => 1, 'msj' => $primerError]);
        }

        $buscar = cotizacion::where('email', $request->email)->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->first();
        if (!is_null($buscar)) {
            return response(['error' => 2, 'msj' => "Ya tenemos tus datos, pronto un representante se contactará contigo"]);
        }

        if ($request->tratamiento) {
            return response(['error' => 1, 'msj' => "Debe aceptar los términos y condiciones."]);
        }
        $cotizacion = new cotizacion();
        $cotizacion->modelo = $request->modelo;
        $cotizacion->nombre = $request->nombre;
        $cotizacion->email = $request->email;
        $cotizacion->celular = $request->telefono;
        $cotizacion->id_municipio = $request->ciudad;
        try {
            $cotizacion->save();
        } catch (Exception $e) {
            return response(['error' => 1, 'msj' => "Error al insertar"]);
        }

        $receivers = ['nleon@processoft.com.co','ocalero@processoft.com.co','jmartinez@processoft.com.co'];
        Mail::to($receivers)->send(new CotizacionMail($cotizacion));

        return response(['error' => 0, 'msj' => "Guardado exitosamente"]);
    }

    public static function showRegistros(){
        return cotizacion::all()->toJson();
    }
}
