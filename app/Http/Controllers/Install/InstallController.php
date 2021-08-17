<?php

namespace App\Http\Controllers\Install;

use App\Http\Controllers\Controller;
use App\Model\Organization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use URL;

class InstallController extends Controller
{
    public function welcome()
    {
        $this->overWriteEnvFile('APP_URL', URL::to('/'));
        return view('install.welcome');
    }

    // permission
    public function permission()
    {
        $permission['curl_enabled'] = function_exists('curl_version');
        $permission['db_file_write_perm'] = is_writable(base_path('.env'));
        $permission['routes_file_write_perm'] = is_writable(base_path('app/Providers/RouteServiceProvider.php'));
        return view('install.permission', compact('permission'));
    }
    // create
    public function create()
    {

        return view('install.setup');
    }

    //save database information in env file
    //here the get database key or data for env file
    // clear cache
    public function dbStore(Request $request)
    {
        foreach ($request->types as $type) {
            //here the get database key or data for env file
            $this->overWriteEnvFile($type, $request[$type]);
        }
        return redirect()->route('check.db');

    }

    // checkDbConnencion
    public function checkDbConnencion()
    {
        try {
            //check the database connection for import the sql file
            DB::connection()->getPdo();

            return redirect()->route('sql.setup')->with('success', translate('Your Database Connection Is Successfully Done'));
        } catch (\Exception $e) {
            return redirect()->route('sql.setup')->with('wrong', translate('Could not connect to the database.  Please check your configuration'));

        }
    }

    //save information in env file
    public function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"' . trim($val) . '"';
            if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                file_put_contents($path, str_replace($type . '="' . env($type) . '"', $type . '=' . $val, file_get_contents($path)));
            } else {
                file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
            }
        }
    }

    //import sql page
    public function importSql()
    {
        return view('install.importSql');
    }

    //import the sql file in database or goto organization setup page
    public function orgCreate()
    {
        try {
            //import the sql file in database
            $sql_path = base_path('posdb.sql');
            DB::unprepared(file_get_contents($sql_path));
            return view('install.setupOrg');
        } catch (Exception $e) {
            die("There are some Problems  Please check your configuration. error:" . $e);
        }
    }

    //store the organization details in db
    public function orgSetup(Request $request)
    {
        try {
            //upload the site logo
            if ($request->hasFile('newLogo')) {
                //save the logo in storage
                $image = $request->file('newLogo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/org'), $imageName);
            } else {
                $imageName = $request->logo;
            }
            //update the Organization details
            //database have only on row for store  Organization details
            $org = Organization::where('id', 1)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'about' => $request->about,
                'header' => $request->header,
                'footer' => $request->footer,
                'logo' => $imageName,
                'symbol' => ' ' . $request->symbol . ' ',
                'align' => $request->align,
            ]);
            if ($org) {
                return redirect()->route('admin.create');
            } else {
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('failed', translate('There are Some Problem Try again '));
        }
    }

    //admin create page
    public function adminCreate()
    {
        return view('install.user');
    }

    //create a admin with full access
    //save and add the super access permission
    // replace the RouteService provider when installation is done
    //return the dashboard when all is done
    public function adminStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'unique:users'],
        ]);
        //create admin and hash password
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            //save and add the super access permission
            $user->assignGroup(1);
            $this->overWriteEnvFile('APP_INSTALL', 'YES');
            //return the dashboard when all is done
            return view('install.done');
        } else {
            return redirect()->back()->with('failed', translate('There are Some Problem Try again '));
        }
    }
}
