@extends('app')

@section('titre')
	Utilisateur {!! $user->code !!} 
@stop


@section('content')
@include('incl_fonction')

<section class="content">
    <div class="container-fluid">
		
		
	
			@if(session()->has('ok'))
				<div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
				{!! session('ok') !!}
				</div>
			@endif
	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="row clearfix">
			<div class="card">
			<div class="header">
                            <h2>
                                DETAIL UTILISATEUR
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{ url('user') }}">Voir utilisateurs</a></li>
										<li><a href="{{ url('user/create') }}">Nouveau</a></li>
										
										<li><a href="{{ url('user/'.$user->id.'/edit') }}"  class="" data-toggle="modal">Editer</a></li>
										
										<li><a href="#" class="" data-toggle="modal" data-target="#modalClearuser">Supprimer</a></li>
										<li><a href="#"  class="" data-toggle="modal" data-target="#pass">Réinitialiser password</a></li>
										
										<li><a href="{{ url('user-print/'.$user->id) }}" target="_blanc">Imprimer</a></li>
                                    </ul>
                                </li>
                            </ul>
			


            </div>
			
			<div class="body">
                
				
						<div class="row clearfix">
						
                                <div class="col-md-4">
								<p><b><u>Photo</b></u></p>
									<img src="{{ url('images/user/'.$user->photo) }}" style="width:60%; height:100%; padding:2px; border:1px solid #DDD" alt="Photo" />
									
								</div>
								
								<div class="col-md-4">
									<p><b><u>Infos personnelles</b></u></p>
									<p>
									 Pseudo : <span class="col-cyan ">{!! $user->name !!} </span>
									</p>
									
									<p>
									 Nom : <span class="col-cyan">{!! $user->nom.' '.$user->prenom !!} </span>
									</p>
									
									<p>
									 Fonction : <span class="col-cyan">{!! $user->poste !!} </span>
									</p>
									
									<p>
									 Contact: <span class="col-cyan">{!! $user->contact !!}</span>
									</p>
									
									<p>
									 Email: <span class="col-cyan">{!! $user->email !!}</span>
									</p>
									
									
									<p>
									 Objectif : <span class="col-cyan">{!! separer($user->objectif, 3).' FCFA' !!} </span>
									</p>

                                </div>
								
								
								
								
								
                                <div class="col-md-4">
								
                                    <p><b><u>Infos employeur</b></u></p>
									
									<p>
									 Nom société: <span class="col-cyan">{!! $user->societe_nom !!}</span>
									</p>
									
									<p>
									 Raison sociale société: <span class="col-cyan">{!! $user->societe_raison !!} </span>
									</p>
									
									<p>
									 Capital société: <span class="col-cyan">{!! separer($user->societe_capital, 3).' FCFA' !!}</span>
									</p>
									
									<p>
									 Adresse société: <span class="col-cyan">{!! $user->societe_adresse !!} </span>
									</p>
									
									<p>
									 N° RCC société: <span class="col-cyan">{!! $user->societe_rcc !!}</span>
									</p>
							
			
								</div>
						</div>

						<div class="row clearfix">
							               <br/><br/>                 
							
							
							
							
							<div class="col-md-4">
								
                                    <p><b><u>Emission BC</b></u></p>
									
									<p>
									 Destinataire: <span class="col-cyan">{!! $user->mail_destinateur !!}</span>
									</p>
									
									<p>
									 Copie 1: <span class="col-cyan">{!! $user->mail_destinateur_copy1 !!} </span>
									</p>
									
									<p>
									 Copie 2: <span class="col-cyan">{!! $user->mail_destinateur_copy2 !!}</span>
									</p>
									
							
			
								</div>
								
							
								
							<div class="col-md-4">
								<p><b><u>Privilège</u></b></p>
								
								<p>
								 Etat: <span class="col-pink">@if($user->etat == 1) Non actif @else Actif @endif</span>
								</p>
								
								<p>
								 Modification: <span class="col-pink">@if($user->modification == 1) Oui @else Non @endif</span>
								</p>
								
								<p>
								 Suppression: <span class="col-pink">@if($user->suppression == 1) Oui @else Non @endif</span>
								</p>
																
							</div>
                                
                        </div>
				
			</div>
		</div>
	</div>
	
	
	

