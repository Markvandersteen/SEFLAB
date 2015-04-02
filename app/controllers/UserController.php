<?php
use Seflab\Repository\Virtual\VirtualRepository;
use Seflab\Repository\Report\ReportRepository;

/**
 * Class UserController
 */
class UserController extends BaseController
{

    /**
     * @var Seflab\Repository\Virtual\VirtualRepository
     */
    protected $virtualRepo;
    /**
     * @var Seflab\Repository\Report\ReportRepository
     */
    protected $reportRepo;

    /**
     * @param VirtualRepository $virtualRepo
     * @param ReportRepository $reportRepo
     */
    public function __construct(VirtualRepository $virtualRepo, ReportRepository $reportRepo)
    {
        $this->virtualRepo = $virtualRepo;
        $this->reportRepo = $reportRepo;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogout()
    {
        Auth::logout();
        return Redirect::to('login');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function makeDashboard()
    {
        $userId = Auth::user()->id;
        $latestVm = $this->virtualRepo->getLatestVirtualMachine($userId);
        $topThreeResult = $this->reportRepo->findTopThreeByUserId($userId);
        return View::make('admin.dashboard', ['latestVm' => $latestVm], ['topThreeResult' => $topThreeResult]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function makeRegister()
    {
        return View::make('register');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function makeCredentials()
    {
        return View::make('credentials');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogin()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'username' => 'required',
            'password' => 'required'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'username' => Input::get('username'),
                'password' => Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                return Redirect::to('dashboard');

            } else {

                // validation not successful, send back to form
                return Redirect::to('login');

            }
        }
    }

    /**
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
        $user = Auth::getUser();
        return View::make('user_profile', compact('user'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doEditProfile()
    {
        $input = Input::all();
        //Creates a new validator and sets requirements
        $validator = Validator::make($input, array(
                'password1' => 'sometimes|min:5',
                'password2' => 'required_with:password1|same:password1',
                'email' => 'required',
                'first_name' => 'required',
                'last_name' => 'required'
            )
        );

        // When it fails...
        if ($validator->fails()) {
            return Redirect::to('profile')
                ->withErrors($validator)
                ->withInput(Input::except('password1', 'password2'));
        } else { // When it succeeds...
            $user = Auth::getUser();

            // Ensure password will be hashed...
            if (!empty($input['password1'])) $user->password = Hash::make($input['password1']);

            // Fill the model with request data and save it
            $user->email = $input['email'];
            $user->first_name = $input['first_name'];
            $user->last_name = $input['last_name'];
            $user->company = $input['company'];
            $user->phone = $input['phone'];
            $user->save();
            return Redirect::to('profile')->with('success', true);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doDelete()
    {
        $user = Auth::getUser();
        $user->delete();
        return Redirect::to('login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doCreateUser()
    {
        //Sets the input in an Array
        $input = Input::only('username', 'password1', 'password2',
            'email', 'firstname', 'lastname', 'company', 'phone');
        $user = new User;


        //Creates a new validator and sets requirements
        $validator = Validator::make($input, array(
                'username' => 'required',
                'password1' => 'required|min:5',
                'password2' => 'required|min:5',
                'email' => 'required',
                'firstname' => 'required',
                'lastname' => 'required'
            )
        );

        //Checks if the validator had failed, if not.
        //It linked the data to the model and saves it.
        if ($validator->fails()) {
            return Redirect::to('register')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } elseif ($input['password1'] == $input['password2']) {
            $user->username = $input['username'];
            $user->password = Hash::make($input['password1']);
            $user->email = $input['email'];
            $user->first_name = $input['firstname'];
            $user->last_name = $input['lastname'];
            $user->save();
            return Redirect::to('login');
        }
    }


}

