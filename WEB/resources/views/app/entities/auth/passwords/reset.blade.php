@extends('app')

@section('css')
<style>
	.reset-password {
		padding-top: 33vh;
		padding-bottom: 33vh;
	}

	.btn-reset {
		border-color: #c8c7c7;
		background-color: $orange-color;
		color: black !important;
		margin: 0 !important;
		width: 100%;
	}
</style>
@endsection

@section('content')
<div class="container reset-password">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Réinitialiser votre mot de passe
				</div>

				<div class="card-body">
					<form class="form ng-untouched ng-pristine ng-invalid ng-star-inserted" action="{{ action('Auth\ResetPasswordController@confirmResetPassword', $token) }}" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<input class="login-input form-control mb-2 ng-untouched ng-pristine ng-invalid" name="password" placeholder="Mot de passe" required="" type="password">
						</div>
						<div class="form-group">
							<input class="login-input form-control mb-2 ng-untouched ng-pristine ng-invalid" name="password_confirmation" placeholder="Confirmer votre mot de passe" required="" type="password">
						</div>
				</div>
				<button class="btn btn-full-width m-0 btn-reset">Réinitialiser votre mot de passe</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
