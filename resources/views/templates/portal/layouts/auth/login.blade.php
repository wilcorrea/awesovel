@extends('awesovel.templates.portal.layouts.auth.index')

@section('auth')

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading brand-mark">Entrar</div>
            <div class="panel-body">

                @include('awesovel.templates.portal.layouts.auth.error')

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-4 control-label">CPF</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email"
                                   value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Data de Nascimento</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Lembrar
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Entrar</button>

{{--                            <a class="btn btn-link" href="{{ url('/password/email') }}">Esqueceu a senha?</a>--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
