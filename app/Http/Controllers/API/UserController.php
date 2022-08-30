<?php

namespace App\Http\Controllers\API;

use App\Events\AddNotifications;
use App\Models\Notification;
use App\Models\User_notification;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Register
     */
    public  function mime2ext($mime_type) {
        // Original mapping from: https://github.com/bcit-ci/CodeIgniter/blob/develop/application/config/mimes.php
        $mapping = array(
            'hqx'	=>	array('application/mac-binhex40', 'application/mac-binhex', 'application/x-binhex40', 'application/x-mac-binhex40'),
            'cpt'	=>	'application/mac-compactpro',
            'csv'	=>	array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain'),
            'bin'	=>	array('application/macbinary', 'application/mac-binary', 'application/octet-stream', 'application/x-binary', 'application/x-macbinary'),
            'dms'	=>	'application/octet-stream',
            'lha'	=>	'application/octet-stream',
            'lzh'	=>	'application/octet-stream',
            'exe'	=>	array('application/octet-stream', 'application/x-msdownload'),
            'class'	=>	'application/octet-stream',
            'psd'	=>	array('application/x-photoshop', 'image/vnd.adobe.photoshop'),
            'so'	=>	'application/octet-stream',
            'sea'	=>	'application/octet-stream',
            'dll'	=>	'application/octet-stream',
            'oda'	=>	'application/oda',
            'pdf'	=>	array('application/pdf', 'application/force-download', 'application/x-download', 'binary/octet-stream'),
            'ai'	=>	array('application/pdf', 'application/postscript'),
            'eps'	=>	'application/postscript',
            'ps'	=>	'application/postscript',
            'smi'	=>	'application/smil',
            'smil'	=>	'application/smil',
            'mif'	=>	'application/vnd.mif',
            'xls'	=>	array('application/vnd.ms-excel', 'application/msexcel', 'application/x-msexcel', 'application/x-ms-excel', 'application/x-excel', 'application/x-dos_ms_excel', 'application/xls', 'application/x-xls', 'application/excel', 'application/download', 'application/vnd.ms-office', 'application/msword'),
            'ppt'	=>	array('application/powerpoint', 'application/vnd.ms-powerpoint', 'application/vnd.ms-office', 'application/msword'),
            'pptx'	=> 	array('application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/x-zip', 'application/zip'),
            'wbxml'	=>	'application/wbxml',
            'wmlc'	=>	'application/wmlc',
            'dcr'	=>	'application/x-director',
            'dir'	=>	'application/x-director',
            'dxr'	=>	'application/x-director',
            'dvi'	=>	'application/x-dvi',
            'gtar'	=>	'application/x-gtar',
            'gz'	=>	'application/x-gzip',
            'gzip'  =>	'application/x-gzip',
            'php'	=>	array('application/x-httpd-php', 'application/php', 'application/x-php', 'text/php', 'text/x-php', 'application/x-httpd-php-source'),
            'php4'	=>	'application/x-httpd-php',
            'php3'	=>	'application/x-httpd-php',
            'phtml'	=>	'application/x-httpd-php',
            'phps'	=>	'application/x-httpd-php-source',
            'js'	=>	array('application/x-javascript', 'text/plain'),
            'swf'	=>	'application/x-shockwave-flash',
            'sit'	=>	'application/x-stuffit',
            'tar'	=>	'application/x-tar',
            'tgz'	=>	array('application/x-tar', 'application/x-gzip-compressed'),
            'z'	=>	'application/x-compress',
            'xhtml'	=>	'application/xhtml+xml',
            'xht'	=>	'application/xhtml+xml',
            'zip'	=>	array('application/x-zip', 'application/zip', 'application/x-zip-compressed', 'application/s-compressed', 'multipart/x-zip'),
            'rar'	=>	array('application/x-rar', 'application/rar', 'application/x-rar-compressed'),
            'mid'	=>	'audio/midi',
            'midi'	=>	'audio/midi',
            'mpga'	=>	'audio/mpeg',
            'mp2'	=>	'audio/mpeg',
            'mp3'	=>	array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'),
            'aif'	=>	array('audio/x-aiff', 'audio/aiff'),
            'aiff'	=>	array('audio/x-aiff', 'audio/aiff'),
            'aifc'	=>	'audio/x-aiff',
            'ram'	=>	'audio/x-pn-realaudio',
            'rm'	=>	'audio/x-pn-realaudio',
            'rpm'	=>	'audio/x-pn-realaudio-plugin',
            'ra'	=>	'audio/x-realaudio',
            'rv'	=>	'video/vnd.rn-realvideo',
            'wav'	=>	array('audio/x-wav', 'audio/wave', 'audio/wav'),
            'bmp'	=>	array('image/bmp', 'image/x-bmp', 'image/x-bitmap', 'image/x-xbitmap', 'image/x-win-bitmap', 'image/x-windows-bmp', 'image/ms-bmp', 'image/x-ms-bmp', 'application/bmp', 'application/x-bmp', 'application/x-win-bitmap'),
            'gif'	=>	'image/gif',
            'jpeg'	=>	array('image/jpeg', 'image/pjpeg'),
            'jpg'	=>	array('image/jpeg', 'image/pjpeg'),
            'jpe'	=>	array('image/jpeg', 'image/pjpeg'),
            'png'	=>	array('image/png',  'image/x-png'),
            'tiff'	=>	'image/tiff',
            'tif'	=>	'image/tiff',
            'css'	=>	array('text/css', 'text/plain'),
            'html'	=>	array('text/html', 'text/plain'),
            'htm'	=>	array('text/html', 'text/plain'),
            'shtml'	=>	array('text/html', 'text/plain'),
            'txt'	=>	'text/plain',
            'text'	=>	'text/plain',
            'log'	=>	array('text/plain', 'text/x-log'),
            'rtx'	=>	'text/richtext',
            'rtf'	=>	'text/rtf',
            'xml'	=>	array('application/xml', 'text/xml', 'text/plain'),
            'xsl'	=>	array('application/xml', 'text/xsl', 'text/xml'),
            'mpeg'	=>	'video/mpeg',
            'mpg'	=>	'video/mpeg',
            'mpe'	=>	'video/mpeg',
            'qt'	=>	'video/quicktime',
            'mov'	=>	'video/quicktime',
            'avi'	=>	array('video/x-msvideo', 'video/msvideo', 'video/avi', 'application/x-troff-msvideo'),
            'movie'	=>	'video/x-sgi-movie',
            'doc'	=>	array('application/msword', 'application/vnd.ms-office'),
            'docx'	=>	array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword', 'application/x-zip'),
            'dot'	=>	array('application/msword', 'application/vnd.ms-office'),
            'dotx'	=>	array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword'),
            'xlsx'	=>	array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip', 'application/vnd.ms-excel', 'application/msword', 'application/x-zip'),
            'word'	=>	array('application/msword', 'application/octet-stream'),
            'xl'	=>	'application/excel',
            'eml'	=>	'message/rfc822',
            'json'  =>	array('application/json', 'text/json'),
            'pem'   =>	array('application/x-x509-user-cert', 'application/x-pem-file', 'application/octet-stream'),
            'p10'   =>	array('application/x-pkcs10', 'application/pkcs10'),
            'p12'   =>	'application/x-pkcs12',
            'p7a'   =>	'application/x-pkcs7-signature',
            'p7c'   =>	array('application/pkcs7-mime', 'application/x-pkcs7-mime'),
            'p7m'   =>	array('application/pkcs7-mime', 'application/x-pkcs7-mime'),
            'p7r'   =>	'application/x-pkcs7-certreqresp',
            'p7s'   =>	'application/pkcs7-signature',
            'crt'   =>	array('application/x-x509-ca-cert', 'application/x-x509-user-cert', 'application/pkix-cert'),
            'crl'   =>	array('application/pkix-crl', 'application/pkcs-crl'),
            'der'   =>	'application/x-x509-ca-cert',
            'kdb'   =>	'application/octet-stream',
            'pgp'   =>	'application/pgp',
            'gpg'   =>	'application/gpg-keys',
            'sst'   =>	'application/octet-stream',
            'csr'   =>	'application/octet-stream',
            'rsa'   =>	'application/x-pkcs7',
            'cer'   =>	array('application/pkix-cert', 'application/x-x509-ca-cert'),
            '3g2'   =>	'video/3gpp2',
            '3gp'   =>	'video/3gp',
            'mp4'   =>	'video/mp4',
            'm4a'   =>	'audio/x-m4a',
            'f4v'   =>	'video/mp4',
            'webm'	=>	'video/webm',
            'aac'   =>	'audio/x-acc',
            'm4u'   =>	'application/vnd.mpegurl',
            'm3u'   =>	'text/plain',
            'xspf'  =>	'application/xspf+xml',
            'vlc'   =>	'application/videolan',
            'wmv'   =>	array('video/x-ms-wmv', 'video/x-ms-asf'),
            'au'    =>	'audio/x-au',
            'ac3'   =>	'audio/ac3',
            'flac'  =>	'audio/x-flac',
            'ogg'   =>	'audio/ogg',
            'kmz'	=>	array('application/vnd.google-earth.kmz', 'application/zip', 'application/x-zip'),
            'kml'	=>	array('application/vnd.google-earth.kml+xml', 'application/xml', 'text/xml'),
            'ics'	=>	'text/calendar',
            'ical'	=>	'text/calendar',
            'zsh'	=>	'text/x-scriptzsh',
            '7zip'	=>	array('application/x-compressed', 'application/x-zip-compressed', 'application/zip', 'multipart/x-zip'),
            'cdr'	=>	array('application/cdr', 'application/coreldraw', 'application/x-cdr', 'application/x-coreldraw', 'image/cdr', 'image/x-cdr', 'zz-application/zz-winassoc-cdr'),
            'wma'	=>	array('audio/x-ms-wma', 'video/x-ms-asf'),
            'jar'	=>	array('application/java-archive', 'application/x-java-application', 'application/x-jar', 'application/x-compressed'),
            'svg'	=>	array('image/svg+xml', 'application/xml', 'text/xml'),
            'vcf'	=>	'text/x-vcard'
        );
        $ext =array_key_exists($mime_type, $mapping);


        if ($ext==1) {
            return $mime_type;
        }
        foreach ($mapping as $mime_type => $mimes) {
            if (is_array($mimes) && in_array($mime_type, $mimes)) {
                return $mime_type;
            }
        }

        return FALSE;
    }

    Public function register(Request $request)
    {
        $fileName = 'null';
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'fullname' => 'required|string|max:255',
                'fathername' => 'required|string|max:255',
                //'image' => 'required|mimes:jpeg,bmp,png,jpg',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $pass = $request->input('password');

            $age = floor((time() - strtotime($request->input('date_of_birth'))) / 32556926);


            $user= User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'fullname' => $request->input('fullname'),
                'fathername' => $request->input('fathername'),
                'image' => $request->input('image'),
                'password' => bcrypt($pass),
                'gender' => $request->input('gender'),
                'religion' => $request->input('religion'),
                'admin' => $request->input('admin', 0),
                'leader' => $request->input('leader', 0),
                'ss_id' => $request->input('name'),
                'date_of_birth' => $request->input('date_of_birth'),
                'address' => $request->input('address'),
                'age' => $age,
                'phone' => $request->input('phone'),
                'facebook' => $request->input('facebook'),
                'twitter' => $request->input('twitter'),
                'role' => $request->input('role'),
            ]);
            /*
            if ($request->input('ssv') == 'staff') {
                Doctor::create([
                    'ss_id' => $request->input('name'),

                ]);
            }
            if ($request->input('ssv') == 'student') {
                Patient::create([
                    'ss_id' => $request->input('name'),
                    'grade_id' => $request->input('grade_id'),
                    'GPA' => $request->input('GPA'),
                ]);
            }*/
     /*       User_notification::create([
                'message' => $request->input('name').' Added Successfully.',
                'url' => '#',
                'user_id'=>auth()->id()

            ]);
            broadcast(new AddNotifications($request->input('name').' Added Successfully.'))->toOthers();*/

            $success = true;
            $message = 'User register successfully';
        }
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

   /* public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = 'User register successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }*/

    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = 'User login successfully';
        } else {
            $success = false;
            $message = 'Unauthorised';
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Logout
     */
    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
    public function checkEmail(Request $request){
        $email=$request->input('email');
        $user = User::where('email', '=',$email)->first();
        if ($user ) {
            return 0;
        }else{
            return  1;
        }
    }
    public function checkName(Request $request){
        $name=$request->input('name');
        $user = User::where('name', '=',$name)->first();
        if ($user ) {
            return 0;
        }else{
            return  1;
        }
    }
    public function fileStore(Request $request)
    {

        $saved_path=$request->path;
        $upload_path = public_path($saved_path);
        $file_name = $request->file->getClientOriginalName();
        $mime_type= $request->file->getClientOriginalExtension();
        $extension = $this->mime2ext($mime_type);
        if ($extension==false){
            return response()->json(['fail' => 'This file is not allowed for upload.',
                'name'=>""]);
        }else{
            $generated_new_name = time() . '.' . $extension;
            $request->file->move($upload_path, $generated_new_name);
            $insert['title'] = $file_name;
            return response()->json(['success' => 'You have successfully uploaded "' . $file_name . '"',
                'name'=>"/{$saved_path}{$generated_new_name}"]);
        }
    }
}
