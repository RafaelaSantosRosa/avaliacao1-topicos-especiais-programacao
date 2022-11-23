@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="#" class="btn btin-primary">Gerenciar Pedidos</a>
        <a href="{{route("produto.index")}}" class="btn btin-primary">Gerenciar Produtos</a>
        <a href="{{route("tipoproduto.index")}}" class="btn btin-primary">Gerenciar Tipo Produtos</a>
        <a href="{{route("endereco.index")}}" class="btn btn-primary">Gerenciar Endereços</a>
    </div>
@endsection