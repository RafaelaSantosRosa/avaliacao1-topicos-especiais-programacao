@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="#" class="btn btin-primary">Gerenciar Pedidos</a>
                    <a href="{{route("produto.index")}}" class="btn btin-primary">Gerenciar Produtos</a>
                    <a href="{{route("tipoproduto.index")}}" class="btn btin-primary">Gerenciar Tipo Produtos</a>
                    <a href="{{route("endereco.index")}}" class="btn btn-primary">Gerenciar Endereços</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