</div>
	
	
	
	
<!-- ========================================================= Modal Editer user ============================================================= -->
            <!-- Default Size -->
    <!-- Large Size -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Editer user {!! $user->id !!}</h4>
                        </div>
                        <div class="modal-body">
                            
					 {!! Form::model($user, ['route' => ['user.update', $user->id], 'style' => '', 'files'=>true, 'method' => 'put']) !!}

<!-- Champ caché pour utilisateur -->
 <input type="hidden" name="user_id" value="{!! auth()->user()->id !!}" />
 
						
 <!-- Fin champ caché -->
		 <h5 class="col-pink">Infos l'utilisateur</h5>
				<hr/>
				<div class="row clearfix">
							
								<div class="col-md-4">
                                        <b>Pseudo *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="name" value="{!! $user->name !!}"  minlength="2" class="form-control credit-card" maxlength="220" placeholder="" autofocus required>
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Nom *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="nom" value="{!! $user->nom !!}"  minlength="2" class="form-control credit-card" maxlength="220" placeholder=""  required>
                                            </div>
                                        </div>
                                </div>
							
								<div class="col-md-4">
                                        <b>Prénom(s) *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="prenom" value="{!! $user->prenom !!}" class="form-control credit-card" maxlength="220" placeholder="" required>
                                            </div>
                                        </div>
                                </div>
				</div>
				
				<div class="row clearfix">
								<div class="col-md-4">
                                        <b>Photo </b><span class="font-italic col-pink" style="font-size:80%">(Ne rien uploader si vous ne souhaiter pas changer l'ancienne photo.)</span>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="file" name="photo" value="" class="form-control credit-card" maxlength="220">
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Fonction *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="poste" value="{!! $user->poste !!}" maxlength="220" required class="form-control email" placeholder="">
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Objectif (Montant) </b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="objectif" style="text-align:" min="0" maxlength="220" value="{!! $user->objectif !!}" class="form-control credit-card" placeholder="" >
                                            </div>
                                        </div>
                                </div>
				</div>
				
				<div class="row clearfix">
								
								<div class="col-md-4">
                                        <b>Contact</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="contact" style="text-align:" maxlength="220" value="{!! $user->contact !!}" class="form-control credit-card" placeholder="" required>
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Adresse électronique </b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="email" name="email" style="text-align:" maxlength="220" value="{!! $user->email !!}" class="form-control credit-card" placeholder="" >
                                            </div>
                                        </div>
                                </div>
							
				</div>
				
				<br/><br/>
				
				<h5 class="col-pink">Employeur de l'utilisateur</h5>
				<hr/>
					
					<div class="row clearfix">			
								<div class="col-md-4">
                                        <b>Société nom *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="societe_nom" value="{!! $user->nom !!}" maxlength="220" class="form-control email" placeholder="" required>
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Capital *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" name="societe_capital" value="{!! $user->societe_capital !!}" maxlength="220" class="form-control email" placeholder="" required>
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>N° RCC *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="societe_rcc" value="{!! $user->societe_rcc !!}" maxlength="220" class="form-control email" placeholder="" required>
                                            </div>
                                        </div>
                                </div>
								
							</div>
				
				
							<div class="row clearfix">
								<div class="col-md-4">
                                        <b>Société téléphone *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" name="societe_telephone" value="{!! $user->societe_telephone !!}" class="form-control credit-card" maxlength="100" placeholder="" required>
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Société adresse </b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="societe_adresse"  value="{!! $user->societe_adresse !!}" style="text-align:" maxlength="100"  class="form-control credit-card" placeholder="" >
                                            </div>
                                        </div>
                                </div>
								
								
								
								
							</div>
							
							
							<div class="row clearfix">
								
								<div class="col-md-4">
                                        <b>Société raison sociale </b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="societe_raison" style="text-align:" maxlength="220" value="{!! $user->societe_raison !!}" class="form-control credit-card" placeholder="" >
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Logo société </b> <span class="font-italic col-pink" style="font-size:80%">(Ne rien uploader si vous ne souhaiter pas changer l'ancien logo.)</span>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="file" name="societe_logo" value=""  minlength="2" class="form-control credit-card" maxlength="220">
                                            </div>
                                        </div>
                                </div>
								
								
							</div>
							
							
							<br/><br/>
							<h5 class="col-pink">Destinataire email</h5>
							<hr/>
							
							<div class="row clearfix">
								<div class="col-md-4">
                                        <b>Email destinatairen*</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="email" name="mail_destinateur" value="{!! $user->mail_destinateur !!}" required class="form-control credit-card" maxlength="100" placeholder="" required>
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Email copie 1 *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="email" name="mail_destinateur_copy1"  value="{!! $user->mail_destinateur_copy1 !!}" required style="text-align:" maxlength="100"  class="form-control credit-card" placeholder="" >
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Email copie 2</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="email" name="mail_destinateur_copy2" style="text-align:" maxlength="220" value="{!! $user->mail_destinateur_copy2 !!}" class="form-control credit-card" placeholder="" >
                                            </div>
                                        </div>
                                </div>
								
								
							</div>
							
							<br/><br/>
							<h5 class="col-pink">Privilège de l'utilisateur</h5>
							<hr/>
							
							
							<div class="row clearfix">
							<div class="col-md-4">
									
									<div class="checkbox-group">
									<input type="checkbox" id="md_checkbox_1" name="modification" value="1" class="chk-col-red" @if($user->modification ==1) checked @endif />
									<label for="md_checkbox_1">Modification</label> &nbsp; 
									<input type="checkbox" id="md_checkbox_2" value="1" name="suppression" class="chk-col-pink" @if($user->suppression ==1) checked @endif />
									<label for="md_checkbox_2">Suppression</label> &nbsp;
									<input type="checkbox" id="md_checkbox_3" value="1" name="etat" class="chk-col-pink" @if($user->etat ==1) checked @endif />
									<label for="md_checkbox_3">Non actif</label>
									</div>
								</div>
							</div>
							
							
							
				<p style="text-align:center">	
				 {!! Form::submit('Appliquer', ['class' => 'btn btn-warning', 'style' => 'width:100px']) !!}
				 </p>
{!! Form::close() !!}	
							
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">FERMER</button>
                        </div>
                    </div>
                </div>
            </div>

			

		<!-- Réinitialiser password -->
            <div class="modal fade" id="pass" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Réinitiliser mot de passe</h4>
                        </div>
                        <div class="modal-body">
                            
							<form class="form-horizontal" role="form" method="POST" action="{{ url('password-reinit') }}">
						{!! csrf_field() !!}
						<!-- Champ caché pour utilisateur -->
						<input type="hidden" name="user_id" value="{!! $user->id !!}" />

						<div class="form-group">
							<label class="col-md-4 control-label">Mot de passe</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password" placeholder="xxxx">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmer</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation" placeholder="xxxx">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Réinitialiser</button>
							</div>
						</div>
					</form>
							
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">FERMER</button>
                        </div>
                    </div>
                </div>
            </div>

	
	<!-- ----------------------------  Suppression ------------------------------------------- -->	
			
			
			
			
			
			<!-- Supprimer commande -->
            <div class="modal fade" id="modalClearuser" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Suppression</h4>
                        </div>
                        <div class="modal-body">
                            Souhaitez vous continuer la suppression?
                        </div>
                        <div class="modal-footer">
							{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
							
							{!! Form::submit('Oui', ['class'=> 'btn btn-link']) !!}
							<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Non</button>
							
							{!! Form::close() !!}
                            
                        </div>
                    </div>
                </div>
            </div>
			
	
	
</section>
	
	
	



@endsection	