<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\UserRequest;
use App\User;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\V1\User\AcceptUserCertificate;
use App\Role;
use App\Http\Requests\V1\User\PasswordResetRequest;
use App\Http\Controllers\MainController;
use App\Mail\CloseTicketMail;
use App\Mail\AcceptOrReject;
use App\Http\Requests\V1\BankCard\AcceptBankCard;
use App\Models\Bank\BankCard;
use App\Models\Ticket\Ticket;

class UserController extends MainController
{
    /**
     * Type of this controller for use in messages
     *
     * @var string
     */
    protected $type = 'user';

    /**
     * The model of this controller
     *
     * @var Model
     */
    protected $model = User::class;

    /**
     * The request class for this controller
     *
     * @var Model
     */
    protected $request = UserRequest::class;

    /**
     * Name of the views that need by this controller
     *
     * @var string
     */
    protected $views = [
        'index' => 'panel.user',
        'show'  => 'panel.user-show',
        'form'  => 'panel.add-user',
    ];
    
    /**
     * Name of the field that should upload an logo from that
     *
     * @var string
     */
    protected $image_field = 'avatar';


    /**
     * Get all data of the model,
     * used by index method controller
     *
     * @return Collection
     */
    // public function getAllData()
    // {   
    //     $data = $this->model::search( request('query') )->latest();

    //     // this method for don't show users with they have role owner
    //     $data = $this->model::whereDoesntHave('roles', function($query) {
        
    //         return $query->where('name', 'owner');
    //     });
        
    //     return $data->paginate( $this->getPerPage() );
    // }

    public function afterUpdate($request, $data)
    {   
        //sync role for each user7
        $data->syncRoles( $request->input('roles', []) );
        if ( isset( $this->relations ) )
            $data->load( $this->relations );
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editPass(User $user)
    {
        return view('panel.password-reset', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request\V1\User\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePass(PasswordResetRequest $request, User $user)
    {
        if ( $request )
        {
            unset($request['password_confirmation']);
            $request['password'] = bcrypt($request['password']);
        }
        $user->update($request->all());

        return redirect(route('user.index'))->with('message', "رمز عبور کاربر  {$user->last_name} با موفقیت بروز رسانی شد");
    }

    /**
     * Accept the specified user from storage.
     *
     * @param  \Illuminate\Http\Request\V1\User\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function accept_certificate(AcceptUserCertificate $request, User $user)
    {
        if ( !$request->status )
        {
            if ( $user->{$request->type} && file_exists( public_path( $user->{$request->type} ) ) )
                unlink( public_path( $user->{$request->type} ) );
            // {
            //     if ( "accept_{$request->type}" === 'accept_image_national_code')
            //     {
            //         $type = 'کد ملی';
            //         \Mail::to( $user->email )->send(new AcceptOrReject( $type ));
            //     }

            //     if ( "accept_{$request->type}" === 'accept_identify_certificate')
            //     {
            //         $type = 'شناسنامه';
            //         \Mail::to( $user->email )->send(new AcceptOrReject( $type ));
            //     }

            //     if ( "accept_{$request->type}" === 'accept_image_bill')
            //     {
            //         $type = 'قبض';
            //         \Mail::to( $user->email )->send(new AcceptOrReject( $type ));
            //     }


            //     if ( "accept_{$request->type}" === 'accept_image_selfie_national_code')
            //     {
            //         $type = 'سلفی با کد ملی';
            //         \Mail::to( $user->email )->send(new AcceptOrReject( $type = 'سلفی با کد ملی' ));
            //     }

            // }

        }
        
        $user->{"accept_{$request->type}"} = $request->status;
        $user->save();
        
        return view('panel.user-show', [
            'user' => $user,
        ]);
    }

    /**
     * Accept the specified user from storage.
     *
     * @param  \Illuminate\Http\Request\V1\User\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function canBuy(User $user)
    {
        $user->update([ 'can_buy' => true ]);

        return redirect()->back()->with('message',  " با موفقیت به روز رسانی شد");
    }

    /**
     * Accept the specified user from storage.
     *
     * @param  \Illuminate\Http\Request\V1\User\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function accept_certificate_bank(AcceptBankCard $request, BankCard $bank_card, User $user)
    {
        if ( !$request->status )
        {
            if ( $bank_card->{$request->type} && file_exists( public_path( $bank_card->{$request->type} ) ) )
                unlink( public_path( $bank_card->{$request->type} ) );
            {
                if ( "accept_{$request->type}" === 'accept_image_bank_card')
                {
                    $type = 'کارت بانکی' . ' ' . $bank_card->bank_name;
                    // \Mail::to( $bank_card->user->email )->send(new AcceptOrReject( $type ));
                }
            }
        }
        
        $bank_card->{"accept_{$request->type}"} = $request->status;
        $bank_card->save();
        
        return redirect()->route('user.index')->with('message',  " با موفقیت به روز رسانی شد");
    }

    public function show_purchases(User $user)
    {
        $this->checkPermission("read-purchase");

        return view('panel.purchase', compact('user'));
    }

    /**
     * Remove the one or multiple groups from storage.
     *
     * @param  String $features
     * @return Array\JSON
     */
    public function destroy($data)
    {    
        $this->checkPermission("delete-{$this->type}");

        if ( request()->has('selected') )
        {
            $result = $this->model::whereIn('id', request()->selected)->delete();
            Ticket::where('user_id', request()->selected)->delete();
        }
            // if($result->ticket)
        else 
            $result = $this->model::where('id', $data)->delete();
            Ticket::where('user_id', $data)->delete();
        if ( $result )
            return redirect(route("{$this->type}.index"))->with('message', request()->has('selected') ? "موارد انتخاب شده با موفقیت حذف شد" : "با موفقیت حذف شد");
            
        else
            return redirect(route("{$this->type}.index"))->withErros(["متاسفانه هیچ داده ای یافت نشد"]);
    }
}
