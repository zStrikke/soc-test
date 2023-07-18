<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;


class UserService
{

    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'type' => $data['type'],
            'password' => $data['password']
        ]);

        if($data['type'] === config('constants.personnel.types.ADMINISTRATOR')) {
            $user->profile()->create([
                'start_date' => $data['start_date'],
            ]);
        }

        elseif($data['type'] === config('constants.personnel.types.JOURNALIST')) {
            $user->profile()->create([
                'company_name' => $data['company_name'],
            ]);
        }

        elseif($data['type'] === config('constants.personnel.types.JUDGE')) {
            $user->profile()->create([
                'judge_id' => $data['judge_id'],
            ]);
        }

        elseif($data['type'] === config('constants.personnel.types.PARTICIPANT')) {
            $user->profile()->create([
                'birth_date' => $data['birth_date'],
                'result' => $data['result'],
            ]);
        }

        return $user;
    }

    public function update(User $user, array $data)
    {
        $user->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'type' => $data['type'],
            'password' => $data['password']
        ]);

        if($user->type === config('constants.personnel.types.ADMINISTRATOR')) {
            $user->profile()->update([
                'start_date' => $data['start_date'],
            ]);
        }

        elseif($data['type'] === config('constants.personnel.types.JOURNALIST')) {
            $user->profile()->update([
                'company_name' => $data['company_name'],
            ]);
        }

        elseif($data['type'] === config('constants.personnel.types.JUDGE')) {
            $user->profile()->update([
                'judge_id' => $data['judge_id'],
            ]);
        }

        elseif($data['type'] === config('constants.personnel.types.PARTICIPANT')) {
            $user->profile()->update([
                'birth_date' => $data['birth_date'],
                'result' => $data['result'],
            ]);
        }

        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();

        return true;
    }

    public function storeResults(User $user, array $result)
    {
        $user->profile()->update(
            $result
        );

        return $user;
    }
    
}