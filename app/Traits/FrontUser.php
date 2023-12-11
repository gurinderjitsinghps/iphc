<?php
namespace App\Traits;

use App\Models\Category;
use App\Models\Submission;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;


trait FrontUser
{
   
    public function transactionCreate($data){
        $user_id = auth('frontuser')->id();
        $data = [  'front_user_id' => $user_id,
        'amount',
        'type',
        'type_id',
        'reference',];
        $subCreate= Transaction::create($data);
            return $subCreate;
    }

}
