<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Dnschecker;
use App\Mapavector;
use App\Marcadores;


class DnsController extends Controller
{


    public function index(){

      $dns = Dnschecker::get();
      $mapavector=Mapavector::get();
      $marcadores=Marcadores::get();

      return view('dns/index',['result' => $dns, 'rmapa' => $mapavector, 'rmarcadores' => $marcadores]);
    }


    public function search()
    {
      $domain=$_POST['url'];
      $parametro=$_POST['type'];

      $dns = Dnschecker::get();

      foreach ($dns as $key => $value) {

        $nslookup = ('dig '.$parametro.' '. $domain .' @'.$value->ip .' +short');

        exec($nslookup, $result[$value->id]);

      }

      echo json_encode($result);

    }

    public function indexAdm(){

      $dns = Dnschecker::get();

      return view('dns/adm/index',['dnslist' => $dns]);
    }

    public function create(){
      return view('dns/create');
    }

    public function store(Requests\CreateDnsRequest $request){
      Dnschecker::create($request->all());
  		return redirect('/adm');
    }

    public function edit($id){

      $dns = Dnschecker::findOrFail($id);
      return view('dns/edit', ['result' => $dns]);
    }

    public function update(Requests\EditDnsRequest $request, $id)
  	{
  		$dns = Dnschecker::findOrFail($id);
  		$dns->fill($request->all());
  		$dns->save();
  		return redirect('/adm');
  	}

    public function destroy($id, Request $request)
  	{
      Dnschecker::destroy($id);
  		$message='El registro ha sido eliminado con exito';
  		Session::flash('message', $message);
      return $message;
  	}

    public function getip(){
      $dns= Dnschecker::get();

      $resultip=[];
      foreach ($dns as $key => $value) {
        $resultip[$value->id]=$value->ip;
      }
      echo json_encode($resultip);
    }

    public function getresult(){

      $ip=$_GET['ip'];
      $id=$_GET['id'];
      $domain=$_GET['url'];
      $parametro=$_GET['type'];
      $data= array();


      $r = new \Net_DNS2_Resolver(array('nameservers' => array($ip)));

        try
        {
            $result = $r->query($domain, $parametro);

            foreach($result->answer as $record){
              if($parametro == 'A' || $parametro == 'AAAA'){
                $show=$record->address;
              }elseif ($parametro == 'CNAME') {
                $show=$record;
              }elseif($parametro=='MX'){
                $show=$record->preference.' '.$record->exchange;
              }elseif ($parametro == 'NS') {
                $show=$record->nsdname;
              }elseif ($parametro == 'PTR') {
                $show=$record;
              }elseif ($parametro == 'SOA') {
                $show=$record->mname.' '.$record->rname.' '.$record->serial.' '.$record->refresh.' '.$record->retry.' '.$record->expire.' '.$record->minimum;
              }elseif ($parametro == 'SRV') {
                $show=$record;
              }elseif ($parametro == 'TXT') {
                $show=$record->text;
              }
              $data[]=$show;

            }

        } catch(\Net_DNS2_Exception $e){
            $data[]= $e->getMessage();
        }
        $data2[$id]=$data;

        echo json_encode($data2);
    }

    public function getmarker(){

      $marcadores=Marcadores::get();

      $long=[];
      $lat=[];
      foreach ($marcadores as $key => $value) {

        $lat[$value->coordx] = $value->coordy;
      }
      $resultado = [$lat];


      echo json_encode($resultado);
    }

}
