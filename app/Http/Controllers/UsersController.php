<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    protected $request;
    protected $repo;

    public function _construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->repo = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')->get();

        return view('loja.list', [
            'products' => $products,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //DELETE
        //Storage::disk('s3')->delete('product/', $path)
        //
        //Request para o arquivo
        $filecontent = $request->file('thumbnail_produto');

        $data = $request->except(
            ['_token',
            'thumbnail_produto',
            ]);

        //Pega o valor que o usuário colocou no campo "nome_produto"
        $thumbname = strtolower($request->nome_produto);

        //Montagem do nome da imagem
        $imageFileName = $thumbname . '.' . $filecontent->getClientOriginalExtension();

        //Instanciamento do Storage AWS
        $s3 = Storage::disk('s3');

        //Montagem do caminho da imagem
        $filePath = '/product/' . $imageFileName;
        $filePath2 = 'product/' . $imageFileName;
        $data['thumbnail_produto'] = strtolower(strval($filePath2));

        if($s3->exists($filePath))
            return 'Um arquivo com este nome já existe!';
        //Se não houver uma imagem com o mesmo nomem, POSTE!
        else{
            //Colocando dados
            Product::create($data);
            //Colocando imagem
            $s3->put($filePath, file_get_contents($filecontent), 'public');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function whatsapp(Request $request)
    {
        $request['datapedido_cliente'] = Carbon::now();
        $data = $request->except('_token');

        DB::table('orders')->insert($data);

        return 'PEDIDO ENVIADO?';
    }

}
