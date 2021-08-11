<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserUpdatePassRequest;

use Illuminate\Support\Facades\Redirect;
use App\Repositories\UserRepository;

use App\User;
use App\Societe;

use DB;
use PDF;
use Auth;
use Excel;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    
	
	
	
	protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
		
    }

	
    public function index()
    {
		$user_id = $this->my_user_id();
		$users = User::orderBy('nom', 'ASC')->get();
		$nb = User::count();
		
		return view('pages.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		
		return view('user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {
		//Inialisation
		$img = '';
		$image = $request->file('photo');
		//$image1 = $request->file('societe_logo');
		
		
		$user = $this->userRepository->store($request->all());
		$num = $user->id;
		//Ajouter
		//Traiter image 
		if($image->isValid()) 
		  { 
			$chemin = 'images/user'; 
			$extension = $image->getClientOriginalExtension(); 
			do { 
				$nom = time() . '.' . $extension; 
			} while(file_exists($chemin . '/' . $nom)); 
			
			if($image->move($chemin, $nom)) { 
				
				DB::update("update users set photo = '$nom'  where id = ?", array($num));
				} 
		  } 
		  
		

		return redirect('user/'.$num)->withOk("Utilisateur ajouté! ");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getById($id);
		
		return view('user_show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
         $user = $this->userRepository->getById($id);
		 
		 return view('user_edit', compact('user'));
    }

    
    public function update(Request $request, $id)
    {
        //Inialisation
		$img = '';
		$image = $request->file('photo');
		
		$var_mod = $request->input('modification')?1:0;
		$var_sup = $request->input('suppression')?1:0;
		$var_etat = $request->input('etat')?1:0;
		
	
		DB::update("update users set modification = '$var_mod', suppression = '$var_sup', etat='$var_etat'  where id = ?", array($id));
		//exit();
		$this->userRepository->update($id, $request->all());
		
		$num = $id;
		//Ajouter
		//Traiter image 
		if($request->file('photo') !='')
		{
			if($image->isValid()) 
			  { 
				$chemin = 'images/user'; 
				$extension = $image->getClientOriginalExtension(); 
				do { 
					$nom = time() . '.' . $extension; 
				} while(file_exists($chemin . '/' . $nom)); 
				
				if($image->move($chemin, $nom)) { 
					
					DB::update("update users set photo = '$nom'  where id = ?", array($num));
					} 
			  }
		}
		  
		
		
		return redirect('user/'.$id)->withOk("Utilisateur modifié! ");
    }

    
    public function destroy($id)
    {
		$this->userRepository->destroy($id);

        return redirect('user')->withOk("Utilisateur supprimé!");
    }
	
	
	//suppression par formulaire perso
	public function sup(Request $request)
    {	
		$id = $request->input('code');
				
		$this->userRepository->destroy($id);

        return redirect('user')->withOk("Utilisateur supprimé!");
    }
	
	
	public function imprimer($id)
    {
		$user = $this->userRepository->getById($id);
		
		//return view('user_print', compact('user'));
		
		$date = date('Y-m-d H:i:s');
		DB::update("update users set date_print = '$date', cpte_print = cpte_print + 1  where id = ?", array($user->id));
		
		$date = date('Y-m-d H:i');
		$pdf = PDF::loadView('user_print', compact('user'));
		$name = "UT_N°".$user->id." - ".$date.".pdf";
		return $pdf->download($name);
						
	}


    public function reinit(UserUpdatePassRequest $request)
    {
        
		 $id = $request->input('user_id');
		 $pass_nvo =  bcrypt($request->input('password'));
		 
		DB::update("update users set password = '$pass_nvo'  where id = ?", array($id));
		
		return redirect()->back()->withOk("Mot de passe modifié !");
		 
    }
	
	 public function modifpass(Request $request)
    {
        $user_id = $this->my_user_id();
		
		$pass_nvo =  bcrypt($request->input('password'));
		 
		DB::update("update users set password = '$pass_nvo'  where id = ?", array($user_id));
		
		return redirect()->back()->withOk("Mot de passe modifié !");
		 
    }
	

	
	public function compte()
	{
        return view('moncompte'); 
	}
	
	
	
	//Exporter en excel admin
	public function excel($forma) {
	
	$forma_definitif = '';
	//Verifier si le forma est xlsx ou csv
	if($forma == 'xlsx' OR $forma == 'csv'){
	
	$user_id = $this->my_user_id();
    $vars = User::select(
	'id',
	'name',
	'nom',
	'prenom',
	'poste',
	'contact',
	'email', 'societe_nom', 'societe_capital', 'societe_telephone', 'societe_raison', 'mail_destinateur', 'mail_destinateur_copy1', 'mail_destinateur_copy2',
	'objectif',
	'created_at',
	'updated_at')
	->get();
	

    $varsArray = []; 

	$varsArray[] = [
	'Identifiant', 'Pseudo', 'Nom', 'Prénom(s)', 'Fonction', 'Contact', 'Email', 
	'Nom société', 'Capital société', 'Téléphone société', 'Raison sociale', 'Mail Destinateur', 'Copy 1', 'Copy 2', 'Objectif',
	'Date création', 'Date modification'
	];

    foreach ($vars as $var) {
        $varsArray[] = $var->toArray();
    }

		// Generate and return the spreadsheet
		Excel::create('Utilisateurs - '.date('d/m/Y H:i'), function($excel) use ($varsArray) {

			$excel->setTitle('Utilisateurs - '.date('d/m/Y H:i'));
			$excel->setCreator('CRM')->setCompany('Enical Technologies');
			$excel->setDescription('Utilisateurs CRM');

			$excel->sheet('Utilisateurs', function($sheet) use ($varsArray) {
            $sheet->fromArray($varsArray, null, 'A1', false, false);
        });

		})->download($forma);
		
		}else{ // si forma incorrecte ramener message d'erreur
		return redirect()->back()->withOk("Erreur inconnue!");
	}
	}
	
	
	public function my_user_id()
	{
		$user = \Auth::user(); 
		return $user_id = $user->id;
	}
	
	
}
