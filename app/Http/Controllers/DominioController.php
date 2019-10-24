<?php namespace junshin\Http\Controllers;

class DominioController  extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'nosso-middleware'
        );
    }

    public function mostra()
    {
        if (view()->exists('dominio.dominios')) {
            return view('dominio.dominios');
        }
    }
}