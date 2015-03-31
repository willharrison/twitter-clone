<?php namespace Twitter\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Twitter\Alert;
use Twitter\Http\Requests;
use Twitter\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AlertController extends Controller {

    protected $me;

    public function __construct(Guard $auth)
    {
        $this->me = $auth->user();
    }

	public function read(Requests\AlertReadRequest $request)
	{
        // TODO refactor
        $alert = Alert::find($request->alert_id);
        $alert->read = 1;
        $alert->save();

        return response()->json([
            'success' => true,
            'data' => 'Alert has been read!',
            200
        ]);
	}

    public function readAll()
    {
        $alerts = Alert::where('user_id', $this->me->id)->get();

        foreach ($alerts as $alert)
        {
            $alert->read = 1;
            $alert->save();
        }

        return redirect()->back();
    }
}
