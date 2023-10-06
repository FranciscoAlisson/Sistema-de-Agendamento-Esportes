<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index($sucesso = null)
    {
        $events = array();
        $data = Event::all();
        foreach($data as $datas){
            $events[] = [
                'id' => $datas->id,
                'title' => $datas->title,
                'start' => $datas->start_event,
                'end' => $datas->end_event,                
            ];
            $id = $datas->id;    
        }
        if(isset($id)){
            return view ('index',['dados' => $events,'id' => $id]);
        }else{
            return view ('index',['dados' => $events]);
        }
    }

    public function createEvent(Request $request,$data)
    {

        return view('addevent', [
            'data' => $data
        ]);

    }

    public function editEvent(Request $request)
    {
        if(($request->horario >= '07:15') && ($request->horario <= '17:30')){
            $horario_fim = gmdate('H:i', strtotime( $request->extensao_horario ) + strtotime('01:00') );

            $start_event = $request->data. ' ' .$request->horario;
            $end_event = $request->data. ' ' .$horario_fim;

            if(DB::table('events')->where('id',$request->id)->count() == 1){
                Event::findOrFail($request->id)->update([
                    'title' => $request->disciplina,
                    'start_event' => $start_event,
                    'end_event' => $end_event,
                    'color' => $request->color,                   
                ]);

                return redirect()->route('index')->with('successEdit','Agendamento alterado com sucesso!');
            }else{
                return redirect()->route('index')->with('error','Já existe um evento agendado nesse horario!');
            }
                        
        }else{
            $horario_fim = gmdate('H:i', strtotime( $request->extensao_horario ) + strtotime('00:50') );

            $start_event = $request->data. ' ' .$request->horario;
            $end_event = $request->data. ' ' .$horario_fim;

            if(DB::table('events')->where('start_event','>=',$start_event)->where('end_event','<=',$end_event)->count() == 0){                
                Event::findOrFail($request->id)->update([
                    'title' => $request->disciplina,
                    'start_event' => $start_event,
                    'end_event' => $end_event,
                    'color' => $request->color,                    
                ]);
            }else{
                return redirect()->route('index')->with('error','Já existe um evento agendado nesse horario');
            }
        };
                
    }

    public function alterEvent($id)
    {
        $dados = Event::findOrFail($id);

        $data = explode(" ",$dados->start_event);

         return view ('alterevent',[
            'dados' => $dados,
            'data' => $data[0]
        ]); 
    }

    public function dropEvent($id)
    {
        $drop = Event::findOrFail($id)->delete();

        if($drop){
            return redirect()->route('index')->with('dropSuccess','Agendamento cancelado com sucesso!');
        }else{
            return redirect()->route('index')->with('dropFail','Erro ao cancelar o agendamento!');
        }
    }

    public function addEvento(Request $request)

    {
        $horario = request('horario');
        $extensao_horario = request('extensao_horario');
        $disciplina = request('disciplina');
        $data = request('data');
        $color = request('color');
        $data_termino = request('data_termino');

        //IF para dizer se o usuario quis extender a data
        if($data_termino == 'null'){
            //Através do padrão,eu somar uma hora ou 50 mins
            if(($horario >= '07:15') && ($horario <= '17:30')){
                if($extensao_horario != '00:00'){
                    $horario_fim = gmdate('H:i', strtotime($extensao_horario ) + strtotime('01:00') );
                }else{
                    $horario_fim = gmdate('H:i', strtotime($horario) + strtotime('01:00') );
                }

                $start_event = $data. ' ' .$horario;
                $end_event = $data. ' ' .$horario_fim;

                if(DB::table('events')->where('start_event','>=',$start_event)->where('end_event','<=',$end_event)->count() == 0){
                    $add = Event::create([
                        'title' => $disciplina,
                        'start_event' => $start_event,
                        'end_event' => $end_event,
                        'color' => $color,                   
                    ]);
                    if($add){
                        return 'Confirmação realizada com sucesso!';
                    }else{
                        return 'Agendamento cancelado com sucesso!';
                    }
                }else{
                    return redirect()->route('index')->with('errorInsert','Já existe um agendamento feito neste horário!!');
                } 
            }else{
                if($extensao_horario != '00:00'){
                    $horario_fim = gmdate('H:i', strtotime($extensao_horario ) + strtotime('02:00') );
                }else{
                    $horario_fim = gmdate('H:i', strtotime($horario) + strtotime('02:00') );
                }

                $start_event = $data. ' ' .$horario;
                $end_event = $data. ' ' .$horario_fim;

                if(DB::table('events')->where('start_event','>=',$start_event)->where('end_event','<=',$end_event)->count() == 0){                
                    $add = Event::create([
                        'title' => $disciplina,
                        'start_event' => $start_event,
                        'end_event' => $end_event,
                        'color' => $color,                   
                    ]);
                    
                    if($add){
                        return 'Confirmação realizada com sucesso!';
                    }else{
                        return 'Agendamento cancelado com sucesso!';
                    }
                }else{
                    return redirect()->route('index')->with('errorInsert','Já existe um agendamento feito neste horário!');
                }
            }
        }else{
            if(($horario >= '07:15') && ($horario <= '17:30')){
                if($extensao_horario != '00:00'){
                    $horario_fim = gmdate('H:i', strtotime($extensao_horario ) + strtotime('01:00') );
                }else{
                    $horario_fim = gmdate('H:i', strtotime($horario) + strtotime('01:00') );
                }

                $diferenca = gmdate('d', strtotime($data_termino) - strtotime($data));
                $total = $diferenca - 1;
                $qtd_semanas = $total/7 + 1;                                            
                
                $start_event = $data.' '.$horario;
                $end_event = $data.' '.$horario_fim;               

                if(DB::table('events')->where('start_event','>=',$start_event)->where('end_event','<=',$end_event)->count() == 0){                                                                  
                     for($i = 1;$i <= $qtd_semanas;$i++){
                        
                        $add = Event::create([
                            'title' => $disciplina,
                            'start_event' => $start_event,
                            'end_event' => $end_event,
                            'color' => $color,                   
                        ]);                              
                        
                        $start_event = date('Y-m-d', strtotime("+7 days",strtotime($start_event))).' '.$horario;
                        $end_event = date('Y-m-d', strtotime("+7 days",strtotime($end_event))).' '.$horario_fim;
                    }
                    if($add){
                        return 'Confirmação realizada com sucesso!';
                    }else{
                        return 'Erro ao confirmar o horário';
                    } 
                }else{
                    return redirect()->route('index')->with('errorInsert','Já existe um agendamento feito neste horário!');
                } 
            }else{
                if($extensao_horario != '00:00'){
                    $horario_fim = gmdate('H:i', strtotime($extensao_horario ) + strtotime('02:00') );
                }else{
                    $horario_fim = gmdate('H:i', strtotime($horario) + strtotime('02:00') );
                }

                $diferenca = gmdate('d', strtotime($data_termino) - strtotime($data));
                $total = $diferenca - 1;
                $qtd_semanas = $total/7 + 1;

                $start_event = $data. ' ' .$horario;
                $end_event = $data. ' ' .$horario_fim;

                if(DB::table('events')->where('start_event','>=',$start_event)->where('end_event','<=',$end_event)->count() == 0){                
                    for($i = 1;$i <= $qtd_semanas;$i++){
                        
                        $add = Event::create([
                            'title' => $disciplina,
                            'start_event' => $start_event,
                            'end_event' => $end_event,
                            'color' => $color,                   
                        ]);                              
                        
                        $start_event = date('Y-m-d', strtotime("+7 days",strtotime($start_event))).' '.$horario;
                        $end_event = date('Y-m-d', strtotime("+7 days",strtotime($end_event))).' '.$horario_fim;

                    }
                    if($add){
                        return 'Confirmação realizada com sucesso!';
                    }else{
                        return 'Erro ao confirmar o horário';
                    }
                }else{
                    return redirect()->route('index')->with('errorInsert','Já existe um agendamento feito neste horário!');
                }
            }
        }
    }
}