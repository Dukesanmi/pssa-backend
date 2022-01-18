<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'chat_groups';

    protected $fillable = [
        'user_1_id', 'user_2_id', 'status', 'created_at', 'updated_at'
    ];

    public function findChatGroupId($inputs)
    {
        return $this
            ->select(
                'id'
            )
            ->where(function ($and) use ($inputs) {
                $and->where('user_1_id', '=', $inputs['user_1_id']);
                $and->where('user_2_id', '=', $inputs['user_2_id']);
            })
            ->orWhere(function ($and) use ($inputs) {
                $and->where('user_1_id', '=', $inputs['user_2_id']);
                $and->where('user_2_id', '=', $inputs['user_1_id']);
            });
    }

    public function findChatGroupIdOther($inputs)
    {
        return $this
            ->select(
                'id'
            )
            ->where(function ($and) use ($inputs) {
                $and->where('user_1_id', '=', $inputs['user_id']);
                $and->where('user_2_id', '=', $inputs['user_2_id']);
            })
            ->orWhere(function ($and) use ($inputs) {
                $and->where('user_1_id', '=', $inputs['user_2_id']);
                $and->where('user_2_id', '=', $inputs['user_id']);
            });
    }
}
