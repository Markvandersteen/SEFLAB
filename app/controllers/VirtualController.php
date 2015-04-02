<?php

use Seflab\Repository\LoadScript\LoadScriptRepository;

/**
 * Class VirtualController
 */
class VirtualController extends BaseController
{
    /**
     * The absolute path where uploads are stored for file operations
     * @var string
     */
    protected $absolutePath;
    /**
     * Relative upload path which is used in data persistence
     * @var string
     */
    protected $relativePath;

    /**
     * @var Seflab\Repository\LoadScript\LoadScriptRepository
     */
    protected $loadScriptRepo;

    /**
     * @param LoadScriptRepository $loadScriptRepo
     */
    public function __construct(LoadScriptRepository $loadScriptRepo)
    {
        $this->loadScriptRepo = $loadScriptRepo;
        $this->relativePath = 'upload/';
        $this->absolutePath = base_path() . '/' . $this->relativePath . '/';
    }

    /**
     * @return \Illuminate\View\View
     */
    public function makeUpload()
    {
        return View::make('upload');
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function doUpload()
    {
        $vmFile = Input::file('vm');
        $loadScript = Input::file('script');
        $vm_description = Input::get('vm_description');
        $random = rand();

        if (!empty($vmFile) && !empty($loadScript)) {

            //Retrieving the id of the user
            $id = Auth::getUser()->id;


            //Creating an instance of the classes.
            $virtualMachine = new VirtualMachine;
            $loadScript = new LoadScript;

            //Retrieving data of the virtualMachine file
            $vmFileName = $vmFile->getClientOriginalName();
            $vmSize = Input::file('vm')->getSize();
            $vmFileExtension = $this->checkExtension($vmFileName, "ova");

            //Retrieving data of the Script file
            $loadScriptFileName = Input::file('script')->getClientOriginalName();
            $scriptSize = Input::file('script')->getSize();
            $scriptFileExtension = $this->checkExtension($loadScriptFileName, "sh");

            $destinationPath = $this->absolutePath;

            //Mapping model to data
            $vmHash = $this->hash($vmFileName) . ".ova";
            $virtualMachine->file_path = $this->relativePath . $vmHash;

            //Hashing the file name and creating a random to make the file name unique for each user.
            $virtualMachine->file_name = $vmFileName;
            $virtualMachine->file_size = $vmSize;
            $virtualMachine->vm_description = $vm_description;
            $virtualMachine->user_id = $id;

            //Mapping model to data
            $loadScriptHash = $this->hash($loadScriptFileName) . ".sh";
            $loadScript->file_path = $this->relativePath . $loadScriptHash;

            //Hashing the file name and creating a random to make the file name unique for each user.
            $loadScript->file_name = $loadScriptFileName;
            $loadScript->file_size = $scriptSize;

            // Moves the file to /Upload
            if ($vmFileExtension == true && $scriptFileExtension == true) {
                $vmUpload_succes = Input::file('vm')->move($destinationPath, $vmHash);
                $loadScriptUpload_succes = Input::file('script')->move($destinationPath, $loadScriptHash);

                //Checks if the upload was a succes.
                if ($vmUpload_succes and $loadScriptUpload_succes) {
                    //saves the data of both uploads in the database.
                    $virtualMachine->save();
                    $loadScript->virtualMachine_id = $virtualMachine->id;
                    $loadScript->save();


                    if (Request::ajax()) {
                        return Response::json(['message' => 'Bestand is geupload.', 'success' => true]);
                    } else {
                        return Redirect::route('vms-overview');
                    }
                }
            } else {
                $msg = 'De bestanden hebben een verkeerd formaat. .OVA voor virtualmachine en .SH voor het loadscript.';

                if (Request::ajax()) {
                    return Response::json(['message' => $msg, 'success' => false]);
                } else {
                    return Redirect::to('upload')
                        ->withErrors($msg);
                }
            }
        } else {
            $msg = "Er is maar één of geen bestand geselecteerd.";

            if (Request::ajax()) {
                return Response::json(['message' => $msg, 'succes' => false]);
            } else {
                return Redirect::to('upload')
                    ->withErrors($msg);

            }
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doDeleteLoadscript($id)
    {
        $this->loadScriptRepo->remove($id);
        return Redirect::to(URL::previous());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doDeleteVirtualMachine($id)
    {
        $virtualMachine = VirtualMachine::find($id);
        $virtualMachine->delete();

        return Redirect::to(URL::route('vms-overview'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doUploadLoadScript()
    {
        // Get posted request data
        $virtualmachineId = Input::get('virtualmachine_id');
        $file = Input::file('file');

        // Get and manipulate file info from requested data
        $filename = $file->getClientOriginalName();
        $loadScriptHash = $this->hash($filename) . ".sh";
        $loadScriptFileExtension = $this->checkExtension($filename, "sh");
        $filesize = $file->getSize();

        if ($loadScriptFileExtension) {
            // Check whether the file has been moved to the upload folder successfully,
            // This should never go wrong, but may it go wrong atleast it will be logged.
            $success = $file->move($this->absolutePath, $loadScriptHash);
            if ($success) {
                $loadScript = $this->loadScriptRepo->add(
                    $virtualmachineId,
                    $filename,
                    $this->relativePath . $loadScriptHash,
                    $filesize
                );
                return Redirect::to(URL::previous());
            }

        } else {
            return Redirect::to(URL::previous())->withErrors('Het bestand moet een .SH bestand zijn.');
        }

    }

    /**
     * @return \Illuminate\View\View
     */
    public function getOverview()
    {
        $user = Auth::getUser();
        $virtualMachines = VirtualMachine::where('user_id', $user->id)->get();

        return View::make('admin.overview_vms',
            ['virtualMachines' => $virtualMachines]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getVM($id)
    {
        $virtualMachine = VirtualMachine::with('loadScripts')->where('id', $id)->first();

        return View::make('admin.vm',
            ['virtualMachine' => $virtualMachine]);
    }


    /**
     * Generate a random hash to be used in file names
     *
     * @param $value
     * @return string
     */
    protected function hash($value)
    {
        return md5($value . "_" . rand() . "_" . time());
    }

    /**
     * Check if a filename has a certain extensions
     * Returns an integer but 0 is also 'false'
     *
     * @param $filename
     * @param $extension
     * @return int
     */
    protected function checkExtension($filename, $extension)
    {
        return strpos($filename, "." . $extension);
    }

}