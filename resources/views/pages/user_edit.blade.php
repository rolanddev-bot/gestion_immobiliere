@extends('app')

@section('titre')
	Editer utilisateur {!! $user->name !!}
@stop


@section('content')

<section class="content">
    <div class="container-fluid">
		

		
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="row clearfix">
			<div class="card">
                 

				 <div class="header">
                            <h2>
                                EDITER UTILISATEUR {!! $user->name !!}
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:history.back()">Annuler</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
						
            <div class="body">
 

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
                                        <b>Photo </b><span class="font-italic col-pink" style="font-size:80%">(Ne rien uploader si vous ne souhaiter changer l'ancienne photo.)</span>
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
								
								
							</div>
							
							
							<div class="row clearfix">
								
								
								
								
							
								
							</div>
							
							<br/><br/>
							<h5 class="col-pink">Destinataire Bon de commande</h5>
							<hr/>
							
							<div class="row clearfix">
								<div class="col-md-4">
                                        <b>Email destinataire*:</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="email" name="mail_destinateur" value="{!! $user->mail_destinateur !!}" class="form-control credit-card" maxlength="100" placeholder="" required>
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Email copie 1:</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="email" name="mail_destinateur_copy1"  value="{!! $user->mail_destinateur_copy1 !!}" style="text-align:" maxlength="100"  class="form-control credit-card" placeholder="" >
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Email copie 2:</b>
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
							
							
							
				<p align="right" style="text-align:right">			
				 {!! Form::submit('Appliquer', ['class' => 'btn bg-blue', 'style' => 'width:100px']) !!}
				 </p>
{!! Form::close() !!}				
			</div>
        </div>
	
	</div>
</div>
</section>
	
	
	



@endsection	