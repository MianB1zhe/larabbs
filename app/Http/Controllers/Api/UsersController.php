<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\User;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
    	$verifyData = \Cache::get($request->verification_key);

    	//验证验证码
    	if(!$verifyData){
    		return $this->response->error('验证码已失效',422);
    		//422提交参数错误
    	}

    	if(!hash_equals($verifyData['code'], $request->verification_code)){
    		//返回401
    		return $this->response->errorUnauthorized('验证码错误');
    		//401未授权
    	}

    	//创建用户
    	$user = User::create([
    		'name' => $request->name,
    		'phone' => $verifyData['phone'],
    		'password' => bcrypt($request->password),
    	]);

    	//清除验证码缓存
    	\Cache::forget($request->verification_key);

    	return $this->response->created();
    	//201成功创建
    }
}
