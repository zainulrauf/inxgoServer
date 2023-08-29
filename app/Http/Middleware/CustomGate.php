<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Models\UserMaster\Token;
class CustomGate
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
        $headers=$request->headers->all();
        if(isset($headers['content-type'][0]))
        {
            $header=$headers['content-type'][0];
            $header=explode('token=',$header);
            if(isset($header[1]))
            {
                $header=$header[1];
                $check=Token::where('custom',$header)->pluck('laravel')->first();
                if($check)
                {
                    // $response = $next($request);
                    // $response->headers->set('Authorization', 'Bearer '.$check);
                    // return $response;
                    return $next($request);
                }
            }

        } 
        return redirect('/notAcess'); 
    }
}
