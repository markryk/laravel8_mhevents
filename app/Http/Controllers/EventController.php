<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index(){

        $search = request('search');
	
	    if ($search) {
		
		    $events = Event::where([
			    ['title', 'like', '%'.$search.'%']
		    ])->get();

	    } else {
		    $events = Event::all(); //chama todos os eventos do bd
	    }

	    return view('home', ['events' => $events, 'search' => $search]); //enviando para home, todos os eventos do bd
    }
    /*public function index(){
        $nome = "Marcos";
        $nome = "Henrique";
        $idade = 30;
        $arr = [10, 20, 30, 40, 50];
        $nomes = ["Marcos", "Marques", "Mark"];
        //return view('welcome');
        return view('home', [
            'nome' => $nome, 
            'idade'=>$idade,
            'arr' => $arr,
            'nomes' => $nomes
        ]);
    }*/

    public function create() {
        return view('events.create');
    }

    public function store (Request $request){
		$event = new Event;

		$event->title = $request->title;
		$event->city = $request->city;
		$event->private = $request->private;
		$event->description = $request->description;
        $event->items = $request->items;
        $event->date = $request->date;
		
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;
            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }

        $user = auth()->user();
	    $event->user_id = $user->id;

		$event->save();
		return redirect('/')->with('msg', 'Evento criado com sucesso');
	}

    public function show($id){
        $event = Event::findOrFail($id);

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();
	    //where('id', $event->user_id) é similar ao comando SELECT do sql
	    //first() pega a primeira ocorrência no banco (pra evitar q ele continue pesquisando depois de achar)
	    //toArray() transforma o resultado em array

        $user = auth()->user();
		$hasUserJoined = false;

		if($user){
			$userEvents = $user->eventsAsParticipant->toArray();

			foreach($userEvents as $userEvent){
				if ($userEvent['id'] == $id) {
					$hasUserJoined = true;
				}
			}
        }
		return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
	
	    //return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
        //return view('show', ['event' => $event]);
    }

    public function dashboard() {
		$user = auth()->user();
		$events = $user->events; //essa linha quer dizer que o usuário terá acesso a todos os eventos
        $eventsAsParticipant = $user->eventsAsParticipant;
		return view('events.dashboard', 
            ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant]
        );
	}

    public function destroy($id) {
        Event::findOrFail($id)->delete();
		return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso');
    }

    public function edit($id) {
        $user = auth()->user();
		$event = Event::findOrFail($id);

        if ($user->id != $event->user_id) {
			return redirect('/dashboard');
		}
        
		return view('events.edit', ['event' => $event]);
	}

    public function update(Request $request) {

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;
            $requestImage->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        }

		Event::findOrFail($request->id)->update($data);
		return redirect('/dashboard')->with('msg', 'Evento editado com sucesso');
	}

    public function joinEvent($id){
		$user = auth()->user(); //Recebe um usuário autenticado
		$user->eventsAsParticipant()->attach($id);
		$event = Event::findOrFail($id);
		return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento '. $event->title);
	}

    public function leaveEvent($id){
		$user = auth()->user(); //Recebe um usuário autenticado
		$user->eventsAsParticipant()->detach($id); //código para sair do evento
		$event = Event::findOrFail($id);
		return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento: '. $event->title);
	}
}
?>