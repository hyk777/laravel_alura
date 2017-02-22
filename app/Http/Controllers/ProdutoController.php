<?php namespace estoque\Http\Controllers;
	
	//importa a classe DB
	use Illuminate\Support\Facades\DB;
	use Request;
	use estoque\Http\Requests\ProdutosRequest;
	use estoque\Produto;
	use estoque\Categoria;

	class ProdutoController extends Controller{

		public function lista(){

			$produtos = Produto::all();
        	return view('produto.listagem')->with('produtos', $produtos);

		}

		public function listaJson(){
		   $produtos = Produto::all();
		    return response()->json($produtos);
		}

		public function mostra($id){

			//$id = Request::route('id');
			//$resposta = DB::select('select * from produtos where id = ?', [$id]);
			//dd($resposta);
			$produto = Produto::find($id);

        	if(empty($produto)) {
			    return "Esse produto não existe";
			 }
        	return view('produto.detalhes')->with('produto', $produto);

		}

		public function remove($id){
			$produto = Produto::find($id);
			$produto->delete();
    		
    		return redirect()->action('ProdutoController@lista');

		}

		public function novo(){
			return view('produto.formulario')->with('categorias', Categoria::all());
		}

		public function adiciona(ProdutosRequest $request){
			
			/*$nome = Request::input('nome');
			$descricao = Request::input('descricao');
			$valor = Request::input('valor');
			$quantidade = Request::input('quantidade');
			DB::insert('insert into produtos values (null, ?, ?, ?, ?)', array($nome, $valor, $descricao, $quantidade));
			return implode( ', ', array($nome, $descricao, $valor, $quantidade));
			*/
			Produto::create($request->all());
			return redirect()
				->action('ProdutoController@lista')
				->withInput(Request::only('nome'));
		}

		
	}