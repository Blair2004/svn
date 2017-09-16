<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Requests;
use App\Software;

class SvnController extends Controller
{
    public function app( $namespace ) 
    {
        if( request()->get( 'licence' ) ) {
            $licence        =   json_decode( Requests::get(
                'https://marketplace.envato.com/api/edge/blair_jersyer/5gpszcw93ufutpqb0q8ors1v9znclaf4/verify-purchase:' . request()->get( 'licence' ) . '.json',
                [ 'Accept' => 'application/json' ]
            )->body, true );

            if( count( $licence[ 'verify-purchase' ] ) == 0 ) {
                return response([
                    'message'   =>  'Invalid Licence.',
                    'status'    =>  'failed',
                ], 403 );
            }

            $releases       =   [];

            if( $software   =   Software::where( 'namespace', $namespace )->first() ) {
                if( $software->toArray() ) {
                    if( count( $software->releases ) == 0 ) {
                        return response([
                            'message'   =>  'Incorrect App Data.',
                            'status'    =>  'failed',
                        ], 403 );
                    }

                    foreach( $software->releases as $release ) {
                    }
                    
                    $releases[]     =   $software;
                    return $releases;
                }
                
            }
            return response([
                'message'   =>  'unknow app.',
                'status'    =>  'failed',
            ], 404 );
            
        }
        return response([
            'message'   =>  'Licence is missing.',
            'status'    =>  'failed',
        ], 401 );
        
    }
}
