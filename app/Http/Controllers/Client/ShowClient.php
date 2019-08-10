<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Currency\Currency;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\V1\User\UserRequest;
use App\Http\Controllers\MainController;
use App\Http\Requests\V1\Ticket\TicketRequest;
use App\Http\Requests\V1\Ticket\TicketMessageRequest;
use App\Models\Ticket\Ticket;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\V1\BankCard\BankCardRequest;
use App\Models\Bank\BankCard;
use App\Http\Requests\V1\User\ProfileRequest;
use App\Http\Requests\V1\User\ImageProfileRequest;

class ShowClient extends MainController
{
    /**
     * Instantiate a new MainController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        // 'show'  => 'panel.user-show',
        // 'form'  => 'panel.add-user',
    ];

    /**
     * Name of the field that should upload an image from that
     *
     * @var string
     */
    protected $image_field = 'avatar';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::search( request('query') )->latest()->paginate(20);

        return view('client.client-currency', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tickets = \auth::user()->tickets()->latest()->paginate(10);
        return view('client.client-ticket' , compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTicket(TicketRequest $request)
    {
        auth()->user()->tickets()->create($request->all());

        return redirect()->back()->with('message', "تیکت  {$request->title} با موفقیت ثبت شد");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBankCard(BankCardRequest $request)
    {
        auth()->user()->bankCard()->create( array_merge( $request->all(), [
            'image_bank_card' => $this->upload_image( Input::file('image_bank_card') )
            ]));

        return redirect()->back()->with('message', "  دیتا مورد نظر با موفقیت ثبت شد");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTicketMessage(TicketMessageRequest $request)
    {
        auth()->user()->ticketmessages()->create( 
              Input::file('image')
            ? array_merge( $request->all(), [
                'image' => $this->upload_image( Input::file('image') )
            ])
            : $request->all()
         );

        return redirect()->back()->with('message', "تیکت  {$request->title} با موفقیت ثبت شد");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editTicket(Ticket $ticket)
    {
        $ticket->load([
            'ticketmessages' => function($query) {
                return $query->orderBy('created_at', 'DESC')->paginate(10);
            },
            'ticketmessages.user'
        ]);

        return view('client.client-ticketMessage', [
            'ticket' => $ticket,
        ]);
    }

    /**
     * Get the $request & $data,
     * then Update the $data in storage.
     *
     * @param  Request  $request
     * @param  Model $data
     * @return JSON\Array
     */
    public function update(Request $request, $data)
    {
        $request->validate( (new $this->request)->rules() );
        
        $this->updateData( $request, $data = $this->getModel($data) );
        
        return redirect(route("{$this->type}.index"))->with('message', "با موفقیت بروزرسانی شد");
    }

    public function profile_setting()
    {
        $user = Auth::user();
        $bank_cards = $user->bankCard()->get();
        return view('client.profile', compact('user', 'bank_cards'));
    }

    /**
     * Get the $request & $data,
     * then Update the $data in storage.
     *
     * @param  Request  $request
     * @param  Model $data
     * @return JSON\Array
     */
    public function updateProfile(ProfileRequest $request, User $user)
    {
        // dd($request);
        if ( !$request->hasFile('avatar') )
            $user->update(array_merge( $request->except(['roles']) ));
            
        else {
            if ( $user->avatar && file_exists( public_path($user->avatar) ) )
                unlink( public_path($user->avatar) );

            $user->update(array_merge( $request->except(['roles']), [
                'avatar' => $this->upload_image( Input::file('avatar') )
            ] ));
        }

        return redirect()->back()->with('message', "با موفقیت بروز رسانی شد");
    }


    public function updateImageProfile(ImageProfileRequest $request, User $user) 
    {
        if ( !$request->hasFile($request->type) )
            $user->update(array_merge( $request->except(['roles']) ));
            
        else {
            if ( $user->accept_{$request->type} == false && file_exists( public_path( $user->{$request->type} ) ))
                unlink( public_path($user->{$request->type}) );

            $user->update(array_merge( $request->except(['roles']), [
                $request->type => $this->upload_image( Input::file($request->type) )
            ] ));
        }
        return redirect()->back()->with('message', "با موفقیت بروز رسانی شد");
    }

    public function updateImageBankCard( BankCardRequest $request, BankCard $bankCard )
    {
        if ($request->hasFile('image_bank_card'))
        {
            if ( $bankCard->image_bank_card && file_exists( public_path($bankCard->image_bank_card) ) )
                 unlink( public_path($bankCard->image_bank_card) );
        }

        $bankCard->update(array_merge( $request->only(['image_bank_card']), [
            'image_bank_card' => $this->upload_image( Input::file('image_bank_card') )
            ] ));

        return redirect()->back()->with('message', "با موفقیت بروز رسانی شد");
    }
}
