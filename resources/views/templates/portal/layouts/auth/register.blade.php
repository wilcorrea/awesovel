@extends('awesovel.templates.portal.layouts.auth.index')

@section('auth')

    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading brand-mark">Cadastro</div>
            <div class="panel-body">

                @include('awesovel.templates.portal.layouts.auth.error')

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-3 control-label">Nome*</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">CPF*</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Data de Nascimento*</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Telefone Fixo</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Telefone Celular</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="celular">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">E-mail</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="e-mail">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Endereço*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="address">
                        </div>
                        <label class="col-md-1 control-label">Numero*</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="number">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Bairro*</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="address">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Cidade*</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="city">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Cep*</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="zipcode">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Cadastrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
