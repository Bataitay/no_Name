<?php

namespace App\Http\Livewire;

use App\Models\Messager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Messages extends Component
{
    public $sender;

    public $users;
    public $status;
    public $messager;

    public $allmessages;

    use WithFileUploads;

    public $photos = [];

    public function render()
    {
        $this->users = User::all();
        $sender = $this->sender;
        $this->allmessages;
        $userMgs = User::all();
        $currentusers = Auth::user()->id;
        $userMgs = $userMgs->except([$currentusers]);
        $userMgs = $userMgs->first();
        return view('Backend.livewire.messages', [
            'users' => $this->users,
            'sender' => $sender,
            'userMgs' => $userMgs,
            //  'allmessages' => $this->allmessages,
        ]);
    }

    public function mountdata()
    {
        if (isset($this->sender->id)) {
            $this->allmessages = Messager::where('user_id', auth()->id())->where('receiver_id', $this->sender->id)
                ->orWhere('user_id', $this->sender->id)->where('receiver_id', auth()->id())->orderBy('id', 'DESC')->get();
            $notseen = Messager::where('user_id', $this->sender->id)->where('receiver_id', auth()->id());

            if ($notseen->update(['is_seen' => true])) {
                $readed = 'đã xem';

                return view('Backend.livewire.messages', compact('readed'));
            }
        }
    }

    public function restForm()
    {
        $this->messager = '';
    }

    public function SendMessage()
    {
        $this->validate(
            ['messager' => 'required'],
            [
                'messager.required' => '',
            ],
        );

        // Execution doesn't reach here if validation fails.

        $data = new Messager;
        $data->messager = $this->messager;
        $data->status = $this->status;
        $data->user_id = auth()->id();
        $data->receiver_id = $this->sender->id;
        $data->save();
        $this->restForm();
    }

    public function getUser($id)
    {
        $user = User::find($id);
        $this->sender = $user;
        $this->allmessages = Messager::all();
        $this->allmessages = Messager::where('user_id', auth()->id())->where('receiver_id', $id)
            ->orWhere('user_id', $id)->where('receiver_id', auth()->id())->orderBy('id', 'DESC')->get();
    }

    public function recallMessage($id)
    {
        $data = Messager::findOrFail($id);
        $this->status = $data->status;
        if (Auth::user()->id == $data->user_id) {
            Messager::find($id)->update([
                'messager' => 'Tin nhắn đã được thu hồi',
                'status' => '1',
            ]);
        } else {
            '';
        }
    }
    public function deleteMessage($id)
    {
        Messager::find($id)->delete();
    }
}
