@extends('includes.app')

@section('title', 'Lojinha')
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">

    <div style="font-family: Quicksand; font-size: 4rem; margin: 12px">
        Adicionar produto:
        <form style="font-size: 2rem" action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nome do Produto</label>
                    <input type="text" class="form-control" name="nome_produto" placeholder="Nome do Produto" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Preço do Produto</label>
                    <input type="text" class="form-control" name="preco_produto"
                        placeholder="Digite o preço do produto, separando por '.' Ex.: 4.50" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlTextarea1">Descrição do Produto</label>
                    <textarea class="form-control" name="desc_produto" rows="3" style="resize: none" required></textarea>
                </div>
            </div>
            <div class="form-group" style="font-size: 2vw">
                <label for="exampleFormControlFile1">Imagem do produto</label>
                <input type="file" class="form-control-file" name="thumbnail_produto">
            </div>
            <button type="submit" class="btn btn-primary">Adicionar produto</button>
        </form>
    </div>
