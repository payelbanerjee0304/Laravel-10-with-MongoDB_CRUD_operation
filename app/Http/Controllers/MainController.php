<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function insert():View
    {
        return view('form');
    }
    public function submit(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|regex:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/',
            'password'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'language'=>'required'
        ]);
        $name=$request->input('name');
        $email=$request->input('email');
        $password=md5($request->input('password'));
        $phone=$request->input('phone');
        $gender=$request->input('gender');
        $language=implode(', ',$request->input('language'));
        if($request->file('file'))
        $file=$request->file('file');
        $filename=time()."_".$file->getClientOriginalName();
        $uploadlocation="./upload";
        $file->move($uploadlocation,$filename);
        $user=DB::table('finalassessments')->where('email','=',$email)->get();
        if(empty($user[0]))
        {
            $data=[
                'name'=>$name,
                'email'=>$email,
                'password'=>$password,
                'phone'=>$phone,
                'gender'=>$gender,
                'language'=>$language,
                'image'=>$uploadlocation.'/'.$filename,
                'user'=>'client',
                'auth'=>0
            ];
            DB::table('finalassessments')->insert($data);
            return redirect('/login')->with('message','Inserted data successfully');
        }
        else
        {
            return redirect('/insert')->with('message','Email already exists');
        }
    }
    public function displayall():View
    {
        $user='client';
        $data=DB::table('finalassessments')->where('user','=',$user)->get();
        return view('displayall')->with(['allinfo'=>$data]);
    }
    public function displayclient($dc):View
    {
        $userid=$dc;
        $user=DB::table('finalassessments')->where('_id','=',$userid)->get();
        return view('displayclient')->with(['clientinfo'=>$user]);
    }
    public function login():View
    {
        return view('login');
    }
    public function save(Request $request)
    {
        $email=$request->input('email');
        $password=md5($request->input('password'));
        
        $user=DB::table('finalassessments')->where('email','=',$email)->get();
        // echo'<pre>';
        // print_r($user[0]);die;
        if(empty($user[0]))
        {
            return redirect('/login')->with('message','Data not found');
        }
        else
        {
            if($user[0]['password']==$password)
            {
                if($user[0]['auth']!=0)
                {
                    return redirect('/login')->with('message','You are blocked by admin');
                }
                else
                {
                    if($user[0]['user']=='client')
                    {
                        return view('displayclient')->with(['clientinfo'=>$user]);
                    }
                    else
                    {
                        
                        return redirect('/displayall');
                    }
                }
            }
            else
            {
                return redirect('/login')->with('message','Password doesnot match');
            }
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login')->with('message','Logout successfully');
    }
    public function edit($ep):View
    {
        $userid=$ep;
        $user=DB::table('finalassessments')->where('_id','=',$userid)->get();
        return view('edit')->with(['userinfo'=>$user[0]]);
    }
    public function update(Request $request)
    {
        $userid=$request->input('uid');
        $name=$request->input('name');
        $email=$request->input('email');
        $phone=$request->input('phone');
        $gender=$request->input('gender');
        $language=implode(', ',$request->input('language'));
        if($request->file('file')){
        $file=$request->file('file');
        $filename=time()."_".$file->getClientOriginalName();
        $uploadlocation="./upload";
        $file->move($uploadlocation,$filename);
        $data=[
                'name'=>$name,
                'email'=>$email,
                'phone'=>$phone,
                'gender'=>$gender,
                'language'=>$language,
                'image'=>$uploadlocation.'/'.$filename
            ];
        DB::table('finalassessments')->where('_id','=',$userid)->update($data);
        $user=DB::table('finalassessments')->where('_id','=',$userid)->get();
        return view('displayclient')->with(['clientinfo'=>$user]);
        }
        else
        {
            $data=[
                'name'=>$name,
                'email'=>$email,
                'phone'=>$phone,
                'gender'=>$gender,
                'language'=>$language
            ];
        DB::table('finalassessments')->where('_id','=',$userid)->update($data);
        $user=DB::table('finalassessments')->where('_id','=',$userid)->get();
        return view('displayclient')->with(['clientinfo'=>$user]);
        }
    }
    public function changepassword($cp):View
    {
        $userid=$cp;
        $user=DB::table('finalassessments')->where('_id','=',$userid)->get();
        return view('changepassword')->with(['passinfo'=>$user[0]]);
    }
    public function changepasswordaction(Request $request)
    {
        $userid=$request->input('uid');
        $oldp=md5($request->input('oldp'));
        $newp=md5($request->input('newp'));
        $confp=md5($request->input('confp'));
        $data=DB::table('finalassessments')->where('_id','=',$userid)->get();
        // echo'<pre>';
        // print_r($confp);die;
        if($data[0]['password']!=$oldp)
        {
            return redirect('/login')->with('message','Old password doesnot match');
        }
        else
        {
            if($oldp!=$newp)
            {
                if($newp==$confp)
                {
                    $data1=[
                        'password'=>$newp,
                    ];
                    DB::table('finalassessments')->where('_id','=',$userid)->update($data1);
                    return redirect('/login')->with('message','Password changed successfully');
                }
                else
                {
                    return redirect('/login')->with('message','New password and confirm password doesnot match');
                }
            }
            else
            {
                return redirect('/login')->with('message','Old password and new password are same');
            }
        }
    }
    public function block($blk)
    {
        $userid=$blk;
        // print_r($blk);die;
        DB::table('finalassessments')->where('_id','=',$userid)->update(['auth'=>1]);
        return redirect('/displayall')->with('message','User has been blocked');
    }
    public function unblock($ublk)
    {
        $userid=$ublk;
        DB::table('finalassessments')->where('_id','=',$userid)->update(['auth'=>0]);
        return redirect('/displayall')->with('message','User has been unblocked');
    }
    public function delete($del)
    {
        $userid=$del;
        DB::table('finalassessments')->where('_id','=',$userid)->delete();
        return redirect('/displayall')->with('message','User has been deleted');
    }
}
