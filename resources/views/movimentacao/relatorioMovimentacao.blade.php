<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Movimentações</title>
</head>
<body>
  <h1>Movimentações</h1>
  <ul>
@forelse($movimentacao as $product)
  <li>{{ $product->movimentacao_data }} - {{ $product->movimentacao_valor }}</li>
@empty
  <li>Nenhuma movimentação cadastrada.</li>
@endforelse
        </ul>
</body>
</html>