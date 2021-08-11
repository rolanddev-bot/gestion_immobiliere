@extends('app')

@section('titre')
	Nouvel utilisateur
@stop


@section('content')

<section class="content">
    <div class="container-fluid">
		

		
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="row clearfix">
			<div class="card">
                 

				 <div class="header">
                            <h2>
                                NOUVEL UTILISATEUR
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
 
 {!! Form::open(array('route' => 'user.store', 'method' => 'POST', 'class'=>'', 'files' => true)) !!}

<!-- Champ caché pour utilisateur -->
 <input type="hidden" name="user_id" value="{!! auth()->user()->id !!}" />
 
						
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
                                                <input type="text" name="name" value=""  minlength="2" class="form-control credit-card" maxlength="220" placeholder="" autofocus required>
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
                                                <input type="text" name="nom" value=""  minlength="2" class="form-control credit-card" maxlength="220" placeholder=""  required>
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
                                                <input type="text" name="prenom" value="" class="form-control credit-card" maxlength="220" placeholder="" required>
                                            </div>
                                        </div>
                                </div>
								
								
				</div>
				
				<div class="row clearfix">
								
								<div class="col-md-4">
                                        <b>Photo *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="file" name="photo" value=""  minlength="2" class="form-control credit-card" maxlength="220" placeholder=""  required>
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
                                                <input type="text" name="poste" value="" maxlength="220" required class="form-control email" placeholder="">
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
                                                <input type="text" name="objectif" style="text-align:" min="0" maxlength="220" value="" class="form-control credit-card" placeholder="" >
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
                                                <input type="text" name="contact" style="text-align:" maxlength="220" value="" class="form-control credit-card" placeholder="" required>
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4">
                                        <b>Adresse électronique *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="email" name="email" style="text-align:" required maxlength="220" value="" class="form-control credit-card" placeholder="" >
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
                                                <input type="text" name="societe_nom" value="" maxlength="220" class="form-control email" placeholder="" required>
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
                                                <input type="number" name="societe_capital" value="" maxlength="220" class="form-control email" placeholder="" required>
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
                                                <input type="text" name="societe_rcc" value="" maxlength="220" class="form-control email" placeholder="" required>
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
                                                <input type="number" name="societe_telephone" value="" class="form-control credit-card" maxlength="100" placeholder="" required>
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
                                                <input type="text" name="societe_adresse" value="" style="text-align:" maxlength="100"  class="form-control credit-card" placeholder="" >
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
                                                <input type="text" name="societe_raison" style="text-align:" maxlength="220" value="" class="form-control credit-card " placeholder="" >
                                            </div>
                                        </div>
                                </div>
								
								
								
							</div>
							

							<br/><br/>
							<h5 class="col-pink">Destinataire email</h5>
							<hr/>
							
							<div class="row clearfix">
								<div class="col-md-4">
                                        <b>Email destinataire *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="email" name="mail_destinateur" value="" required class="form-control credit-card" maxlength="100" placeholder="" required>
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
                                                <input type="email" name="mail_destinateur_copy1" required value="" style="text-align:" maxlength="100"  class="form-control credit-card" placeholder="" >
                                            </div>
                                        </div>
                                </div>
								
								<div class="col-md-4 hidden-xs">
                                        <b>Email copie 2</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="email" name="mail_destinateur_copy2" style="text-align:" maxlength="220" value="" class="form-control credit-card" placeholder="" >
                                            </div>
                                        </div>
                                </div>
								
								
							</div>
							
							<br/><br/>
							<h5 class="col-pink">Privilège de l'utilisateur</h5>
							<hr/>
							
							<div class="row clearfix">
							<div class="col-md-4">
									<b>Privilèges</b><br/><br/>
									<div class="checkbox-group">
									<input type="checkbox" id="md_checkbox_1" name="modification" value="1" class="chk-col-red" checked />
									<label for="md_checkbox_1">Modification</label> &nbsp;  &nbsp;  &nbsp;
									<input type="checkbox" id="md_checkbox_2" value="1" name="suppression" class="chk-col-pink" checked /> 
									<label for="md_checkbox_2">Suppression</label> &nbsp;  &nbsp;  &nbsp;
									<input type="checkbox" id="md_checkbox_3" value="1" name="etat" class="chk-col-pink" />
									<label for="md_checkbox_3">Non actif</label>
									</div>
								</div>
							</div>
							
							
							
							
				 {!! Form::submit('Ajouter', ['class' => 'btn bg-blue', 'style' => 'width:100px']) !!}
{!! Form::close() !!}				
			</div>
        </div>
	
	</div>
</div>
</section>
	
	
	



@endsection	