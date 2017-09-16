<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubmitSoftwareRequest;
use App\Http\Requests\SubmitReleaseRequest;
use Illuminate\Support\Facades\Auth;
use App\Software;
use App\SoftwareRelease;
use Storage;

class SoftwareController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'auth' );
    }
    
    public function index()
    {
        $apps   =   Software::orderBy( 'updated_at', 'desc' )->paginate(10);
        return view( 'software.index', compact( 'apps' ) );
    }

    public function post()
    {
        return view( 'software.post');
    }

    public function postRelease()
    {
        $softwares   =   Software::orderBy( 'updated_at', 'desc' )->paginate(10);
        return view( 'software.post-release', compact( 'softwares' ) );
    }

    /**
     * Submit Application
     * @return void
    **/

    public function submit( SubmitSoftwareRequest $request )
    {
        $app                =   new \App\Software;
        $app->name          =   $request->input( 'name' );
        $app->description   =   $request->input( 'description' );
        $app->namespace     =   $request->input( 'namespace' );
        $app->author_id     =   Auth::id();
        $app->save();

        // register new release
        $release                =   new \App\SoftwareRelease;
        $release->software_id   =   $app->id;
        $release->version       =   $request->input( 'version' );
        $release->changelog     =   $request->input( 'changelog' );
        $release->file_path     =   Storage::disk( 'public' )->putFileAs( 
            'releases',  
            $request->file( 'release_file' ), 
            str_slug( $request->input( 'name' ) ) . '-' . $request->input( 'version' ) . '.zip'
        );
        
        $release->save();

        return redirect()->route( 'software.index' )->withResponse([
            'messages'          =>  __( 'The software has been saved.' ),
            'status'            =>  'success'
        ]);
    }

    public function submitRelease( SubmitReleaseRequest $request ) 
    {
        $app                =   Software::find( $request->input( 'software_id' ) )->first();

        if( $app ) {
            // latest release
            $release            =   SoftwareRelease::where( 'software_id', $app->id )->latest()->first();
            if( version_compare( $release->version, $request->input( 'version' ), '>=' ) ) {
                return back()->withErrors([
                    'version'           =>  __( 'That release is lower than the latest release.' ),
                    'status'            =>  'failed'
                ]);
            }

            // register new release
            $release                =   new SoftwareRelease;
            $release->software_id   =   $app->id;
            $release->version       =   $request->input( 'version' );
            $release->changelog     =   $request->input( 'changelog' );
            $release->file_path     =   Storage::disk( 'public' )->putFileAs( 
                'releases',  
                $request->file( 'release_file' ), 
                str_slug( $app->name ) . '-' . $request->input( 'version' ) . '.zip'
            );
            
            $release->save();

            return redirect()->route( 'software.index' )->withResponse([
                'messages'          =>  __( 'a new release has been published.' ),
                'status'            =>  'success'
            ]);
        }
        return redirect()->route( 'software.index' )->withErrors([
            'messages'          =>  __( 'Unknow software.' ),
            'status'            =>  'failed'
        ]);       
    }

    public function delete( $appid )
    {
        $software       =   Software::find( $appid );
        // delete release files first
        Storage::disk( 'public' )->delete( 
            array_pluck( $software->releases, 'file_path' ) 
        );

        Software::find( $appid )->delete();
        return redirect()->route( 'software.index' )->withResponse([
            'messages'          =>  __( 'The software has been deleted.' ),
            'status'            =>  'success'
        ]);
    }

    public function expose( $app ) 
    {
        $releases       =   [];
        if( $software   =   Software::find( $app ) ) {
            foreach( $software->releases as $release ) {
                $release->zip_ball   =   Storage::url( $release->file_path );
            }
            
            $releases[]     =   $software;
        }
        return $releases;
    }
}
