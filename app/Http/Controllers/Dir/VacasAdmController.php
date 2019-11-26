<?php

namespace App\Http\Controllers\Dir;

use App\Permiso;
use App\Role;
use App\SolVacas;
use App\User;
use App\VacasUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;


class VacasAdmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $permisos = Permiso::where('user_id', $user->id)->orderBy('created_at', 'ASC')->paginate(10);
        return view('/permisos', compact('permisos', 'user'));
        $permiso [] = DB::table('permisos')->pluck('user_id');
        $user= User::where('id', $permiso);
        return view('dir.permisos.index', compact('user'))->with('permisos', Permiso::paginate(10));
        //return $permiso;*/
        $datas = DB::table('vacas_user as P')
            ->select('P.anos_trabajados', 'P.dias_totales', 'P.dias_cuenta', 'P.dias_disp', 'U.nombre', 'U.cargo', 'U.ano_ingreso', 'P.dias_tomados')
            ->whereNotNull('U.ano_ingreso')
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->orderBy('U.ano_ingreso', 'asc')
            ->get();
        return view('dir.vacaciones.index', compact('datas'));
    }

    public function aproved()
    {
        $datas = DB::table('solicitud_vacas as P')
            ->select('P.fecha_inicio', 'P.tipo', 'P.created_at', 'P.fecha_fin', 'P.aprobado', 'P.dias','U.nombre', 'U.id','P.id as pid')
            ->where('aprobado', 1)
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->orderBy('P.created_at', 'DESC')
            ->paginate(10);
        return view('dir.vacaciones.aproved', compact('datas'));
        //return 'tonto';

    }

    public function espera()
    {
        $datas = DB::table('solicitud_vacas as P')
            ->select('P.fecha_inicio', 'P.tipo', 'P.created_at', 'P.fecha_fin', 'P.aprobado', 'P.dias','U.nombre', 'U.id','P.id as pid')
            ->where('aprobado', 0)
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->orderBy('P.created_at', 'DESC')
            ->paginate(10);
        return view('dir.vacaciones.espera', compact('datas'));
        //return 'tonto';

    }
    public function rejected()
    {
        $datas = DB::table('solicitud_vacas as P')
            ->select('P.fecha_inicio', 'P.tipo', 'P.created_at', 'P.fecha_fin', 'P.aprobado', 'P.dias','U.nombre', 'U.id','P.id as pid')
            ->where('aprobado', 2)
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->orderBy('P.created_at', 'DESC')
            ->paginate(10);
        return view('dir.vacaciones.rejected', compact('datas'));
        //return 'tonto';

    }

    public function vacasper(){

        $datas = DB::table('vacas_user as P')
            ->select('P.anos_trabajados', 'P.dias_disp', 'U.nombre', 'U.cargo', 'U.ano_ingreso', 'P.dias_tomados')
            ->whereNotNull('U.ano_ingreso')
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->orderBy('U.ano_ingreso', 'asc')
            ->paginate(4);
        return view('dir.vacaciones.personal', compact('datas'));

    }
    public function fun_pdf(){
        $datas = DB::table('vacas_user as P')
            ->select('P.anos_trabajados', 'P.dias_disp', 'U.nombre', 'U.cargo', 'U.ano_ingreso', 'P.dias_tomados')
            ->whereNotNull('U.ano_ingreso')
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->orderBy('U.ano_ingreso', 'asc')
            ->get();
        $pdf = PDF::loadView('dir.vacaciones.personal', compact('datas'));
        return$pdf->download('invoice.pdf');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SolVacas::find($id);
        $user = User::where('id','=',$data->user_id)->get()->first();

        return view('dir.vacaciones.show', compact('data', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       /* $data = DB::table('permisos as P')
            ->select('P.id')
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->get();*/
        //$data = Permiso::select('fecha_ausencia', 'motivo', 'created_at', 'cargo', 'suplente', 'id')->where('user_id', $id)->get();
        //$user = User::select('nombre')->where('id', $id)->get();
        $data = SolVacas::find($id);
        $user = User::where('id','=',$data->user_id)->get()->first();

        return view('dir.vacaciones.edit', compact('data', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $diasvacas = SolVacas::where('id', $id)->get()->first();
        $diasuser = VacasUser::where('user_id', $diasvacas->user_id)->get()->first();

        if($diasvacas->dias > $diasuser->dias_disp && request('aproved') == 1){
            return redirect()->action('Dir\VacasAdmController@edit', $id)->with('danger', 'Los dias de vacacion del empleado son menores al solicitado. Por favor rechace la solicitud.');

        }else {
            DB::table('solicitud_vacas')
                ->where('id', $id)
                ->update(['aprobado' => request('aproved'),
                    'observaciones' => request('observacion')]);

            $dias_tomados = request('dias');
            $aprovado = request('aproved');

            if ($aprovado == 1) {

                $vacas = VacasUser::where('user_id', '=', request('user_id'))->get()->first();

                DB::table('vacas_user')
                    ->where('user_id', request('user_id'))
                    ->update(['dias_disp' => $vacas->dias_disp - $dias_tomados,
                        'dias_tomados' => $vacas->dias_tomados + $dias_tomados]);

                $infos = DB::table('solicitud_vacas')
                    ->join('users', 'solicitud_vacas.user_id', '=', 'users.id')
                    ->where('solicitud_vacas.id', '=', $id)
                    ->select('users.nombre', 'users.cargo', 'solicitud_vacas.fecha_inicio', 'solicitud_vacas.fecha_fin', 'solicitud_vacas.tipo', 'solicitud_vacas.dias', 'solicitud_vacas.aprobado', 'solicitud_vacas.observaciones')
                    ->get();


                $data = array('infos' => $infos);
                $to_name = 'Direccion';
                $to_mail = 'daalfaro96@gmail.com';

                Mail::send('emails.vacas_mail_user', $data, function ($message) use ($to_name, $to_mail) {
                    $message->to($to_mail, $to_name)
                        ->subject('Solicitud de Vacacion');
                    $message->from('ue.vida.verdad@gmail.com', 'Vida y Verdad');
                });

                return redirect()->action('Dir\VacasAdmController@espera')->with('success', 'Solicitud de Registrada');

            } else {

                $infos = DB::table('solicitud_vacas')
                    ->join('users', 'solicitud_vacas.user_id', '=', 'users.id')
                    ->where('solicitud_vacas.id', '=', $id)
                    ->select('users.nombre', 'users.cargo', 'solicitud_vacas.fecha_inicio', 'solicitud_vacas.fecha_fin', 'solicitud_vacas.tipo', 'solicitud_vacas.dias', 'solicitud_vacas.aprobado', 'solicitud_vacas.observaciones')
                    ->get();


                $data = array('infos' => $infos);
                $to_name = 'Direccion';
                $to_mail = 'daalfaro96@gmail.com';

                Mail::send('emails.vacas_mail_user', $data, function ($message) use ($to_name, $to_mail) {
                    $message->to($to_mail, $to_name)
                        ->subject('Solicitud de Vacacion');
                    $message->from('ue.vida.verdad@gmail.com', 'Vida y Verdad');
                });

                return redirect()->action('Dir\VacasAdmController@espera')->with('success', 'Solicitud de Registrada');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



    }
}
