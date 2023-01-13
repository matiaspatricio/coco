<?php

namespace App\Http\Middleware;

use Closure;
use App\Library\SessionHelper;

class CheckBackend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $respuesta = false;

        if($request->session()->get('ingreso_backend') === TRUE)
        {
            $session_helper = new SessionHelper();
            $session_helper->actualiza_session_usuario($request);
        }

        $respuesta = $request->session()->get('ingreso_backend');

        if(!$respuesta)
        {
          return redirect('/backend');
        }
        
        return $next($request);
    }
}
