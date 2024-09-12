<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontController extends Controller
{
    //
    public function index(Request $request) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://jakpreneur.jakarta.go.id/api/jak-konek/show-data-jak-konek',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        if (!$this->isXml($response)) {
            dd('failed to get data');
        }
        $xml = simplexml_load_string($response);
        $data['data'] = $xml;
        return view('index', $data);
    }

    public function login (Request $request){
        $data = [];
        return view('login', $data);
    }

    public function loginSubmit(Request $request){
        $formData = $request->validate([
            'username'       => 'required|string|max:255',
            'password'       => 'required|string|max:255|min:2'
        ]);
        $username = $formData['username'];
        $password = $formData['password'];

        $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://jakpreneur.jakarta.go.id/mobile/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('username' => $username,'password' => $password),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $json_response = json_decode($response);

        if ($json_response->status == true) {
            $data = $json_response->data;
            $user = $data->user;
            $token = $data->token;
            $request->session()->put('token', $token);
            dd('login success, selamat datang ' . $user->name);
        } else {
            $message = $json_response->message;
            return redirect()->back()->with('error', $message);
        }
    }

    public function recruitment(Request $request){
        $data = [];
        return view('recruitment', $data);
    }

    public function recruitmentStore(Request $request){
        $formData = $request->validate([
            'nm_pengumuman'                 => 'required|string|max:255',
            'kuota'                         => 'required|integer|digits_between:1,2',
            'tanggal_batas_pendaftaran'     => 'required|date',
            'penyelenggara'                 => 'required|string'
        ]);
        $response = Http::post('https://disppkukm.jakarta.go.id/pelatihan/api/submit-pengumuman', [
            'nm_pengumuman' => $formData['nm_pengumuman'],
            'kuota' => $formData['kuota'],
            'tanggal_batas_pendaftaran' => $formData['tanggal_batas_pendaftaran'],
            'penyelenggara' => $formData['penyelenggara']
        ]);
        $status = $response->status();
        $response = $response->body();
        if ($status == 200) {
            $jsonResponse = json_decode($response);
            if ($jsonResponse->type == 'success') {
                return redirect()->back()->with('success', $jsonResponse->message);
            }else{
                return redirect()->back()->with('success', "success submit pengumuman");
            }
        }else{
            return redirect()->back()->with('error', "failed submit pengumuman");
        }
    }

    private function isXml(string $value): bool
	{
		$prev = libxml_use_internal_errors(true);
		$doc = simplexml_load_string($value);
		$errors = libxml_get_errors();
		libxml_clear_errors();
		libxml_use_internal_errors($prev);
		return false !== $doc && empty($errors);
	}
}
