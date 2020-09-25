@extends('includes.app')

@section('title', 'Lojinha')
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

    </script>
    <div style="font-family: Quicksand; font-size: 4rem; margin: 12px">
        Adicionar produto:
        <form style="font-size: 2rem" action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nome do Produto</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="Nome do Produto" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Preço do Produto</label>
                    <input type="text" class="form-control" id="inputPassword4"
                        placeholder="Digite o preço do produto, separando por '.' Ex.: 4.50" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlTextarea1">Descrição do Produto</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none"
                        required></textarea>
                </div>
            </div>
            <div class="form-group" style="font-size: 2vw">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <button type="submit" class="btn btn-primary">Adicionar produto</button>
        </form>
    </div>
