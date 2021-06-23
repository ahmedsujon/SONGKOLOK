<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Helper\DeleteFile;

class EventController extends Controller
{
    use DeleteFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('created_at','desc')->EventWithAdminOwner()->get();
        //dd($events);
        return view('admin.event.manage',compact('events'));
    }

    public function allEvent()
    {
        $events = Event::orderBy('created_at','desc')->EventWithOutAdminOwner()->get();
        //dd($events);
        return view('admin.event.manage',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'event_name' => ['required', 'string', 'max:255'],
            'start_date'  => 'required',
            'end_date'    => 'required',
            'event_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $start_date = Carbon::parse($request['start_date'])->format('Y-m-d H:i:s');
        $end_date = Carbon::parse($request['end_date'])->format('Y-m-d H:i:s');
        $admin_id = Auth::guard('admin')->user()->id;

        $val['admin_id'] = $admin_id;
        $val['event_name'] = $request->event_name;
        $val['start_date'] = $start_date;
        //dd($val['start_date']);
        $val['end_date'] = $end_date;
        $val['status'] = $request->status;

        if($request->hasFile('event_image')){
            $image = request()->file('event_image');
            $val['event_image'] = $this->uploadImage($image, 'images');
        }

        if( Event::create($val) ) return redirect()->route('event.index')->with('success','Event Inserted Successfully');

        return redirect()->back()->with('error','Something went wrong ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Event $event)
    {
        $val = $request->validate([
            'event_name' => ['required', 'string', 'max:255'],
            'start_date'  => 'sometimes',
            'end_date'    => 'sometimes',
            'event_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required'
        ]);

        if ( $val['start_date'] != null )
            $val['start_date'] = Carbon::parse($request['start_date'])->format('Y-m-d H:i:s');
        else unset($val['start_date']);

        if( $val['end_date'] != null )
            $val['end_date'] = Carbon::parse($request['end_date'])->format('Y-m-d H:i:s');
        else unset($val['end_date']);

        $val['event_name'] = $request->event_name;

        $val['status'] = $request->status;

        if($request->hasFile('event_image')){
            $image = request()->file('event_image');
            $val['event_image'] = $this->uploadImage($image, 'images');
        }
        return ( $event->update($val) )?
            redirect()->route('event.index')->with('success', 'Edit Success'):
            redirect()->route('event.index')->with('error', 'Something went wrong') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Event $event)
    {
        self::deleteFile(storage_path('app/public/images/' . $event->event_image));

        $eventProducts = EventProduct::where('event_id', $event->id)->get();

        foreach($eventProducts as $pro)
            $pro->delete();

        $event->delete();
        return redirect()->back()->with('info','Event Successfully Deleted');
    }

    //status change
    public function change(Request $request)
    {
        if( self::changeStatus($request->status, Event::class, $request->id) )
            return redirect()->back()->with('success', 'Status Changes');
        return  redirect()->back()->with('error', 'Something went wrong');
    }
}
