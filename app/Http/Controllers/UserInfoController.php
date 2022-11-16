<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function indexMessage($message)
    {  
        try{
            $userInfo = DB::select('SELECT * FROM USER_INFOS');
        } catch (\Throwable $th){   
            return view("UserInfo/create")->with("userInfo", [])->with("message", [$th->getMessage(), "danger"]); 
        }        
        return view("UserInfo/create")->with("userInfo", $userInfo)->with("message", $message);       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("UserInfo/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loggedUserId = Auth::user()->id;
        try{
            $userInfo = new UserInfo();
            $userInfo->Users_id = $loggedUserId;
            $userInfo->status = 'A';
            $userInfo->profileImg = $request->profileImg;
            $userInfo->dataNasc = $request->dataNasc;
            $userInfo->genero = $request->genero;
            $userInfo->save();
        } catch (\Throwable $th){
            return $this->indexMessage([$th->getMessage(), "danger"]);
        }        
        return $this->indexMessage(["Informações do Usuário cadastradas com sucesso", "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $userInfo = UserInfo::where('Users_id', $id)->first();
            if(isset($userInfo)){
                return view("UserInfo/show")->with("userInfo", $userInfo);
            }
            return $this->indexMessage(["Informações do Usuário não encontradas", "warning"]);
        } catch (\Throwable $th){
            return $this->indexMessage([$th->getMessage(), "danger"]);
        } 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $userInfo = UserInfo::find($id); 
            if( isset($userInfo) ){
                return view("UserInfo/edit")->with("userInfo", $userInfo);
            }
            return $this->indexMessage(["Informações do Usuário não encontradas", "warning"]);

        } catch (\Throwable $th){
            return $this->indexMessage([$th->getMessage(), "danger"]);
        }   
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
        
        try{
            $loggedUserId = Auth::user()->id;
            $userInfo = UserInfo::find($id); 
            if( isset($userInfo) ){
                $userInfo->Users_id = $loggedUserId;
                $userInfo->status = 'A';
                $userInfo->profileImg = $request->profileImg;
                $userInfo->dataNasc = $request->dataNasc;
                $userInfo->genero = $request->genero;
                $userInfo->update();
                return $this->indexMessage(["Informações do Usuário atualizadas com sucesso", "success"]);
            }
            return $this->indexMessage(["Informações do Usuário não encontradas", "warning"]);
            
        } catch (\Throwable $th){
            return $this->indexMessage([$th->getMessage(), "danger"]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userInfo = UserInfo::find($id); 
        if( isset($userInfo) ) {
            $userInfo->delete();
            return \Redirect::route('userinfo.create');
        }
        else{
            echo "Informações do Usuário não encontradas";
        }
    }
}
