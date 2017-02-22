@extends('layout/principal')

@section('conteudo')

@if(empty($produtos))

<div class="alert alert-danger">
  Você não tem nenhum produto cadastrado.
</div>

@else
<h1>Listagem de produtos com Laravel</h1>
<table class="table table-striped table-bordered table-hover">
	<tr>
		<td>Nome</td>
		<td>Descrição</td>
	</tr>
	@foreach($produtos as $p)
	<tr class = "{{$p->quantidade <= 1 ? 'danger' : ''}}">
		<td>{{$p->nome}}</td>
		<td>{{$p->descricao}}</td>
		<td>{{$p->quantidade}}</td>
		<td> {{ $p->tamanho }}</td>
		<td> {{ $p->categoria->nome }}</td>
		<td><a href = '/produtos/mostra/<?= $p->id?>'> <span class="glyphicon glyphicon-search"> </span></a></td>
		<td> <a href="{{action('ProdutoController@remove', $p->id)}}"><span class="glyphicon glyphicon-trash"></span></a></td>
	</tr>
	@endforeach
</table>
@endif
<h4>
  <span class="label label-danger pull-right">
    Um ou menos itens no estoque
  </span>
 </h4>
 @if(old('nome'))
Produto {{old('nome')}} adicionado com sucesso !!!	
 @endif

@stop