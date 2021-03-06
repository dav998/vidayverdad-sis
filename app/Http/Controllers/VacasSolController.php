<?php

namespace App\Http\Controllers;

use App\SolVacas;
use App\Vacas;
use App\VacasUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Permiso;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class VacasSolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $solvacas = SolVacas::where('user_id', $user->id)->orderBy('created_at', 'DES')->paginate(10);
        return view('/solvacas', compact('solvacas', 'user'));
    }


    public function show($id)
    {
        $user = Auth::user();
        $solvacas=SolVacas::find($id);
        $vacas = VacasUser::where('user_id', $user->id)->get()->first();
        return view('vacasver',compact('vacas','user','solvacas'));
    }
    public function create(){
        $user = Auth::user();
        return view('pre_vacas', compact('user'));
    }
    public function invierno(){
        $user = Auth::user();
        $vacasuser = VacasUser::where('user_id', $user->id)->get()->first();
        $vacas = Vacas::where('id', 1)->get()->first();
        return view('otras_vacas', compact('user', 'vacas', 'vacasuser'));
    }
    public function verano(){
        $user = Auth::user();
        $vacasuser = VacasUser::where('user_id', $user->id)->get()->first();
        $vacas = Vacas::where('id', 2)->get()->first();
        return view('otras_vacas', compact('user', 'vacas','vacasuser'));
    }
    public function dias(Request $request, $id){

        $user = Auth::user();
        $this->validate($request,[ 'fecha_inicio'=>'required|date|date_format:Y-m-d|after:hoy',
            'fecha_fin'=>'required|date_format:Y-m-d|after:fecha_inicio',]);

        $fdate = request('fecha_inicio');
        $tdate = request('fecha_fin');
        /*$datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a')+1;//now do whatever you like with $days
        return $days;*/
        function getWorkingDays($startDate, $endDate)
        {
            $begin = strtotime($startDate);
            $end   = strtotime($endDate);
            if ($begin > $end) {
                echo "startdate is in the future! <br />";

                return 0;
            } else {
                $no_days  = 0;
                $weekends = 0;
                while ($begin <= $end) {
                    $no_days++; // no of days in the given interval
                    $what_day = date("N", $begin);
                    if ($what_day > 5) { // 6 and 7 are weekend days
                        $weekends++;
                    };
                    $begin += 86400; // +1 day
                };
                $working_days = $no_days - $weekends;

                return $working_days;
            }
        }
        $dias = getWorkingDays($fdate, $tdate);
        $vacas=VacasUser::where('user_id','=',$user->id)->get()->first();
        return view('/crear_vacas', compact('dias', 'user', 'vacas', 'fdate', 'tdate','id'));

        }

    public function store()
    {
        //dd($request->all());
        $tipovaca = request('idvaca');
        $vacas = new SolVacas();
        $vacas->tipo = request('idvaca');
        $vacas->user_id = request('id');
        $vacas->fecha_inicio = request('fecha_inicio');
        $vacas->fecha_fin = request('fecha_fin');
        $vacas->dias = request('dias');
        $vacas->aprobado = 0;
        $pendientes = request('pendientes');
        if($pendientes < 0){
            if($tipovaca == 1){
                return redirect()->action('VacasSolController@invierno')->withInput()->with('warning', 'No puede tener dias pendientes negativos');
            }else{
                if($tipovaca == 2){
                return redirect()->action('VacasSolController@verano')->withInput()->with('warning', 'No puede tener dias pendientes negativos');
                }else{
                    return redirect()->action('VacasSolController@create')->withInput()->with('warning', 'No puede tener dias pendientes negativos');
                }
            }

        }else{
            $vacas->save();
            $infos = DB::table('solicitud_vacas')
                ->join('users', 'solicitud_vacas.user_id', '=', 'users.id')
                ->where('solicitud_vacas.id' , '=', $vacas->id)
                ->select('users.nombre', 'users.cargo', 'solicitud_vacas.fecha_inicio', 'solicitud_vacas.fecha_fin', 'solicitud_vacas.tipo', 'solicitud_vacas.dias')
                ->get();

            $mailadm = DB::table('users')
                ->select('users.email')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->where('roles.nombre', '=', 'administrador')
                ->get()->first();

            $maildir = DB::table('users')
                ->select('users.email')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->where('roles.nombre', '=', 'direccion')
                ->get()->first();


            $data = array('infos' => $infos);
            $to_name= 'Direccion';
            $to_mailadm = $mailadm;
            $to_maildir = $maildir;

            Mail::send('emails.vacas_mail', $data, function ($message) use ($to_name, $to_mailadm){
                $message->to($to_mailadm, $to_name)
                    ->subject('Solicitud de Permiso');
                $message->from('ue.vida.verdad@gmail.com', 'Vida y Verdad');
            });

            Mail::send('emails.vacas_mail', $data, function ($message) use ($to_name, $to_maildir){
                $message->to($to_maildir, $to_name)
                    ->subject('Solicitud de Permiso');
                $message->from('ue.vida.verdad@gmail.com', 'Vida y Verdad');
            });
            return redirect()->action('VacasSolController@index')->with('success', 'Solicitud de vacacion enviada');
        }




        /*$image = $request->file('imagen');
        $image->move('uploads', $image->getClientOriginalName());
        $multimedia->uri = $image->getClientOriginalName();
        $multimedia->id_propiedad = $propiedad->id_propiedad;
        $multimedia->save();*/
    }

    public function destroy($id)
    {
        $vacas = SolVacas::find($id);
                $vacas->delete();
                return redirect()->route('solvacas.index')->with('danger', 'La Solicitud ha sido eliminada.');
    }
}
